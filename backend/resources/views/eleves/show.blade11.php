@extends('layouts.app')

@section('content')

<div class="container py-5">
<div class="row justify-content-center">
<div class="col-md-10 col-lg-8">
<div class="card shadow-lg border-0 rounded-4">

            {{-- Message de Succès/Erreur --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-0 rounded-top-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-0 rounded-top-4" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Entête inspirée de la carte d'accès --}}
            <div class="card-header bg-primary text-white py-3 rounded-top-4">
                <h3 class="mb-0 text-center fw-bold">FICHE DÉTAILS DE L'ÉLÈVE</h3>
                <p class="text-center mb-0">Renseignements complets et actions de gestion.</p>
            </div>
            
            <div class="card-body p-4 p-md-5">

                <div class="row">
                    
                    {{-- COLONNE 1 : Photo et Actions --}}
                    <div class="col-md-4 text-center mb-4 mb-md-0"> 
                        {{-- Photo de l'élève --}}
                        
                        {{-- Section Actions Rapides --}}
                        <h6 class="mt-4 text-primary border-bottom pb-1">Actions Rapides</h6>
                        <div class="d-grid gap-2">
                            
                            {{-- BOUTON 2 : Carte d'Accès PDF (Route: eleve.download.card) --}}
                            <a href="{{ route('eleve.download.card', $eleve) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-id-card me-2"></i> Générer Carte (PDF)
                            </a>

                            {{-- Bouton de Modification --}}
                            <a href="{{ route('eleve.edit', $eleve) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit me-2"></i> Modifier les Infos
                            </a>
                            
                            {{-- Bouton de Retour à la liste --}}
                            <a href="{{ route('eleve.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left me-2"></i> Retour à la Liste
                            </a>
                        </div>
                    </div>

                    {{-- COLONNE 2 : Informations Détaillées --}}
                    <div class="col-md-8">
                        <h4 class="mb-4 text-primary border-bottom pb-2">Informations Principales</h4>

                        <dl class="row detail-list">
                            <dt class="col-sm-4">Matricule :</dt>
                            <dd class="col-sm-8 fw-bold text-dark">{{ $eleve->matricule }}</dd>

                            <dt class="col-sm-4">Nom & Prénoms :</dt>
                            <dd class="col-sm-8">{{ $eleve->nom }} {{ $eleve->prenoms }}</dd>

                            <dt class="col-sm-4">Date de Naissance :</dt>
                            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($eleve->date_naissance)->format('d/m/Y') }}</dd>
                            
                            <dt class="col-sm-4">Lieu de Naissance :</dt>
                            <dd class="col-sm-8">{{ $eleve->lieu_naissance ?? 'Non spécifié' }}</dd>
                            
                            <dt class="col-sm-4">Nationalité :</dt>
                            <dd class="col-sm-8">{{ $eleve->nationalite ?? 'Non spécifiée' }}</dd>
                            
                            <dt class="col-sm-4">Sexe :</dt>
                            <dd class="col-sm-8">{{ $eleve->sexe }}</dd>

                            <dt class="col-sm-4">Classe :</dt>
                            <dd class="col-sm-8 fw-bold text-success">{{ $eleve->classe }}</dd>
                            
                            <dt class="col-sm-4">Statut Affecté :</dt>
                            <dd class="col-sm-8">
                                <span class="badge {{ $eleve->affecte ? 'bg-success' : 'bg-danger' }}">
                                    {{ $eleve->affecte ? 'Affecté' : 'Non Affecté' }}
                                </span>
                            </dd>
                        </dl>
                        
                        <h4 class="mb-4 mt-4 text-primary border-bottom pb-2">Coordonnées</h4>

                        <dl class="row detail-list">
                            <dt class="col-sm-4">Téléphone :</dt>
                            <dd class="col-sm-8">{{ $eleve->tuteur_telephone }}</dd>

                            <dt class="col-sm-4">Email :</dt>
                            <dd class="col-sm-8">{{ $eleve->email ?? 'Non spécifié' }}</dd>
                        </dl>
                        
                    </div> {{-- Fin Col-md-8 --}}
                </div> {{-- Fin Row --}}

            </div> {{-- Fin card-body --}}
        </div> {{-- Fin card --}}
    </div>
</div>


</div>
@endsection