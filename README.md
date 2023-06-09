# Symfony 6 CQRS Blog

Dans le cadre de ma formation en autodidate et pour me preparer au différents entretiens que je devrais passer dans ma recherche d'emploi je me suis lancé comme défi de réaliser les base de une simple application de blog construite avec Symfony 6 en utilisant l'architecture CQRS. L'application démontre le processus de listage des articles et de l'affichage des détails d'un article ella possibilité d'écrire un nouveau article.

## Configuration requise

- PHP 7.4 ou supérieur
- Composer
- Node.js et Yarn (pour gérer les assets frontend)

## Installation

1. Clonez ce dépôt :

`git clone https://github.com/naglaa77/BLOG_CQRS_SYMFONY.git
cd symfony6-cqrs-blog `

2. Installez les dépendances PHP à l'aide de Composer :

`composer install`

3. Installez les dépendances frontend avec Yarn :

`yarn install'

4. Générez les assets frontend :

`yarn encore dev`

5. Configurez votre fichier .env avec les identifiants de la base de données corrects.

6. Créez la base de données et le schéma :

`php bin/console doctrine:database:create
php bin/console doctrine:schema:create
` 7. (Optionnel) Chargez les fixtures pour peupler la base de données avec des données d'exemple :

`php bin/console doctrine:fixtures:load`

## Lancement de l'application

Démarrez le serveur web intégré de Symfony :

`php bin/console server:run`

Visitez l'application dans votre navigateur à l'adresse http://127.0.0.1:8000/.

## Fonctionnalités

- Liste des articles sur la page d'accueil
- Affichage des détails d'un article sur une page séparée

## Technologies utilisées

- Symfony 6
- Doctrine ORM
- Twig
- Webpack Encore
- Bootstrap 5
- CQRS (Command Query Responsibility Segregation)

## Instructions

1. Installer Symfony 6
2. Créer un nouveau projet Symfony 6
3. Installer et configurer Doctrine ORM
4. Créer l'entité Article
5. Installer et configurer Webpack Encore
6. Installer et configurer Bootstrap 5
7. Créer la structure de dossiers CQRS et implémenter les classes Query et Handler
8. Créer et configurer le ArticleController
9. Créer les templates pour la liste des articles et les détails des articles
10. Mettre en forme les templates en utilisant Bootstrap
