# Obliji - Frontend Flutter (Dark Mode Épuré)

Application mobile et web multiplateforme pour la gestion des tâches ménagères, conçue avec Flutter et stylisée selon un design **Dark Mode haut de gamme**.

---

## 1. Fonctionnalités Clés

- **Thème Sombre Haut de Gamme** : Palette de contrastes épurés (`#0F1117`, `#1A1D26`, accents Cyan `#38BDF8` et Émeraude `#10B981`).
- **Cartes Sans Dépendances Visuelles** : Gestion des images laissée vide (`imageUrl: ''`) avec avatars calculés à partir des initiales et icônes Material modernes.
- **Tableau de Bord Administrateur** :
  - Métriques globales en temps réel (taux global, total ménagers, tâches validées).
  - Cartes individuelles pour chaque ménager avec un **`LinearProgressIndicator` dynamique** et le pourcentage exact calculé.
  - Décompte par statut (`À faire`, `En cours`, `Terminées`).
- **Tableau de Bord Ménager** :
  - Synthèse de progression personnelle.
  - Filtres par statut (`Toutes`, `À faire`, `En cours`, `Terminées`).
  - Carte de tâche détaillée avec **bascule immédiate du statut** (`À faire` -> `En cours` -> `Terminé`).

---

## 2. Configuration de l'API Backend

Modifiez l'URL de votre API Laravel dans le fichier `lib/core/constants/api_constants.dart` :

```dart
// Pour tester en local avec l'émulateur Android :
static const String baseUrl = 'http://10.0.2.2:8000/api';

// Pour tester sur le Web ou macOS/Windows :
static const String baseUrl = 'http://localhost:8000/api';

// Pour votre déploiement Render en production :
static const String baseUrl = 'https://votre-service-render.onrender.com/api';
```

---

## 3. Commandes de Démarrage

Installez les dépendances :
```bash
flutter pub get
```

Lancez l'application sur votre cible préférée :
- **Navigateur Web (Chrome)** :
  ```bash
  flutter run -d chrome
  ```
- **Émulateur Android** :
  ```bash
  flutter run -d android
  ```
- **Simulateur iOS** :
  ```bash
  flutter run -d ios
  ```
