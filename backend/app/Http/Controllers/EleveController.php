<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Classe; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Str; 
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\DB; 
use Exception; // 👈 AJOUTÉ : Pour utiliser dans le try/catch

// Si vous utilisez Dompdf, vous devez décommenter l'importation de PDF si ce n'est pas déjà fait.
// use PDF; 

class EleveController extends Controller
{
    /**
     * Affiche la liste des élèves (index).
     */
    public function index(Request $request) 
    {
        // Récupérer les termes de recherche (si présents)
        $search = $request->query('search'); // Recherche par matricule (contient)
        $classeFilter = $request->query('classe'); // Filtre par classe (contient l'ID de la classe)
        $typeClasseFilter = $request->query('type_classe'); // 👈 NOUVEAU : Filtre par type de classe
        
        // Récupérer toutes les classes (ID => nom_classe) pour le menu déroulant du filtre
        $classes = Classe::pluck('nom_classe', 'id'); 
        
        // NOUVEAU : Récupérer les types de classes uniques pour le menu déroulant
        $typesDeClasse = Classe::select('type_classe')
            ->distinct()
            ->whereNotNull('type_classe')
            ->pluck('type_classe');

        // Commencer la requête de base avec la relation 'classe' pour éviter la N+1 Query (Chargement Eager)
        $query = Eleve::with('classe')->orderBy('id', 'asc');

        // 1. Appliquer le filtre de recherche par matricule (recherche 'LIKE' pour 'contient')
        if ($search) {
            $query->where('matricule', 'LIKE', "%{$search}%");
        }

        // 2. Appliquer le filtre par classe (exacte sur l'ID)
        if ($classeFilter) {
            $query->where('classe_id', $classeFilter);
        }

        // 3. NOUVEAU : Appliquer le filtre par type de classe
        if ($typeClasseFilter) {
            // Utilisation de 'whereHas' pour filtrer sur la relation
            $query->whereHas('classe', function ($q) use ($typeClasseFilter) {
                $q->where('type_classe', $typeClasseFilter);
            });
        }

        $eleves = $query->get(); 

        // Passer la collection d'élèves, la liste des classes, la liste des types de classes, et les filtres actifs à la vue
        return view('eleves.index', compact('eleves', 'classes', 'typesDeClasse', 'search', 'classeFilter', 'typeClasseFilter')); 
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        // ENVOYER LES CLASSES AU FORMULAIRE
        $classes = Classe::all(); 
        return view('eleves.create', compact('classes')); 
    }

    /**
     * Traite l'enregistrement d'un nouvel élève.
     */
    public function store(Request $request)
    {
        // 1. Validation des données
        $validatedData = $request->validate([
            'matricule' => 'nullable|string|unique:eleves|max:50',
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'nullable|string|max:255', 
            'nationalite' => 'nullable|string|max:255', 
            'affecte' => 'nullable', 
            
            // CORRECTION CLÉ : Utiliser classe_id et vérifier l'existence dans la table classes
            'classe_id' => ['required', 'integer', Rule::exists('classes', 'id')],
            
            'sexe' => 'required|string|in:Masculin,Féminin', 
            'tuteur_telephone' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'photo_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
            
            // Les autres champs que vous avez dans fillable doivent être validés si vous les utilisez dans le formulaire
            'redouble' => 'nullable|boolean',
            'preced_classe' => 'nullable|string|max:255',
            'lv2' => 'nullable|string|max:50',
            'ap_mu' => 'nullable|string|max:50',
            // 'qrcode' n'est pas validé ici, car il est généré par le système.
        ]);
        
        $validatedData['affecte'] = $request->boolean('affecte');
        
        // 2. Traitement du téléchargement de la photo
        $photoPath = $this->handlePhotoUpload($request); 

        // 3. Préparation et Création de l'élève
        $eleveData = $validatedData; 
        
        unset($eleveData['photo_url']); 
        $eleveData['photo_url'] = $photoPath; 
        
        $eleve = Eleve::create($eleveData); 

        return redirect()->route('eleve.show', $eleve)
            ->with('success', 'L\'élève a été créé avec succès.');
    }
    
    /**
     * Affiche un élève spécifique (Détails).
     */
    public function show(Eleve $eleve)
    {
        return view('eleves.show', compact('eleve'));
    }

    /**
     * Affiche le formulaire de modification d'un élève.
     */
    public function edit(Eleve $eleve)
    {
        $classes = Classe::all(); // 👈 Envoyer les classes à la vue d'édition
        return view('eleves.edit', compact('eleve', 'classes')); 
    }

    /**
     * Met à jour les informations d'un élève.
     */
    public function update(Request $request, Eleve $eleve)
    {
        // 1. Validation (Ignorer l'unicité du matricule de l'élève actuel)
        $validatedData = $request->validate([
            'matricule' => 'nullable|string|max:50|unique:eleves,matricule,' . $eleve->id,
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'nullable|string|max:255', 
            'nationalite' => 'nullable|string|max:255', 
            'affecte' => 'nullable', 
            
            // CORRECTION CLÉ : Utiliser classe_id et vérifier l'existence dans la table classes
            'classe_id' => ['required', 'integer', Rule::exists('classes', 'id')],

            'sexe' => 'required|string|in:Masculin,Féminin', 
            'tuteur_telephone' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'photo_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 

            // Les autres champs que vous avez dans fillable doivent être validés si vous les utilisez dans le formulaire
            'redouble' => 'nullable|boolean',
            'preced_classe' => 'nullable|string|max:255',
            'lv2' => 'nullable|string|max:50',
            'ap_mu' => 'nullable|string|max:50',
        ]);

        $validatedData['affecte'] = $request->boolean('affecte');
        
        // 2. Traitement de la photo
        $photoPath = $this->handlePhotoUpload($request, $eleve);

        // 3. Mise à jour des données
        $eleveData = $validatedData; 
        
        unset($eleveData['photo_url']); 
        
        if ($photoPath !== null) {
            $eleveData['photo_url'] = $photoPath; 
        }

        $eleve->update($eleveData); 

        return redirect()->route('eleve.show', $eleve)
            ->with('success', 'Les informations de l\'élève ont été mises à jour avec succès.');
    }

    /**
     * Supprime un élève.
     * * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function destroy(Eleve $eleve)
    {
        $nom_complet = $eleve->nom . ' ' . $eleve->prenoms; // Pour le message de succès

        try {
            // Suppression de la photo si elle existe
            if ($eleve->photo_url) {
                // Utilisation de la Log pour le débogage de suppression
                // Log::info('Tentative de suppression de la photo: ' . $eleve->photo_url);
                Storage::disk('public')->delete($eleve->photo_url);
            }
            
            // Suppression de l'enregistrement de l'élève
            $eleve->delete();

            // Redirection avec message de succès personnalisé
            return redirect()->route('eleve.index')
                ->with('success', "L'élève {$nom_complet} a été supprimé avec succès.");
                
        } catch (Exception $e) {
            // Log de l'erreur pour la maintenance
            Log::error("Erreur de suppression de l'élève {$eleve->id}: " . $e->getMessage());

            // Redirection avec message d'erreur
            return redirect()->route('eleve.index')
                ->with('error', "Une erreur est survenue lors de la suppression de l'élève {$nom_complet}.");
        }
    }
    
    // --- MÉTHODES DE GENERATION PDF (CARTE ET RAPPORT) ---

    /**
     * Télécharge la carte d'accès au format PDF.
     */
    public function downloadCarteAccesPdf(Eleve $eleve)
    {
        // NOTE: Assurez-vous d'importer la façade PDF si vous l'utilisez
        return $this->generatePdf($eleve, 'eleves.carte_acces_pdf', 'Carte_Acces_');
    }

    /**
     * Télécharge le rapport détaillé au format PDF.
     */
    public function downloadRapportDetaillePdf(Eleve $eleve)
    {
        // NOTE: Assurez-vous d'importer la façade PDF si vous l'utilisez
        return $this->generatePdf($eleve, 'eleves.rapport_detaille_pdf', 'Rapport_Detaille_');
    }

    // --- MÉTHODES PROTECTED HELPER ---
    
    /**
     * Gère le téléchargement et le stockage de la photo (Base64 ou fichier uploadé).
     */
    protected function handlePhotoUpload(Request $request, ?Eleve $eleve = null): ?string
    {
        $photoPath = $eleve ? $eleve->photo_url : null;
        
        $newPhotoProvided = $request->hasFile('photo_url') || $request->filled('photo_base64');

        // 1. Suppression de l'ancienne photo si une nouvelle est fournie
        if ($newPhotoProvided && $eleve && $eleve->photo_url) {
            Storage::disk('public')->delete($eleve->photo_url);
            $photoPath = null;
        }
        
        // 2. Traitement de la nouvelle photo Base64
        if ($request->filled('photo_base64')) {
            try {
                if ($eleve && $request->photo_base64 === $eleve->photo_url) {
                    return $eleve->photo_url;
                }

                if (!Str::startsWith($request->photo_base64, 'data:')) {
                    return $photoPath;
                }
                
                $base64Image = Str::after($request->photo_base64, 'base64,');
                $imageDecoded = base64_decode($base64Image);
                
                if ($imageDecoded === false) {
                    throw new \Exception("Décodage Base64 échoué.");
                }
                
                $mimePrefix = Str::between($request->photo_base64, 'data:', ';base64');
                $extension = str_contains($mimePrefix, '/') ? explode('/', $mimePrefix)[1] : 'png';
                
                $fileName = 'photos_eleves/' . uniqid() . '.' . $extension;
                Storage::disk('public')->put($fileName, $imageDecoded);
                return $fileName;

            } catch (Exception $e) {
                Log::error("Erreur Base64: " . $e->getMessage());
                return $photoPath;
            }
        } 
        
        // 3. Traitement de la nouvelle photo uploadée
        elseif ($request->hasFile('photo_url')) {
            return $request->file('photo_url')->store('photos_eleves', 'public');
        }
        
        // 4. Retourne le chemin existant
        return $photoPath;
    }

    /**
     * Helper centralisé pour la logique de génération et de téléchargement du PDF.
     */
    protected function generatePdf(Eleve $eleve, string $viewName, string $fileNamePrefix)
    {
        // 1. Conversion de la photo en Base64 pour Dompdf
        $eleve->photo_base64 = null;
        if ($eleve->photo_url && Storage::disk('public')->exists($eleve->photo_url)) {
            try {
                $image_data = Storage::disk('public')->get($eleve->photo_url);
                $mime_type = Storage::disk('public')->mimeType($eleve->photo_url);
                $eleve->photo_base64 = "data:{$mime_type};base64," . base64_encode($image_data);
            } catch (Exception $e) {
                Log::warning("Erreur Base64 photo pour PDF: " . $e->getMessage());
            }
        }
        
        // 2. Génération du PDF
        try {
            // NOTE: Assurez-vous que la librairie PDF est bien importée
            // Si vous utilisez la façade, elle est probablement accessible via \PDF
            $pdf = \PDF::loadView($viewName, compact('eleve'));
            $fileName = $fileNamePrefix . Str::slug($eleve->nom) . '_' . Str::slug($eleve->prenoms) . '.pdf';

            return $pdf->download($fileName);
        } catch (Exception $e) {
            Log::error("Erreur PDF: Échec de la génération de {$fileNamePrefix} pour l'élève {$eleve->id}. " . $e->getMessage());
            return redirect()->back()->with('error', 'Impossible de générer le document PDF. Veuillez vérifier les logs.');
        }
    }
}