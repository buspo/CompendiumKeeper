# Sequence of shell commando for host in docker
Ther is two different mode. One for the fist run and one for the other run.
## Run first time
1. Set file .env
2. Set file ./Docker/CompendiumKeeper with nginx configuration (remember to insert the correct version of the php-fpm package in the configuration file)
3. `cd Docker`
4. `docker build -t compendiumkeeperimage .`
5. `cd ..`
6. `docker run --name CompendiumKeeperContainer -p 80:80 -v ./:/var/www/CompendiumKeeper  compendiumkeeperimage`
## Second run
1. `docker start -i CompendiumKeeperContainer`

## Other functionality
The first run include a section for initialization of laravel poject
### Repeat the initialization without deleting the container
`docker exec CompendiumKeeperContainer rm /scripts/.initialized`
### Execute commands inside the container
`docker exec -it CompendiumKeeperContainer <command>`
