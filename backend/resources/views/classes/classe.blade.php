@extends('layouts.app') 

@section('content')
<style>
 body {
            /* Assurez-vous que l'URL de l'image est correcte sur votre serveur */
            background-image: url("{{ asset('images/fond_ecole.jpg') }}");
            background-size: cover; 
            background-repeat: no-repeat; 
            background-attachment: fixed; 
            background-color: #ffffffff; 
        }
</style>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-3">
                
                {{-- DÉTERMINE LE TITRE ET L'ACTION DU FORMULAIRE --}}
                @php
                    // La variable $classe doit être passée par le contrôleur.
                    // Pour 'create', $classe est une nouvelle instance (elle n'existe pas dans la BDD).
                    // Pour 'edit', $classe est un modèle existant.
                    $isEdit = $classe->exists;
                    $title = $isEdit ? 'Modifier la Classe : ' . $classe->nom_classe : 'Ajouter une Nouvelle Classe';
                    // Assurez-vous que les routes 'classe.update' et 'classe.store' existent et fonctionnent.
                    $actionUrl = $isEdit ? route('classe.update', $classe) : route('classe.store');
                    $method = $isEdit ? 'PUT' : 'POST';
                @endphp
                
                <div class="card-header bg-primary text-white rounded-top">
                    <h3 class="mb-0">{{ $title }}</h3>
                </div>

                <div class="card-body p-4">
                    
                    {{-- Affichage des messages d'erreur --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h5 class="alert-heading">Erreurs de validation :</h5>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    {{-- FORMULAIRE --}}
                    <form method="POST" action="{{ $actionUrl }}">
                        @csrf
                        @method($method) {{-- Utilise PUT pour la modification --}}

                        {{-- 1. NOM DE LA CLASSE --}}
                        <div class="mb-3">
                            <label for="nom_classe" class="form-label fw-bold">Nom de la Classe <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                class="form-control @error('nom_classe') is-invalid @enderror" 
                                id="nom_classe" 
                                name="nom_classe" 
                                value="{{ old('nom_classe', $classe->nom_classe ?? '') }}" 
                                required 
                                placeholder="Ex: Sixième C, Terminale S"
                            >
                             @error('nom_classe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 2. TYPE DE CLASSE --}}
                        <div class="mb-3">
                            <label for="type_classe" class="form-label fw-bold">Type de Classe <span class="text-danger">*</span></label>
                            <select 
                                class="form-select @error('type_classe') is-invalid @enderror" 
                                id="type_classe" 
                                name="type_classe" 
                                required
                            >
                                <option value="" disabled selected>Sélectionner un type</option>
                                {{-- Les types suggérés sont passés par le contrôleur --}}
                                @php
                                    // Utiliser la valeur ancienne ou celle du modèle pour la sélection
                                    $currentType = old('type_classe', $classe->type_classe ?? '');
                                @endphp
                                @foreach($suggestedTypes as $type)
                                    <option value="{{ $type }}" {{ $currentType == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                                
                                {{-- Si le type de classe actuel n'est pas dans les suggérés, l'ajouter temporairement --}}
                                @if($currentType && !in_array($currentType, $suggestedTypes))
                                    <option value="{{ $currentType }}" selected>
                                        {{ $currentType }} (Actuel)
                                    </option>
                                @endif
                            </select>
                            @error('type_classe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Catégorie générale de la classe (ex: Collège, Lycée).
                            </small>
                        </div>
                        
                        {{-- 3. DESCRIPTION (Optionnel) 
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Description (Optionnel)</label>
                            <textarea 
                                class="form-control @error('description') is-invalid @enderror" 
                                id="description" 
                                name="description" 
                                rows="3" 
                                placeholder="Notes sur cette classe ou son niveau."
                            >{{ old('description', $classe->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>--}}

                        {{-- BOUTONS D'ACTION --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-save"></i> {{ $isEdit ? 'Enregistrer les Modifications' : 'Ajouter la Classe' }}
                            </button>
                            <a href="{{ route('classe.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle"></i> Annuler et Retourner à la Liste
                            </a>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection