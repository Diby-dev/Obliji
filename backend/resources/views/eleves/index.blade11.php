@extends('layouts.app')

@section('content')

<style>
body {
        /* Ceci est le code à ajouter */
        background-image: url("{{ asset('images/fond_ecole.jpg') }}");
        background-size: cover; 
        background-repeat: no-repeat;
        background-attachment: fixed; 
        background-color: #ffffffff; 
    }
    /* S'assurer que le contenu du formulaire a un fond blanc pour la lisibilité */
    .card {
        background-color: rgba(255, 255, 255, 0.95) !important; /* Ajoute un fond blanc semi-transparent au formulaire */
    }
</style>

<div class="container-fluid py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary fw-bold">Liste Complète des Élèves Enregistrés</h1>
        {{-- Bouton pour retourner au formulaire d'inscription --}}
        <a href="{{ route('eleve.create') }}" class="btn btn-success btn-lg shadow-sm">
            <i class="fas fa-plus me-2"></i> Inscrire un Nouvel Élève
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- DÉBUT: Formulaire de Recherche et de Filtre Combiné --}}
    <div class="row mb-4">
        <div class="col-12 col-lg-10 mx-auto">
            {{-- Le formulaire soumet à la route d'index elle-même --}}
            <form action="{{ route('eleve.index') }}" method="GET" class="row g-3 align-items-end shadow-sm p-3 bg-light rounded-3 border">
                
                {{-- Champ de recherche par Matricule --}}
                <div class="col-md-5 col-lg-5">
                    <label for="search" class="form-label fw-bold text-muted">Rechercher par Matricule</label>
                    <input type="text" name="search" id="search" class="form-control form-control-lg border-primary" 
                           placeholder="Ex: 28374BP" 
                           value="{{ $search ?? '' }}" {{-- Utiliser la variable passée par le contrôleur --}}
                           aria-label="Recherche par Matricule">
                </div>

                {{-- Champ de filtre par Classe --}}
                <div class="col-md-5 col-lg-4">
                    <label for="classe" class="form-label fw-bold text-muted">Filtrer par Classe</label>
                    <select name="classe" id="classe" class="form-select form-select-lg border-primary" aria-label="Filtre par Classe">
                        {{-- La liste des classes est passée par le contrôleur --}}
                        @foreach ($classes as $classe)
                            <option value="{{ $classe }}" 
                                {{ ($classeFilter ?? 'Toutes les classes') == $classe ? 'selected' : '' }}>
                                {{ $classe }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Boutons d'Action --}}
                <div class="col-md-2 col-lg-3 d-flex justify-content-end">
                    <button class="btn btn-primary btn-lg flex-grow-1 me-2" type="submit" title="Lancer la recherche/le filtre">
                        <i class="fas fa-filter me-1"></i>
                        <span class="d-none d-md-inline">Filtrer</span>
                    </button>
                    
                    {{-- Bouton pour effacer la recherche/le filtre --}}
                    @if(!empty($search) || !empty($classeFilter) && $classeFilter !== 'Toutes les classes')
                        <a href="{{ route('eleve.index') }}" class="btn btn-secondary btn-lg" title="Effacer les filtres">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    {{-- FIN: Formulaire de Recherche et de Filtre Combiné --}}

    @if ($eleves->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            <h4 class="alert-heading">
                @if(!empty($search))
                    Aucun élève trouvé pour le matricule : <strong>{{ $search }}</strong>
                @elseif(!empty($classeFilter) && $classeFilter !== 'Toutes les classes')
                    Aucun élève trouvé dans la classe : <strong>{{ $classeFilter }}</strong>
                @else
                    Aucun élève trouvé !
                @endif
            </h4>
            @if(empty($search) && (empty($classeFilter) || $classeFilter === 'Toutes les classes'))
            <p>Veuillez utiliser le bouton ci-dessus pour commencer l'inscription des élèves.</p>
            @endif
        </div>
    @else
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-3 p-md-4">
                {{-- Utilisez 'table-responsive' pour le défilement sur les petits écrans --}}
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered align-middle" id="elevesTable">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Photo</th>
                                <th scope="col">Matricule</th>
                                <th scope="col">Nom & Prénoms</th>
                                <th scope="col">Classe</th>
                                <th scope="col">Sexe</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">D. Naissance</th>
                                <th scope="col">Statut Affecté</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eleves as $eleve)
                                <tr>
                                    {{-- # --}}
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    
                                    {{-- Photo --}}
                                    <td class="text-center">
                                        @if ($eleve->photo_url)
                                            <img src="{{ asset('storage/' . $eleve->photo_url) }}" alt="{{ $eleve->nom }}" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <i class="fas fa-user-circle fa-2x text-muted"></i>
                                        @endif
                                    </td>
                                    
                                    {{-- Matricule --}}
                                    <td><strong>{{ $eleve->matricule }}</strong></td>
                                    
                                    {{-- Nom & Prénoms --}}
                                    <td>{{ $eleve->nom }} {{ $eleve->prenoms }}</td>
                                    
                                    {{-- Classe --}}
                                    <td>{{ $eleve->classe }}</td>
                                    
                                    {{-- Sexe --}}
                                    <td>{{ $eleve->sexe }}</td>
                                    
                                    {{-- Téléphone Tuteur --}}
                                    <td>{{ $eleve->tuteur_telephone }}</td>
                                    
                                    {{-- Date de Naissance --}}
                                    <td>{{ \Carbon\Carbon::parse($eleve->date_naissance)->format('d/m/Y') }}</td>
                                    
                                    {{-- Statut Affecté --}}
                                    <td class="text-center">
                                        <span class="badge {{ $eleve->affecte ? 'bg-success' : 'bg-danger' }}">
                                            {{ $eleve->affecte ? 'Oui' : 'Non' }}
                                        </span>
                                    </td>
                                    
                                    {{-- Actions (Détails et Modification) --}}
                                    <td class="text-center">
                                        {{-- Lien vers la vue des détails --}}
                                        <a href="{{ route('eleve.show', $eleve) }}" class="btn btn-sm btn-info me-1" title="Détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        {{-- Lien vers la NOUVELLE vue de modification (edit.blade.php) --}}
                                        <a href="{{ route('eleve.edit', $eleve) }}" class="btn btn-sm btn-primary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        {{-- Le bouton de suppression sera ajouté à l'étape suivante --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{-- Affichage des informations secondaires (Lieu N., Nationalité, Email) --}}
                <p class="mt-4 text-muted">
                </p>

            </div>
        </div>
    @endif


</div>
@endsection

@push('scripts')
{{-- Si vous utilisez DataTables ou similaire, le script irait ici --}}

<script>
// Exemple d'initialisation de DataTables (si vous avez importé la bibliothèque)
/*
$(document).ready(function() {
$('#elevesTable').DataTable({
"language": {
"url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/fr_fr.json"
}
});
});
*/
</script>

@endpush
