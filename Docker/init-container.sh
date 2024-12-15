#!/bin/bash
# init-container.sh - Script eseguito solo al primo avvio

# Verifica se è il primo avvio
INIT_FLAG="/scripts/.initialized"

if [ ! -f "$INIT_FLAG" ]; then
    echo "Eseguo inizializzazione primo avvio..."
    cd /var/www/CompendiumKeeper
    
    chown -R www-data:www-data /var/www/CompendiumKeeper/storage
    chown -R www-data:www-data /var/www/CompendiumKeeper/bootstrap/cache
    composer install
    php artisan key:generate
    #php artisan config:cache
    echo "Migrazione del db"
    php artisan migrate
    echo "Inizializzazione installazione pachetti nmp"
    npm install --save-dev vite laravel-vite-plugin
    npm install --save-dev @vitejs/plugin-vue
    npm install
    npm run build
    
    # Crea il file flag per indicare che l'inizializzazione è stata completata
    touch "$INIT_FLAG"
    echo "Inizializzazione completata."
fi