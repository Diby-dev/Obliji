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

<div class="container py-5">
<div class="row justify-content-center">
<div class="col-md-10 col-lg-8">
<div class="card shadow-lg border-0 rounded-4">
{{-- L'erreur est levée ici car $eleve n'est pas défini lors de l'accès à la page --}}
<div class="card-header bg-warning text-dark py-3 rounded-top-4">
<h3 class="mb-0 text-center fw-bold">MODIFICATION DE LA FICHE ÉLÈVE</h3>
{{-- Assurez-vous que $eleve est disponible ici --}}
<p class="text-center mb-0">Élève : {{ $eleve->nom }} {{ $eleve->prenoms }} (Matricule: {{ $eleve->matricule }})</p>
</div>

            <div class="card-body p-4 p-md-5">

                {{-- Formulaire de soumission vers la route update avec la méthode PUT --}}
                {{-- L'utilisation de $eleve est essentielle pour générer l'URL de modification --}}
                <form method="POST" action="{{ route('eleve.update', $eleve) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Affichage des erreurs de validation --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <strong>Attention !</strong> Veuillez corriger les erreurs ci-dessous :
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h4 class="mb-4 text-primary border-bottom pb-2">Informations Principales</h4>

                    <div class="row">
                        {{-- Matricule --}}
                        <div class="col-md-6 mb-3">
                            <label for="matricule" class="form-label fw-bold">Matricule</label>
                            <input type="text" name="matricule" id="matricule" class="form-control @error('matricule') is-invalid @enderror" value="{{ old('matricule', $eleve->matricule) }}" required>
                            @error('matricule')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Nom --}}
                        <div class="col-md-6 mb-3">
                            <label for="nom" class="form-label fw-bold">Nom</label>
                            <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $eleve->nom) }}" required>
                            @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- Prénoms --}}
                        <div class="col-md-6 mb-3">
                            <label for="prenoms" class="form-label fw-bold">Prénoms</label>
                            <input type="text" name="prenoms" id="prenoms" class="form-control @error('prenoms') is-invalid @enderror" value="{{ old('prenoms', $eleve->prenoms) }}" required>
                            @error('prenoms')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Date de Naissance (CORRIGÉE) --}}
                        <div class="col-md-6 mb-3">
                            <label for="date_naissance" class="form-label fw-bold">
                                Date de Naissance 
                                <span class="badge bg-info text-dark ms-2">NB: les date s'affiche en format MM/JJ/AAAA dans les Formulaire <br> mais s'affiche normalement sur la carte et sur la liste</span>
                            </label>
                            <input type="date" name="date_naissance" id="date_naissance" class="form-control @error('date_naissance') is-invalid @enderror" 
                                value="{{ old('date_naissance', \Carbon\Carbon::parse($eleve->date_naissance)->format('Y-m-d')) }}" required>
                            @error('date_naissance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- Lieu de Naissance --}}
                        <div class="col-md-6 mb-3">
                            <label for="lieu_naissance" class="form-label fw-bold">Lieu de Naissance</label>
                            <input type="text" name="lieu_naissance" id="lieu_naissance" class="form-control @error('lieu_naissance') is-invalid @enderror" value="{{ old('lieu_naissance', $eleve->lieu_naissance) }}">
                            @error('lieu_naissance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Nationalité --}}
                        <div class="col-md-6 mb-3">
                            <label for="nationalite" class="form-label fw-bold">Nationalité</label>
                            <input type="text" name="nationalite" id="nationalite" class="form-control @error('nationalite') is-invalid @enderror" value="{{ old('nationalite', $eleve->nationalite) }}">
                            @error('nationalite')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- Sexe --}}
                        <div class="col-md-4 mb-3">
                            <label for="sexe" class="form-label fw-bold">Sexe</label>
                            <select name="sexe" id="sexe" class="form-select @error('sexe') is-invalid @enderror" required>
                                <option value="Masculin" {{ old('sexe', $eleve->sexe) == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                                <option value="Féminin" {{ old('sexe', $eleve->sexe) == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                            </select>
                            @error('sexe')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Classe --}}
                        <div class="col-md-4 mb-3">
                            <label for="classe" class="form-label fw-bold">Classe</label>
                            <input type="text" name="classe" id="classe" class="form-control fw-bold text-success @error('classe') is-invalid @enderror" value="{{ old('classe', $eleve->classe) }}" required>
                            @error('classe')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Statut Affecté --}}
                        <div class="col-md-4 mb-3">
                            <label for="affecte" class="form-label fw-bold">Statut Affecté</label>
                            <select name="affecte" id="affecte" class="form-select @error('affecte') is-invalid @enderror" required>
                                <option value="1" {{ old('affecte', $eleve->affecte) ? 'selected' : '' }}>Affecté</option>
                                <option value="0" {{ !old('affecte', $eleve->affecte) ? 'selected' : '' }}>Non Affecté</option>
                            </select>
                            @error('affecte')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <h4 class="mb-4 mt-4 text-primary border-bottom pb-2">Coordonnées et Photo</h4>

                    <div class="row">
                        {{-- Téléphone Tuteur --}}
                        <div class="col-md-6 mb-3">
                            <label for="tuteur_telephone" class="form-label fw-bold">Téléphone</label>
                            <input type="text" name="tuteur_telephone" id="tuteur_telephone" class="form-control @error('tuteur_telephone') is-invalid @enderror" value="{{ old('tuteur_telephone', $eleve->tuteur_telephone) }}" required>
                            @error('tuteur_telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Email Tuteur --}}
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label fw-bold">Email (Optionnel)</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $eleve->email) }}">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    
                    {{-- Photo Actuelle et Champ de Téléchargement --}}
                    <div class="mb-4">
                        <label for="photo_url" class="form-label fw-bold d-block">Photo de l'élève (pour un bon Affichage, la photo doit avoir une resolution 480X661)</label>
                        @if ($eleve->photo_url)
                            <p class="text-muted small">Photo actuelle :</p>
                            <img src="{{ asset('storage/' . $eleve->photo_url) }}" alt="Photo actuelle" class="rounded-3 shadow-sm mb-2" style="max-width: 150px; height: auto;">
                        @else
                            <p class="text-danger small">Aucune photo enregistrée.</p>
                        @endif
                        <input type="file" name="photo_url" id="photo_url" class="form-control @error('photo_url') is-invalid @enderror">
                        <div class="form-text">Laissez vide pour conserver la photo actuelle. Max 2MB.</div>
                        @error('photo_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Boutons d'action --}}
                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('eleve.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-arrow-left me-2"></i> Annuler et Retour
                        </a>
                        <button type="submit" class="btn btn-warning btn-lg shadow-sm">
                            <i class="fas fa-save me-2"></i> Enregistrer les Modifications
                        </button>
                    </div>

                </form>

            </div> {{-- Fin card-body --}}
        </div> {{-- Fin card --}}
    </div>
</div>


</div>
@endsection