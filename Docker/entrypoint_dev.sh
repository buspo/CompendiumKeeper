#!/bin/bash
# entrypoint.sh - Script eseguito ad ogni avvio

# Esegui lo script di inizializzazione
/scripts/init-container_dev.sh

# Assicurati di essere nella workdir corretta
cd /home/public/CompendiumKeeper

# Comandi da eseguire ad ogni avvio del container
echo "Avvio del container..."
php artisan serve --host=0.0.0.0 --port=8002

# Esegui eventuali comandi aggiuntivi passati al container
exec "$@"