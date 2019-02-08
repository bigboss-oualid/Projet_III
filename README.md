
ToDo:


+Création des classes suivantes
	-vendor\System\View\
		le dossier va contenir 3 classe ViewFactory.php, ViewInterface.php et View.php qui va implementer cette dérnière.

		-ViewFactory: va générer des objets de vue qui seront essentiellement gérer des fichiers HTML pour la vue.
		-View: elle sera responsable de l'appel des vues "fichiers contenant le code html "et de la transmission de certaines variables.
		
	-vendor\System\Http\Response.php
		Response: gérer toutes les réponses car les En-têtes et le contenu de nos page lui seront transmise pour l'afficher dans le navigateur
	-vendor\System\Databse
		Connexion à la base des données + gestion des données
	-vendor\System\Model
		classe abstraite, classe mère de toute les classes Model

		

Projet:CRÉER UN BLOG POUR UN ÉCRIVAIN

Jean Forteroche, acteur et écrivain. Il travaille actuellement sur son prochain roman, "Billet simple pour l'Alaska". Il souhaite innover et le publier par épisode en ligne sur son propre site.
Seul problème : Jean n'aime pas WordPress et souhaite avoir son propre outil de blog, offrant des fonctionnalités plus simples. Vous allez donc devoir développer un moteur de blog en PHP et MySQL.

Le livre de Jean Forteroche reste à écrire... mais il sera publié en ligne !

L'application de blog simple en PHP et avec une base de données MySQL. Elle doit fournir une interface frontend (lecture des billets) et une interface backend (administration des billets pour l'écriture). On doit y retrouver tous les éléments d'un CRUD :
Create : création de billets
Read : lecture de billets
Update : mise à jour de billets
Delete : suppression de billets
Chaque billet doit permettre l'ajout de commentaires, qui pourront être modérés dans l'interface d'administration au besoin.
Les lecteurs doivent pouvoir "signaler" les commentaires pour que ceux-ci remontent plus facilement dans l'interface d'administration pour être modérés.
L'interface d'administration sera protégée par mot de passe. La rédaction de billets se fera dans une interface WYSIWYG basée sur TinyMCE, pour que Jean n'ait pas besoin de rédiger son histoire en HTML (on comprend qu'il n'ait pas très envie !).
Vous développerez en PHP sans utiliser de framework pour vous familiariser avec les concepts de base de la programmation. Le code sera construit sur une architecture MVC. Vous développerez autant que possible en orienté objet (au minimum, le modèle doit être construit sous forme d'objet). 