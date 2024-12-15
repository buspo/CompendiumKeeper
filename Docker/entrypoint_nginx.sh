#!/bin/bash
# entrypoint.sh - Script eseguito ad ogni avvio

# Esegui lo script di inizializzazione
/scripts/init-container.sh

# Assicurati di essere nella workdir corretta
cd /var/www/CompendiumKeeper

# Comandi da eseguire ad ogni avvio del container
echo "Avvio del container..."
#php artisan serve --host=0.0.0.0 --port=8002
#service nginx start
service php8.2-fpm start
nginx -g 'daemon off;'

# Esegui eventuali comandi aggiuntivi passati al container
exec "$@"
