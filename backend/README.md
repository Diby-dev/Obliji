# Obliji - Backend Laravel REST API

API REST de gestion de tâches ménagères développée avec Laravel, conçue pour être déployée sur **Render** et connectée à **PostgreSQL sur Neon**.

---

## 1. Configuration Base de Données (Neon PostgreSQL)

Dans votre tableau de bord [Neon Console](https://console.neon.tech) :
1. Créez votre projet et récupérez votre chaîne de connexion.
2. Définissez les variables d'environnement dans votre fichier `.env` local ou dans l'onglet **Environment Variables** de Render :

```env
DB_CONNECTION=pgsql
DB_HOST=ep-example-xxxxxx.eu-central-1.aws.neon.tech
DB_PORT=5432
DB_DATABASE=neondb
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
DB_SSLMODE=require
```

*Note : Vous pouvez également utiliser directement `DATABASE_URL` (format standard Render) :*
```env
DATABASE_URL=postgresql://user:password@ep-example-xxxxxx.eu-central-1.aws.neon.tech/neondb?sslmode=require
```

---

## 2. Déploiement sur Render

1. Créez un nouveau **Web Service** connecté à votre dépôt Git.
2. Spécifiez l'environnement d'exécution : **PHP / Docker** ou configurez la commande de démarrage :
   ```bash
   composer install --no-dev --optimize-autoloader
   php artisan config:cache
   php artisan route:cache
   php artisan migrate --force
   ```
3. Commande de démarrage (Start Command) :
   ```bash
   php artisan serve --host 0.0.0.0 --port $PORT
   ```
   ou via Nginx/Apache selon votre Dockerfile.

---

## 3. Endpoints API Principaux

| Méthode | Route | Accès | Description |
|---|---|---|---|
| `POST` | `/api/login` | Public | Authentification et émission du Bearer Token |
| `POST` | `/api/logout` | Connecté | Révocation du Bearer Token |
| `GET` | `/api/me` | Connecté | Profil utilisateur connecté |
| `GET` | `/api/taches` | Connecté | Liste des tâches |
| `POST` | `/api/taches` | **Admin** | Création d'une nouvelle tâche |
| `GET` | `/api/assignations` | Connecté | Liste des assignations (filtrée par rôle) |
| `POST` | `/api/assignations` | **Admin** | Assigner une tâche à un ménager |
| `PATCH` | `/api/assignations/{id}/statut` | Connecté | Mise à jour du statut (`a_faire`, `en_cours`, `termine`) |
| `GET` | `/api/dashboard/admin` | **Admin** | Statistiques complètes avec ratio de complétion par ménager |
| `GET` | `/api/dashboard/menager` | **Ménager** | Statistiques personnelles et tâches actives |
