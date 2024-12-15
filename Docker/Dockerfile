FROM debian

# Prima fase: installazione pacchetti
RUN apt-get update
RUN apt-get upgrade
RUN apt-get install php -y
RUN apt-get install php8.2-zip php8.2-mysql php8.2-gd php8.2-xml php8.2-curl php8.2-mbstring php8.2-gmp php8.2-fpm php8.2-xml php8.2-bcmath -y
RUN apt-get install composer -y 
RUN apt-get install npm -y
RUN apt-get install nginx -y

# Creazione directory per gli script
RUN mkdir -p /scripts
RUN mkdir -p /var/www/CompendiumKeeper

# Copia degli script nella directory dedicata
COPY init-container.sh /scripts/
COPY entrypoint.sh /scripts/
RUN chmod +x /scripts/init-container.sh /scripts/entrypoint.sh

# Set di nginx
# Set ningix configuration
COPY CompendiumKeeper /etc/nginx/sites-available/
RUN rm -f /etc/nginx/sites-enabled/default
RUN ln -s /etc/nginx/sites-available/CompendiumKeeper /etc/nginx/sites-enabled/

# Imposta la workdir
WORKDIR /var/www/CompendiumKeeper
VOLUME /var/www/CompendiumKeeper

EXPOSE 80

# Imposta entrypoint.sh come punto di ingresso
ENTRYPOINT ["/scripts/entrypoint.sh"]