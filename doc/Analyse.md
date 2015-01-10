Liste des caractéristiques
==========================
- il permettra de Choisir le Profil Utilisateur (Gestionnaire ou Auteur)
- il permettra d'importer une Bibliothèque Excel de Titres et d'Interprètes
- il permettra d'Uploader un Fichier
- il devra lancer une Analyse Automatique du Fichier en fonction de son Nom
- il permettra de Valider la Qualification du Fichier
- il permettra de Modifier les Caractéristiques du Fichier
- il permettra de Gérer les Interprètes
- il permettra de Gérer les Titres
- il permettra de Gérer les Liens entre Interprètes et Titres
- il permettra de Gérer un Historique des Chargements

Diagramme de cas d'utilisations
===============================
- voir le fichier UseCase.uml

Division le problème en Modules
=================================
- Tests : pour les tests unitaires et fonctionnels
- Loader : pour importer la banque des données
- Uploader : pour gérer l'upload des fichiers
- Analyzer : analyse le fichier
- Validator : permettra de qualifier le fichier uploadé
- File : le fichier lui-même
- Interpreter : l'interprète
- Title : le titre
- ElementManager : permettra de gérer les Interpreter et les Title
- Linker : permettra de lier l'Interpreter au Title et enfin au File
- HistoricalManager : gérer et afficher l'historique des File
- ProfileManager : gérer les profils utilisateurs

Exigences
=========
