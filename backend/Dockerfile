FROM php:8.2-fpm

# Installer les dépendances système et extensions PHP nécessaires pour Laravel et PostgreSQL
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip

# Nettoyer le cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer les extensions PHP pdo, pgsql et mbstring
RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail dans le conteneur
WORKDIR /var/www/html

# Copier le code source du backend
COPY . .

# Installer les dépendances Composer pour la production
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Donner les permissions nécessaires sur les dossiers de stockage et de cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exposer le port (Render utilise dynamiquement la variable PORT, on configure le démarrage)
EXPOSE 10000

# Commande de lancement (génère la config et démarre le serveur intégré PHP écoutant sur le port 10000 ou celui de Render)
CMD php artisan config:cache && php artisan route:cache && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}