# STI Projet2

**Auteurs:** Balsiger Gil, Barros Henriques Chris

**Date:** 24 janvier 2021


## Installation

L'installation du projet avec Docker est décrite dans le fichier [INSTALL.md](INSTALL.md). 


## Manuel Utilisateur

Repo du premier projet de STI. Le manuel d'utilisateur est disponible [ici](./STI_ManuelUtilisateur.md).

## Rapport
Le rapport pour ce projet est trouvable [ici](./rapport/STI_Projet2_Rapport_BalsigerGil_BarrosHenriquesChris.md).

## Différences d'infrastructure avec le projet 1

On a PHP-fpm qui est un service, on a Nginx qui est notre serveur et MySQL pour la base de données plutôt que SQLite. 



## Architecture des dossiers

- Le répertoire "site" contient deux sous-dossiers
  - Le dossier "classes" qui contient toutes les classes importantes pour l'implémentation des fonctionnalités principales
  - Le dossier "html" qui contient l'ensemble des pages du site ainsi que les fiches de style 
- Le fichier "Dockerfile" s'occupe de créer le service PHP
- Le fichier "docker-compose.yml" qui crée les volumes nécessaires et de lancer les différents conteneurs





