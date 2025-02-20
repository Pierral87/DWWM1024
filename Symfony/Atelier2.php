<?php 

// ATELIER 2 : 

/*

    Continuez le projet BiblioSF6 ! 
    Création de l'entité emprunt, table emprunt, système des emprunts 
    ATTENTION le ManyToMany n'est pas un bon choix ici, il va falloir créer l'entité Emprunt et à partir de cette entité, créer deux relations ManyToOne/OneToMany 

    -- 1 Création de l'entité Emprunt avec ses relations entre Abonne et Livre 
    -- 2 Créer le CRUD d'emprunt, routes accessibles uniquement à l'admin (attention au crud au formType avec les divers EntityType)
    -- 3 Après avoir terminé, faites un controller Profil pour les routes concernant les abonnés ROLE_LECTEUR (modifier l'inscription utilisateur pour définir par défaut le ROLE_LECTEUR), pour afficher le profil de l'abonné, ainsi que tous les emprunts qu'il a déjà effectués - Lorsqu'on se connecte on se retrouve automatiquement sur cette page profil 


*/