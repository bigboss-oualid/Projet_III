# Projet N°3 - Blog d'un écrivain

# Architecture 
+ **App** - Gestion du MVC
    + **Controllers** - Classes des controlleurs
    + **Models** - Classes des modèles
    + **Views** - Fichier des views
    + **index.php** - Routage
+ **public** - Dossier pour plugins et fichiers(css,js et jpeg)
+ **vendor** - Core de l'application
+ **.htaccess** - Fichiers de sécurite
+ **config.php** - Fichier de configuration
+ **index.php** - Fichiers de lancement de l'application

## Installation
1. Cloner ou cliquez ici pour le lancement de téléchargement du [projet](https://codeload.github.com/bigboss-oualid/Projet_III/zip/master "lien de téléchargement")
2. Installer Wamp sur votre ordinnateur 
3. Aller dans le dossier WWW
4. Créer un répertoire projet3
5. Copier tous les dossiers du répertoire téléchargé dans le dossier crée projet3 
6. Créer la base de données blog_ecrivain
    1. Se connecter à MySql
    2. Puis importer le fichier /DB/blog_ecrivain.sql
    4. si nécessaire  modifer l'accès à la base de données dans le fichier /config.php
    3. Sortir de MySql
7. Ouvrir la console et se placer dans le dossier projet3

## Fonctionnalitées

### Blog:
- Visualisation des épisodes du livre.
- Contacter jean forteroche (message rédiger avec interface WYSIWYG basée sur TinyMCE).
- Consulter la biographie de jean forteroche
- Ajout d'un nouveau commentaire ou signaler un commentaire éxistant 
- Lancer une Recherche dans les épisodes, chapitre ou Contenu
- Crée un compte utilisateur

### Administration:
- Boite aux lettres (voir, répondre ou supprimer emails)
- Gestion des chapitres
- Gestion des épisodes (contenu rédiger avec interface WYSIWYG basée sur TinyMCE)
- Gestion des commentaires        
- Gestion des utilisateurs
- Gestion des groupes des utilisateurs
- Paramétrage du site
- Gestion du profil d'utilisateur connecté
    
 ## Démo
 Allez sur le site: [Jean ForteRoche](https://projet3.it-bigboss.de/ "Jean Forteroche Blog")
