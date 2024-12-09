FROM debian

# Prima fase: installazione pacchetti
RUN apt-get update
RUN apt-get upgrade
RUN apt-get install php -y
RUN apt-get install php8.2-zip php8.2-mysql php8.2-gd php8.2-xml php8.2-curl php8.2-mbstring -y
RUN apt-get install composer -y 
RUN apt-get install npm -y

# Creazione directory per gli script
RUN mkdir -p /scripts
RUN mkdir -p /home/public/dnd

# Copia degli script nella directory dedicata
COPY init-container.sh /scripts/
COPY entrypoint.sh /scripts/
RUN chmod +x /scripts/init-container.sh /scripts/entrypoint.sh

# Imposta la workdir
WORKDIR /home/public/dnd
VOLUME /home/public/dnd

EXPOSE 8002

# Imposta entrypoint.sh come punto di ingresso
ENTRYPOINT ["/scripts/entrypoint.sh"]