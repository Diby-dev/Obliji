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
        <div class="card-header bg-success text-white py-3 rounded-top-4" style="background-color: #198754 !important;">
          <h4 class="mb-0 text-center font-weight-bold">Formulaire d'enregistrement d'un nouvel élève</h4>
          <p class="text-center mb-0">Renseignements à remplir.</p>
        </div>
        
        <div class="card-body p-4 p-md-5">

          @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          
          @if ($errors->any())
            <div class="alert alert-danger" role="alert">
              Veuillez corriger les erreurs ci-dessous avant de soumettre le formulaire.
            </div>
          @endif

          <form method="POST" action="{{ route('eleve.store') }}" enctype="multipart/form-data">
            @csrf
            
            {{-- CHAMP AFFECTE DÉFINI PAR DÉFAUT (Non affecté) --}}
            <input type="hidden" name="affecte" value="0"> 

            {{-- ======================================================= --}}
            {{-- SECTION 1: INFORMATIONS PERSONNELLES DE L'ÉLÈVE --}}
            {{-- ======================================================= --}}
            <h5 class="mb-4 text-success border-bottom pb-2">1. Identification de l'Élève</h5>

            <div class="row mb-3">
              {{-- MATRICULE --}}
              <div class="col-md-6 mb-3 mb-md-0">
                <label for="matricule" class="form-label">Matricule <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('matricule') is-invalid @enderror" id="matricule" name="matricule" value="{{ old('matricule') }}" placeholder="Ex: Entrez le matricule">
                @error('matricule')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>

              {{-- NOM --}}
              <div class="col-md-6">
                <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                @error('nom')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              {{-- PRÉNOMS --}}
              <div class="col-md-6 mb-3 mb-md-0">
                <label for="prenoms" class="form-label">Prénoms <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('prenoms') is-invalid @enderror" id="prenoms" name="prenoms" value="{{ old('prenoms') }}" required>
                @error('prenoms')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>

              {{-- SEXE --}}
              <div class="col-md-6">
                <label for="sexe" class="form-label">Sexe <span class="text-danger">*</span></label>
                <select class="form-select @error('sexe') is-invalid @enderror" id="sexe" name="sexe" required>
                  <option value="">Sélectionner le sexe</option>
                  <option value="Masculin" {{ old('sexe') == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                  <option value="Féminin" {{ old('sexe') == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                </select>
                @error('sexe')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>
            </div>

            <div class="row mb-4">
              {{-- DATE DE NAISSANCE --}}
              <div class="col-md-4 mb-3 mb-md-0">
                <label for="date_naissance" class="form-label">Date de Naissance<span class="text-danger">*</span></label>
                <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>
                @error('date_naissance')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>

              {{-- LIEU DE NAISSANCE --}}
              <div class="col-md-4 mb-3 mb-md-0">
                <label for="lieu_naissance" class="form-label">Lieu de Naissance</label>
                <input type="text" class="form-control @error('lieu_naissance') is-invalid @enderror" id="lieu_naissance" name="lieu_naissance" value="{{ old('lieu_naissance') }}" placeholder="Ville">
                @error('lieu_naissance')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>

              {{-- NATIONALITÉ --}}
              <div class="col-md-4">
                <label for="nationalite" class="form-label">Nationalité</label>
                <input type="text" class="form-control @error('nationalite') is-invalid @enderror" id="nationalite" name="nationalite" value="{{ old('nationalite') }}" placeholder="Ex: Ivoirienne">
                @error('nationalite')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>
            </div>

            {{-- ======================================================= --}}
            {{-- SECTION 2: CONTACT & SCOLAIRE (MAJEUR) --}}
            {{-- ======================================================= --}}
            <h5 class="mb-4 mt-4 text-success border-bottom pb-2">2. Contact & Scolarité</h5>

            <div class="row mb-3">
              {{-- TÉLÉPHONE TUTEUR --}}
              <div class="col-md-6 mb-3 mb-md-0">
                <label for="tuteur_telephone" class="form-label">Téléphone<span class="text-danger">*</span></label>
                <input type="tel" class="form-control @error('tuteur_telephone') is-invalid @enderror" id="tuteur_telephone" name="tuteur_telephone" value="{{ old('tuteur_telephone') }}" placeholder="Ex: +225 07 00 00 00 00" required>
                @error('tuteur_telephone')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>

              {{-- EMAIL --}}
              <div class="col-md-6">
                <label for="email" class="form-label">Email (Optionnel)</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Ex: sarko@exemple.com">
                @error('email')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              {{-- CLASSE (SELECT) --}}
              <div class="col-md-4 mb-3 mb-md-0">
                <label for="classe_id" class="form-label">Classe<span class="text-danger">*</span></label>
                <select class="form-select @error('classe_id') is-invalid @enderror" id="classe_id" name="classe_id" required>
                  <option value="">Choisir la classe</option>
                  @foreach ($classes as $classe)
                    <option value="{{ $classe->id }}" {{ old('classe_id') == $classe->id ? 'selected' : '' }}>
                      {{ $classe->nom_classe }}
                    </option>
                  @endforeach
                </select>
                @error('classe_id')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>

              {{-- REDOUBLE --}}
              <div class="col-md-4 mb-3 mb-md-0">
                <label for="redouble" class="form-label">Statut (Optionnel)</label>
                <select class="form-select @error('redouble') is-invalid @enderror" id="redouble" name="redouble">
                  <option value="0" {{ old('redouble') === '0' || old('redouble') === null ? 'selected' : '' }}>nouveau</option>
                  <option value="1" {{ old('redouble') === '1' ? 'selected' : '' }}>Redoublant</option>
                </select>
                @error('redouble')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>
                            
                            {{-- CLASSE PRÉCÉDENTE --}}
                            <div class="col-md-4">
                                <label for="preced_classe" class="form-label">Classe Précédente</label>
                                <input type="text" class="form-control @error('preced_classe') is-invalid @enderror" id="preced_classe" name="preced_classe" value="{{ old('preced_classe') }}" placeholder="Ex: CM2 ou vide si nouveau">
                                @error('preced_classe')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
            </div>

                        <div class="row mb-4">
                            {{-- LV2 --}}
              <div class="col-md-6 mb-3 mb-md-0">
                                <label for="lv2" class="form-label">Langue Vivante 2 (Optionnel)</label>
                                <select class="form-select @error('lv2') is-invalid @enderror" id="lv2" name="lv2">
                                    <option value="">Sélectionner LV2 (Optionnel)</option>
                                    <option value="Espagnol" {{ old('lv2') == 'Espagnol' ? 'selected' : '' }}>Espagnol</option>
                                    <option value="Allemand" {{ old('lv2') == 'Allemand' ? 'selected' : '' }}>Allemand</option>
                                </select>
                                @error('lv2')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            {{-- AP/MU --}}
              <div class="col-md-6">
                                <label for="ap_mu" class="form-label">Option Artistique (Optionnel)</label>
                                <select class="form-select @error('ap_mu') is-invalid @enderror" id="ap_mu" name="ap_mu">
                                    <option value="">Sélectionner Option (Optionnel)</option>
                                    <option value="Arts Plastiques" {{ old('ap_mu') == 'Arts Plastiques' ? 'selected' : '' }}>Arts Plastiques</option>
                                    <option value="Musique" {{ old('ap_mu') == 'Musique' ? 'selected' : '' }}>Musique</option>
                                </select>
                                @error('ap_mu')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- ======================================================= --}}
            {{-- SECTION 3: PHOTO --}}
            {{-- ======================================================= --}}
                        <h5 class="mb-4 mt-4 text-success border-bottom pb-2">3. Photo d'Identité</h5>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label d-block">Photo d'Identité (Max 2MB, une résolution proche de 720x884 pour un bon Affichage sur la carte)</label>
                                
                                {{-- Bouton pour ouvrir le sélecteur de fichier classique --}}
                                <button type="button" class="btn btn-outline-secondary mb-2" onclick="document.getElementById('photo_upload').click()">
                                    <i class="fas fa-upload me-2"></i> Choisir sur l'appareil
                                </button>
                                
                                {{-- Input file caché pour l'upload classique --}}
                                <input type="file" 
                                    class="form-control @error('photo_url') is-invalid @enderror d-none" 
                                    id="photo_upload" 
                                    name="photo_url"
                                    accept="image/*"
                                    onchange="handleFileSelection(event)"> 
                                
                                {{-- Bouton pour ouvrir la caméra --}}
                                <button type="button" class="btn btn-outline-info mb-2" id="openCameraButton">
                                    <i class="fas fa-camera me-2"></i> Prendre une photo
                                </button>

                                {{-- Affichage de la caméra et du bouton de capture --}}
                                <div id="cameraContainer" style="display: none; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">
                                    <video id="videoElement" width="320" height="240" autoplay muted style="display: block; margin: auto;"></video>
                                    <button type="button" class="btn btn-success mt-2" id="captureButton" style="display: block; margin: auto;"><i class="fas fa-camera"></i> Capturer</button>
                                </div>

                                {{-- Canevas pour la capture d'image (masqué) --}}
                                <canvas id="canvasElement" width="320" height="240" style="display: none;"></canvas>

                                {{-- Champ caché qui contiendra les données de la photo capturée/uploadée --}}
                                <input type="hidden" name="photo_base64" id="final_photo_input">

                                {{-- Aperçu de l'image sélectionnée/capturée --}}
                                <div class="mt-3">
                                    <img id="image-preview" src="" alt="Aperçu de la photo" style="max-width: 150px; max-height: 150px; border: 1px solid #ddd; display: none;">
                                </div>

                                {{-- Correction de la variable d'erreur --}}
                                @error('photo_url')
                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                                @error('photo_base64')
                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>


            <div class="d-grid gap-2 mt-5">
              <button type="submit" class="btn btn-success btn-lg shadow-sm">
                <i class="fas fa-save me-2"></i> Enregistrer et Télécharger la Carte d'Accès
              </button>
            </div>
          </form>
          
          ---
          
          {{-- NOUVEAU : Bouton pour voir la liste des élèves (Accès Public) --}}
          <div class="text-center mt-4">
            <a href="{{ route('eleve.index') }}" class="btn btn-outline-primary btn-lg">
              <i class="fas fa-list me-2"></i> Voir la Liste des Élèves
            </a>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Éléments DOM
  const openCameraButton = document.getElementById('openCameraButton');
  const cameraContainer = document.getElementById('cameraContainer');
  const videoElement = document.getElementById('videoElement');
  const captureButton = document.getElementById('captureButton');
  const canvasElement = document.getElementById('canvasElement');
  const imagePreview = document.getElementById('image-preview');
  const finalPhotoInput = document.getElementById('final_photo_input');
  const photoUploadInput = document.getElementById('photo_upload');

  let currentStream; 

  // --- Fonction de Prévisualisation Générique ---
  function displayImagePreview(source) {
    imagePreview.src = source;
    imagePreview.style.display = 'block';
  }

  // --- Gestionnaire pour le champ d'upload classique ---
  window.handleFileSelection = function(event) {
    stopCamera(); 
    if (event.target.files.length > 0) {
      const file = event.target.files[0];
      const reader = new FileReader();
      reader.onload = function(e) {
        displayImagePreview(e.target.result);
        // Vider le champ caché pour forcer Laravel à utiliser l'upload du fichier classique.
        finalPhotoInput.value = ''; 
      };
      reader.readAsDataURL(file);
    } else {
      imagePreview.style.display = 'none';
    }
  }
  
  // --- Fonction pour arrêter le flux de la caméra ---
  function stopCamera() {
    if (currentStream) {
      currentStream.getTracks().forEach(track => track.stop());
      videoElement.srcObject = null;
    }
    cameraContainer.style.display = 'none'; 
    openCameraButton.textContent = 'Prendre une photo'; 
  }

  // --- Gérer l'ouverture/fermeture de la caméra ---
  openCameraButton.addEventListener('click', async () => {
    if (cameraContainer.style.display === 'block') {
      stopCamera();
      openCameraButton.textContent = 'Prendre une photo';
      return;
    }

    // Réinitialiser le champ d'upload PC (photo_url) et l'aperçu
    photoUploadInput.value = '';
    imagePreview.style.display = 'none'; 
    
    cameraContainer.style.display = 'block';
    openCameraButton.textContent = 'Fermer la caméra';
    
    try {
      const stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
      videoElement.srcObject = stream;
      currentStream = stream; 
      videoElement.play();
    } catch (err) {
      console.error("Erreur d'accès à la caméra: ", err);
      // Remplacer alert() par un message box ou un simple console.error
      console.error("Impossible d'accéder à la caméra. Assurez-vous d'avoir accordé la permission.");
      cameraContainer.style.display = 'none'; 
      openCameraButton.textContent = 'Prendre une photo'; 
    }
  });

  // --- Gérer la capture d'image depuis la caméra ---
  captureButton.addEventListener('click', () => {
    const context = canvasElement.getContext('2d');
    // Utilisez les dimensions de la vidéo pour dessiner l'image
    canvasElement.width = videoElement.videoWidth || 320;
    canvasElement.height = videoElement.videoHeight || 240;
    context.drawImage(videoElement, 0, 0, canvasElement.width, canvasElement.height);
    
    const imageDataURL = canvasElement.toDataURL('image/jpeg', 0.9);
    displayImagePreview(imageDataURL); 

    // Stocke l'image encodée en Base64 dans le champ caché
    finalPhotoInput.value = imageDataURL; 
    stopCamera(); 
  });

  // --- Assurez-vous d'arrêter la caméra quand on quitte la page ---
  window.addEventListener('beforeunload', stopCamera);
</script>
@endsection
