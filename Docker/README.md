# Sequence of shell commando for host in docker
Ther is two different mode. One for the fist run and one for the other run.
## Run first time
1. Set file .env
2. `cd Docker`
3. `docker build -t compendiumkeeperimage .`
4. `cd ..`
5. `docker run --name CompendiumKeeperContainer -p 8002:8002 -v ./:/home/public/CompendiumKeeper  compendiumkeeperimage`
## Second run
1. `docker start -i CompendiumKeeperContainer`

## Other functionality
The first run include a section for initialization of laravel poject
### Repeat the initialization without deleting the container
`docker exec CompendiumKeeperContainer rm /scripts/.initialized`
### Execute commands inside the container
`docker exec -it CompendiumKeeperContainer <command>`
