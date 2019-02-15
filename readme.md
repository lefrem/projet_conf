# Projet de site web conférence

Ce projet a été réalisé par LEFRANCOIS Rémy et ROSSETTO Lucas

### Les points manquant

Un docker a été produit mais le projet a été développé sans. Il a été realisé en local , et en serveur , le logiciel laragon a été utilisé.

### Interprétation du projet

Pour ce projet , nous avons décidé de le faire de la manière suivante :

Le site à été construit en php procédural.

Le site comporte 3 grades : le grade 0 qui nous place en tant que user lambda, le grade 1 qui peut être assigné en tant qu'admin ou modérateur puis le grade 2 qui est le super admin.

Le user lambda peut simplement naviger sur le site pour voir les conférences et voter pour les conférences.
L'admin/modérateur peut remove des users (non admin) et créer des conférences votées. 

### Description des fonctionnalités

L'user connecté au site peut avoir accés depuis l'index , aux dernières conférences publiées.
Il peut : - Sélectionner une conférence pour noter celle-ci.
          - Cliquer sur l'auteur d'une conférence pour visionner son profil.
          - Accéder au top 10 des conférences (c'est à dire , les conférences les mieux notées).
          - Trier par conférences notées / non notées

Le modérateur/admin quant à lui , peut créer une conférence et l'éditer ainsi que supprimer des users.
Le super admin peut promouvoir / supprimer des admins , des conférences et remove les droits d'un utilisateur du site.

### Info 

Etant donné que nous n'avons pas utilisé docker pour le projet , nous avons la nécessité de crée un user et de changer son rôle en super admin manuellement dans la base de données pour attribuer les droits. 
