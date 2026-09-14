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
/ S'assurer que le contenu du formulaire a un fond blanc pour la lisibilité /
.card {
background-color: rgba(255, 255, 255, 0.95) !important; / Ajoute un fond blanc semi-transparent */
}

.profile-photo {
width: 150px;
height: 150px;
object-fit: cover;
border: 5px solid #0d6efd; / Bordure primaire */
}

.detail-list dt {
color: #495057; / Texte gris pour les titres /
font-weight: 500;
}
.detail-list dd {
font-weight: 600;
color: #212529; / Texte foncé pour les valeurs /
margin-bottom: 8px; / Espacement entre les lignes de détail */
}
</style>

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
            <h3 class="mb-0 text-center fw-bold">DÉTAILS DE L'ÉLÈVE</h3>
            <p class="text-center mb-0">Renseignements complets et actions de gestion.</p>
        </div>
        
        <div class="card-body p-4 p-md-5">

            <div class="row">
                
                {{-- COLONNE 1 : Photo et Actions --}}
                <div class="col-md-4 text-center mb-4 mb-md-0 border-end"> 
                    
                    {{-- Affichage de la Photo de l'élève --}}
                    <div class="mb-4">
                        @if ($eleve->photo_url)
                            <img src="{{ asset('storage/' . $eleve->photo_url) }}" 
                                 alt="{{ $eleve->nom }}" 
                                 class="rounded-circle profile-photo shadow">
                        @else
                            <i class="fas fa-user-circle fa-5x text-muted border border-primary rounded-circle p-2"></i>
                            <p class="mt-2 text-muted small">Photo non disponible</p>
                        @endif
                    </div>

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
                    
                    {{-- SECTION 1 : Informations Principales --}}
                    <h4 class="mb-4 text-primary border-bottom pb-2"><i class="fas fa-user-tag me-2"></i> Identité de l'élève</h4>

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

                        <dt class="col-sm-4">Téléphone:</dt>
                        <dd class="col-sm-8">{{ $eleve->tuteur_telephone ?? 'Non spécifié' }}</dd>
                        
                       {{-- <dt class="col-sm-4">Dernière École :</dt>
                        <dd class="col-sm-8">{{ $eleve->ancienne_ecole ?? 'Non spécifiée' }}</dd>--}}
                    </dl>
                    
                    {{-- SECTION 2 : Statut et Affectation --}}
                    <h4 class="mb-4 mt-4 text-primary border-bottom pb-2"><i class="fas fa-school me-2"></i> Statut Scolaire & Options</h4>

                    <dl class="row detail-list">
                        <dt class="col-sm-4">Statut Affecté :</dt>
                        <dd class="col-sm-8">
                            <span class="badge rounded-pill p-2 {{ $eleve->affecte ? 'bg-success' : 'bg-danger' }}">
                                {{ $eleve->affecte ? 'Affecté' : 'Non Affecté' }}
                            </span>
                        </dd>
                        
                        <dt class="col-sm-4">Redoublement :</dt>
                        <dd class="col-sm-8">
                            <span class="badge rounded-pill p-2 {{ $eleve->redouble ? 'bg-danger' : 'bg-info' }}">
                                {{ $eleve->redouble ? 'Oui' : 'Non' }}
                            </span>
                        </dd>

                        <dt class="col-sm-4">Classe Actuelle :</dt>
                        <dd class="col-sm-8 fw-bold {{ $eleve->classe ? 'text-success' : 'text-danger' }}">
                            {{-- Utiliser la relation Eloquent pour afficher le nom de la classe --}}
                            {{ $eleve->classe->nom_classe ?? 'Non Affecté' }}
                        </dd>

                        <dt class="col-sm-4">Classe Précédente :</dt>
                        {{-- CORRECTION : Utilisation de preced_classe au lieu de classe_precedente --}}
                        <dd class="col-sm-8">{{ $eleve->preced_classe ?? 'Non spécifiée' }}</dd>

                        <dt class="col-sm-4">LV2 (Langue Vivante 2) :</dt>
                        <dd class="col-sm-8">{{ $eleve->lv2 ?? 'Non spécifiée' }}</dd>

                        <dt class="col-sm-4">Option Artistique :</dt>
                        {{-- CORRECTION : Utilisation de ap_mu au lieu de option_artistique --}}
                        <dd class="col-sm-8">{{ $eleve->ap_mu ?? 'Non spécifiée' }}</dd>
                    </dl>
                    
                </div> {{-- Fin Col-md-8 --}}
            </div> {{-- Fin Row --}}

        </div> {{-- Fin card-body --}}
    </div> {{-- Fin card --}}
</div>


</div>

</div>
@endsection