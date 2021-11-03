# Pricing

Outils utilisés :
  - Docker
  - PHP
  - MySQL

Guide d'installation :
  - Il faut d'abord commencer par l'installation de Docker. L'utilisation de Docker est motivé par le fait qu'avec on crée un env' ISO pour éviter
    tout problème colision entre versions et pour ne pas avoir à installer tous les outils de développement (PHP, MySQL...).
    Ainsi, il suffirai de démarrer quelques commandes et l'env' sera UP et opérationnel.
    On notera l'ajout de l'utilitaire Adminer qui permettra à l'admin' de visualiser et manipuler la base de données

  Voici la liste des commandes nécessaires pour mettre en place l'env' du projet.
   - docker-compose build
   - docker-compose up
   - docker exec -it php bash
   - bin/console d: m:m
   
   Populate de la base de données : j'ai fais le chois de le faire avec des migration.

Description des choix techniques :

Swagger : l'utilisation de Swagger pour générer une documentation détaillée et de la visualisée dans une interface graphique en se basant sur la spécification OpenAPI.

Validation : pour la stratégie de validation des attributs j'ai opté pour le valueObject afin de transmettre les données d'entré au composant Validator de Symfony.

Stratégie : j'ai choisis de mettre les 2 variables (x,y) de la stratégie comme paramétre et comme injection par un bind dans le service.yaml.
    
PHPUnit : utilitaire de test unitaire pour assurer la qualité de code.

ApiDoc :
- Url : http://localhost:8080/api/doc

Adminer : 
- Url :  http://localhost:8000
- Utilisateur : MYSQL_USER
- Mot de passe : MYSQL_PASSWORD
