Liste des caractéristiques
==========================
- il permettra de Choisir le Profil Utilisateur (Admin ou Owner)
- il permettra d'importer une Bibliothèque Csv de Titres et d'Interprètes
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

Division du problème en Modules
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
    - InterpreterManager
    - TitleManager
- Linker : permettra de lier l'Interpreter au Title et enfin au File
- HistoricalManager : gérer et afficher l'historique des Uploads de File
- ProfileManager : gérer les profils utilisateurs
- FileLister : liste tous les File
- Filter : filtre
    - FilterPerOwner
- SearchEngine

Exigences
=========
- Admin :
    - charger la banque de données : Interpreter et Title
    - peuvent modifier et supprimer ces données
    - accés aux modules :
        - InterpreterManager
        - TitleManager
        - FileLister
        - SearchEngine
- Owner :
    - uploader son fichier
    - qualifier son fichier : définir Title, et Interpreter
    - valider le fichier
    - accés aux modules :
        - Uploader
        - Validator
        - FileLister
        - FilterPerOwner
        - SearchEngine
- File:
    - name:
        type: varchar
        length: 255
        required: true
        default: notNull
    - interpreter:
        type: Interpreter
        required: false
        default: null
    - title:
        type: Title
        required: false
        default: null

- Interpreter:
    - isOriginalInterpreter:
        type:boolean
        default:false
    - name:
        type:varchar,
        length: 100,
        required: true,
        default: notNull,
    - lastname:
        type:varchar,
        length: 50,
        required: true,
        default: notNull,
- Title:

    - name:
        type:varchar,
        length: 250,
        required: true,
        default: notnull,
    - interpreter:
        type:Interpreter,
        required: true,
        default: notnull,
    - year:
        type: string,
        requirement: [1900 - 2100],
- Relations:
    - ManyToMany : Title - Interpreter
    - OneToOne:
        - File - Interpreter
        - File - Title