@extends('layouts.app')

@section('content')

<style>
body {
 background-image: url("{{ asset('images/fond_ecole.jpg') }}");
 background-size: cover; 
 background-repeat: no-repeat;
 background-attachment: fixed; 
 background-color: #ffffffff; 
 }
 .card {
 background-color: rgba(255, 255, 255, 0.95) !important; 
 }

/* ---------------------------------------------------- */
/* NOUVEAU CODE POUR LA RESPONSIVITÉ MOBILE (Media Query) */
/* ---------------------------------------------------- */
@media (max-width: 767px) {
    /* Masque l'en-tête du tableau sur mobile */
    #elevesTable thead {
        display: none;
    }

    /* Transforme le corps du tableau en blocs (cartes) */
    #elevesTable, 
    #elevesTable tbody, 
    #elevesTable tr, 
    #elevesTable td {
        display: block;
        width: 100%;
    }

    /* Style de carte pour chaque ligne */
    #elevesTable tr {
        margin-bottom: 1rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        background: #fff;
    }

    /* Disposition des cellules avec leur label (nom de colonne) */
    #elevesTable td {
        text-align: right;
        padding-left: 50% !important; 
        position: relative;
        border: none;
        border-bottom: 1px solid #eee;
        /* Ajout de padding-top/bottom sur mobile pour l'espacement */
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
    }

    /* Affichage du label à gauche de chaque information */
    #elevesTable td::before {
        content: attr(data-label); /* Utilise l'attribut data-label de la balise td */
        position: absolute;
        left: 10px;
        width: 45%; 
        font-weight: bold;
        color: #555;
        text-align: left;
    }
    
    /* Empilement des champs de recherche sur mobile */
    .row.g-3 > div {
        margin-bottom: 0.5rem; 
    }
    
    /* Bouton Filtrer s'étend sur toute la largeur de sa colonne sur mobile */
    .row.g-3 .d-flex {
        width: 100%;
        margin-top: 10px;
        /* Aligne le bouton à droite dans la colonne (si l'espace le permet) */
        justify-content: flex-end !important;
    }
}
</style>

<div class="container-fluid py-5">

 <div class="d-flex justify-content-between align-items-center mb-4">
 <h1 class="text-primary fw-bold">Liste complète des élèves enregistrés</h1>
 {{-- Bouton pour retourner au formulaire d'inscription --}}
 <a href="{{ route('eleve.create') }}" class="btn btn-success btn-lg shadow-sm">
  <i class="fas fa-plus me-2"></i> Enregistrer un nouvel élève
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
 <div class="col-12 col-lg-12 mx-auto">
  {{-- Le formulaire soumet à la route d'index elle-même --}}
  <form action="{{ route('eleve.index') }}" method="GET" class="row g-3 align-items-end shadow-sm p-3 bg-light rounded-3 border">
 
 {{-- Champ de recherche par Matricule --}}
 <div class="col-md-4 col-sm-12"> {{-- AJOUT DE col-sm-12 pour forcer la pleine largeur sur mobile --}}
  <label for="search" class="form-label fw-bold text-muted">Rechercher par Matricule</label>
  <input type="text" name="search" id="search" class="form-control form-control-lg border-primary" 
  placeholder="Ex: 28374BP" 
  value="{{ $search ?? '' }}" {{-- Utiliser la variable passée par le contrôleur --}}
  aria-label="Recherche par Matricule">
 </div>

 {{-- Champ de filtre par Classe --}}
 <div class="col-md-3 col-sm-12"> {{-- AJOUT DE col-sm-12 --}}
  <label for="classe" class="form-label fw-bold text-muted">Filtrer par Classe</label>
  <select name="classe" id="classe" class="form-select form-select-lg border-primary" aria-label="Filtre par Classe">
  <option value="">Toutes les classes</option> {{-- Option par défaut pour toutes les classes --}}
  {{-- La liste des classes est passée par le contrôleur (key=id, value=nom_classe) --}}
  @foreach ($classes as $id => $nom_classe)
  <option value="{{ $id }}" 
  {{ ($classeFilter ?? '') == $id ? 'selected' : '' }}>
  {{ $nom_classe }}
  </option>
  @endforeach
  </select>
 </div>

 {{-- NOUVEAU: Champ de filtre par Type de Classe --}}
 <div class="col-md-3 col-sm-12"> {{-- AJOUT DE col-sm-12 --}}
  <label for="type_classe" class="form-label fw-bold text-muted">Filtrer par Type de Classe</label>
  <select name="type_classe" id="type_classe" class="form-select form-select-lg border-primary" aria-label="Filtre par Type de Classe">
  <option value="">Tous les types</option>
  @foreach ($typesDeClasse as $type)
  <option value="{{ $type }}" 
  {{ ($typeClasseFilter ?? '') == $type ? 'selected' : '' }}>
  {{ $type }}
  </option>
  @endforeach
  </select>
 </div>


 {{-- Boutons d'Action --}}
 <div class="col-md-2 col-sm-12 d-flex justify-content-end"> {{-- AJOUT DE col-sm-12 --}}
  <button class="btn btn-primary btn-lg flex-grow-1 me-2" type="submit" title="Lancer la recherche/le filtre">
  <i class="fas fa-filter me-1"></i>
  Filtrer {{-- CORRECTION : Le texte 'Filtrer' est maintenant visible sur tous les écrans --}}
  </button>
  
  {{-- Bouton pour effacer la recherche/le filtre 
  @if(!empty($search) || !empty($classeFilter) || !empty($typeClasseFilter))
  <a href="{{ route('eleve.index') }}" class="btn btn-secondary btn-lg" title="Effacer les filtres">
  <i class="fas fa-times"></i>
  </a>
  @endif--}}
 </div>
  </form>
 </div>
 </div>
 {{-- FIN: Formulaire de Recherche et de Filtre Combiné --}}

 @if ($eleves->isEmpty())
 <div class="alert alert-warning text-center" role="alert">
  <h4 class="alert-heading">
 @if(!empty($search) || !empty($classeFilter) || !empty($typeClasseFilter))
  Aucun élève trouvé correspondant à la recherche et aux filtres.
 @else
  Aucun élève trouvé !
 @endif
  </h4>
  @if(empty($search) && empty($classeFilter) && empty($typeClasseFilter))
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
  <td class="text-center" data-label="#">{{ $loop->iteration }}</td>
  
  {{-- Photo --}}
  <td class="text-center" data-label="Photo">
  @if ($eleve->photo_url)
   <img src="{{ asset('storage/' . $eleve->photo_url) }}" alt="{{ $eleve->nom }}" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
  @else
   <i class="fas fa-user-circle fa-2x text-muted"></i>
  @endif
  </td>
  
  {{-- Matricule --}}
  <td data-label="Matricule"><strong>{{ $eleve->matricule }}</strong></td>
  
  {{-- Nom & Prénoms --}}
  <td data-label="Nom & Prénoms">{{ $eleve->nom }} {{ $eleve->prenoms }}</td>
  
  {{-- Classe --}}
  <td class="fw-bold text-primary" data-label="Classe">
     {{-- Utilisation de la relation `classe` --}}
     {{ $eleve->classe->nom_classe ?? 'Non Affecté' }}
    </td>
  
  {{-- Sexe --}}
  <td data-label="Sexe">{{ $eleve->sexe }}</td>
  
  {{-- Téléphone Tuteur --}}
  <td data-label="Téléphone">{{ $eleve->tuteur_telephone }}</td>
  
  {{-- Date de Naissance --}}
  <td data-label="D. Naissance">{{ \Carbon\Carbon::parse($eleve->date_naissance)->format('d/m/Y') }}</td>
  
  {{-- Statut Affecté --}}
  <td class="text-center" data-label="Statut Affecté">
  <span class="badge {{ $eleve->affecte ? 'bg-success' : 'bg-danger' }}">
   {{ $eleve->affecte ? 'Oui' : 'Non' }}
  </span>
  </td>
  
  {{-- Actions (Détails et Modification) --}}
  <td class="text-center" data-label="Actions">
  {{-- Lien vers la vue des détails --}}
  <a href="{{ route('eleve.show', $eleve) }}" class="btn btn-sm btn-info me-1" title="Détails">
   <i class="fas fa-eye"></i> Détails
  </a>
  
  {{-- Lien vers la NOUVELLE vue de modification (edit.blade.php) --}}
  <a href="{{ route('eleve.edit', $eleve) }}" class="btn btn-sm btn-primary me-1" title="Modifier">
   <i class="fas fa-edit"></i> Modifier
  </a>
  
  {{-- NOUVEAU: FORMULAIRE DE SUPPRESSION --}}
  <form action="{{ route('eleve.destroy', $eleve) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer {{ $eleve->nom }} {{ $eleve->prenoms }} ? Cette action est irréversible.');">
    @csrf
        @method('DELETE') 

    <button type="submit" class="btn btn-sm btn-danger" title="Supprimer l'élève">
        <i class="fas fa-trash"></i> Supprimer
    </button>
  </form>
  {{-- FIN NOUVEAU --}}
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