# Installation avec Docker

L'installation se fait avec Docker et la commande `docker-compose`.

Nous avons simplifier l'exécution des commandes dans un Makefile. Si vous n'avez la commande `make` de disponible, un script `run.sh` est disponible pour lancer les conteneurs.

## Initialisation des conteneurs

Avec `make`:
```shell
make init
```

Avec le script shell:
```
./run.sh
```

Le lancement peut prendre un peu de temps la première fois puisqu'il crée une image Docker pour PHP personnalisée.

Après cela, le site devrait être disponible à l'adresse : [http://localhost:8080](http://localhost:8080). La base de données MySQL est aussi disponible en local sur le port `33060`.

[phpMyAdmin]() est aussi disponible à l'adresse: [http://localhost:8100](http://localhost:8100). Il permet de manager la DB plus facilement.

## Initilisation de la base de données

De base après la première installation, la base de données est créer mais vide. Il est possible de l'initialiser en se rendant sur la page d'accueil: [http://localhost:8080](http://localhost:8080) et cliquer sur le bouton `Initialize database`. Si cela n'est pas disponible, le script [DB.php](http://localhost:8080/DB.php) peut être accédé manuellement.

## Arrêt des conteneurs

Pour stopper les conteneurs, il suffit de faire :
```shell
# Makefile
make stop

# Ou avec le script shell
./stop.sh
```

Pour nettoyer les conteneurs et supprimer toutes les données et volumes, il suffit de faire :
```shell
# Makefile
make clean

# Ou avec le script shell
./clean.sh
```