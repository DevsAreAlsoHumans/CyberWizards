### Règle du hackathon
- **Pas d'utilisation d'IA (chaptgpt, gemini, etc...) mais les recherches Google autorisé (StackOverflow, php.net, etc...)**
- **Bonnes pratiques : règle de nommage, clareté du code...**
- **Architecture claire**
- **Séparation des responsabilités dans des fonctions**
- **Code propre (documenter le code de manière concise, pas de variable non utilisée)**
- **Bonne conduite : respect de vos camarades, de vos chefs de projet et respect des règles de bienséance**

---

### **1ère Itération (10 points) : Système de gestion d'utilisateur**

#### User stories :
- **En tant qu'utilisateur, je veux m'inscrire pour pouvoir créer un compte sur la plateforme.**
- **En tant qu'utilisateur, je veux me connecter pour accéder au site.**
- **En tant qu'utilisateur, je veux pouvoir me déconnecter pour sécuriser mon compte.**
- **En tant qu'utilisateur, je veux que mon mot de passe soit sécurisé via un hashage.**

#### Fonctionnalités :
- **Inscription** : Formulaire d'inscription avec nom, email, mot de passe.
- **Connexion** : Formulaire de connexion avec vérification des informations en base de données.
- **Déconnexion** : Bouton "Déconnexion" qui termine la session utilisateur.
- **Base de données** : Stockage des utilisateurs avec mots de passe hashés via `password_hash()`.

#### Structure des tables :
- **Table users** : `id`, `nom`, `prenom`, `date_de_naissance`,  `email`, `mot_de_passe`

#### Critères de notation (10 points) :
- Inscription et connexion fonctionnelles (6 points).
- Hashage des mots de passe (4 points).

---

### **2ème Itération (15 points) : Gestion des rôles, compte utilisateur et sécurité renforcée**

#### User stories :
- **En tant qu'utilisateur, je veux pouvoir avoir un ou plusieurs rôles attribués afin de gérer mes permissions.**
- **En tant qu'administrateur, je veux voir la liste des utilisateurs inscrits et leur rôle attribué.**
- **En tant qu'utilisateur, je veux pouvoir accéder à une page dédiée avec mes informations d'utilisateur.**
- **En tant qu'utilisateur, je veux pouvoir supprimer mon compte afin de quitter la plateforme.**
- **En tant qu'utilisateur, je veux que mes données soient protégées des attaques SQL.**
- **En tant qu'utilisateur, je veux que les erreurs dans le processus soient correctement gérées.**

#### Fonctionnalités :
- **Reprise de la 1ère itération** : Inscription, connexion, déconnexion avec hashage des mots de passe.
- **Ajout de rôles** :  
  - Création d'une nouvelle table `roles` qui contient les différents rôles (ex : user, admin).
  - Chaque utilisateur peut avoir un ou plusieurs rôles associés via une relation entre la table `users` et une table de liaison `user_roles`.
- **Requêtes préparées** : Toutes les interactions avec la base de données utilisent des requêtes préparées (`PDO` ou `mysqli`).
- **Page information d'utilisateur** : L'utilisateur peut accéder à une page dédiée pour obtenir ses informations et pouvoir effectuer des actions sur son compte.
- **Suppression de compte** : L'utilisateur peut supprimer son compte via un bouton.
- **Liste des utilisateurs** : Page d'administration listant les utilisateurs inscrits avec leurs rôles.
- **Gestion des erreurs** : Utilisation de `try-catch` pour capturer et traiter les erreurs SQL.

#### Structure des tables :
- **Table users** : `id`, `nom`, `prenom`, `date_de_naissance`,  `email`, `mot_de_passe`
- **Table roles** : `id`, `nom_role` (ex : user, admin)
- **Table user_roles** : `user_id` (clé étrangère vers `users`), `role_id` (clé étrangère vers `roles`)


#### Critères de notation (15 points) :
- Fonctionnalités de la première itération (6 points).
- Gestion des rôles avec table de liaison `user_roles` (5 points).
- Requêtes préparées (2 points).
- Suppression de compte (1 point).
- Affichage de la liste des utilisateurs (1 point).

---

### **3ème Itération (20 points) : Gestion des permissions et sécurité avancée**

#### User stories :
- **En tant qu'administrateur, je veux pouvoir attribuer des rôles aux utilisateurs afin de mieux contrôler l'accès aux fonctionnalités.**
- **En tant qu'utilisateur, je veux être protégé contre les attaques CSRF.**
- **En tant que développeur, je veux utiliser des expressions régulières pour valider les données utilisateur.**

#### Fonctionnalités :
- **Reprise des itérations précédentes** : Inscription, connexion, déconnexion, suppression de compte, gestion des rôles, requêtes préparées, gestion des erreurs, et liste des utilisateurs.
- **Ajout de permissions** :  
  - Création d'une nouvelle table `permissions` qui contient les différentes permissions.
  - Association des permissions aux rôles via une table de liaison `role_permissions`.
  - Gestion des accès et des actions en fonction des rôles et permissions attribués.
- **Validation avec Regex** : Validation des champs email et mot de passe via des expressions régulières.
- **Protection CSRF** : Intégration d'un token CSRF dans les formulaires sensibles pour protéger contre les attaques.

#### Structure des tables :
- **Table permissions** : `id`, `nom_permission` (ex : gérer_utilisateurs, modifier_contenu)
- **Table role_permissions** : `role_id` (clé étrangère vers `roles`), `permission_id` (clé étrangère vers `permissions`)

#### Critères de notation (20 points) :
- Fonctionnalités des itérations précédentes (10 points).
- Gestion des permissions avec table de liaison `role_permissions` (5 points).
- Validation via Regex (3 points).
- Protection CSRF (2 points).

---

### **4ème Itération (25 points) : Suspension de comptes, SMTP et reset de mot de passe**

#### User stories :
- **En tant qu'administrateur, je veux pouvoir suspendre ou réactiver les comptes des utilisateurs.**
- **En tant qu'utilisateur, je veux pouvoir avoir une image de profil.**
- **En tant qu'utilisateur, je veux pouvoir réinitialiser mon mot de passe en cas d'oubli.**
- **En tant qu'utilisateur, je veux recevoir un email avec des instructions pour réinitialiser mon mot de passe.**
- **En tant qu'administrateur, je veux pouvoir consulter un historique des actions des utilisateurs pour pouvoir tracer les modifications importantes.**
- **En tant qu'utilisateur, je veux être notifié en cas d'activité suspecte ou de suspension de mon compte.**

#### Fonctionnalités :
- **Reprise des itérations précédentes** : Inscription, connexion, déconnexion, suppression de compte, gestion des rôles, permissions, requêtes préparées, validation avec Regex, gestion des erreurs, protection CSRF, et liste des utilisateurs.
- **Suspension de comptes par les administrateurs** : 
  - Les administrateurs peuvent suspendre ou réactiver un compte utilisateur. 
  - Un utilisateur suspendu ne peut plus se connecter tant que son compte n'est pas réactivé.
  - Notification envoyée par email à l'utilisateur lorsqu'il est suspendu ou réactivé.
- **Image de profil** : 
  - L'utilisateur pourra ajouter une image de profil.
- **Réinitialisation de mot de passe** : 
  - Ajout d'un système de réinitialisation de mot de passe avec un lien sécurisé envoyé par email (via SMTP) avec un token et une durée maximum.
  - L'utilisateur pourra demander un reset de mot de passe et recevra un lien temporaire pour définir un nouveau mot de passe.
- **Système d'email (SMTP)** :
  - Intégration d'un service d'email via SMTP pour envoyer des notifications (ex : réinitialisation de mot de passe, compte suspendu, activité suspecte).
  - Configuration de modèles d'email personnalisés pour les différentes notifications envoyées aux utilisateurs.
- **Audit des actions** : Création d'une table `audit_logs` pour enregistrer les actions critiques des utilisateurs, comme la connexion, la suppression de compte, le changement de rôle, la suspension de compte, etc.

#### Structure des tables :
- **Table audit_logs** : `id`, `user_id`, `action`, `timestamp`
- **Table users (mise à jour)** : Ajout d'une colonne `status` (`active`, `suspended`) pour gérer l'état des comptes.
- **Table password_resets** : `id`, `user_id`, `reset_token`, `expires_at`

#### Critères de notation (25 points) :
- Fonctionnalités des itérations précédentes (10 points).
- Suspension et réactivation des comptes (5 points).
- Implémentation du système SMTP et envoi d'emails (5 points).
- Système d'ajout d'image de profil (1 point).
- Système de réinitialisation de mot de passe (3 points).
- Système d'audit des actions (2 points).

---

### **5ème Itération (30 points) : Mur social pour la publication de contenu (texte/images) et modération**

#### User stories :
- **En tant qu'utilisateur, je veux pouvoir publier des textes ou des images sur un mur partagé afin de communiquer avec les autres utilisateurs.**
- **En tant qu'administrateur, je veux pouvoir modérer les publications pour éviter tout contenu inapproprié.**
- **En tant qu'utilisateur, je veux pouvoir supprimer ou modifier mes propres publications.**

#### Fonctionnalités :
- **Reprise des itérations précédentes** : Inscription, connexion, déconnexion, suppression de compte, gestion des rôles, permissions, requêtes préparées, validation avec Regex, protection CSRF, gestion des emails via SMTP, réinitialisation de mot de passe, audit des actions critiques.

- **Mur social** :
  - **Publication de contenu** : Les utilisateurs peuvent publier du texte ou télécharger des images sur un mur partagé avec l'ensemble de la communauté. Chaque publication inclut un texte facultatif et une image facultative.
  - **Affichage du mur** : Les publications sont affichées de manière chronologique inverse (les plus récentes en haut) avec pagination pour une meilleure performance.
  - **Modification et suppression de publications** : Chaque utilisateur peut modifier ou supprimer ses propres publications à tout moment. Lors de la modification, l'utilisateur peut changer le texte ou remplacer l'image.

- **Modération par l'administrateur** :
  - **Modération des publications** : Les administrateurs peuvent modérer le contenu publié sur le mur et supprimer les publications jugées inappropriées ou offensantes.
  - **Interface de modération** : Une interface dédiée pour les administrateurs permet de visualiser les publications signalées par les utilisateurs ou d'examiner manuellement le mur.

#### Sécurité et contrôle :
- **Requêtes préparées** : Toutes les interactions avec la base de données (création, modification, suppression de contenu) sont sécurisées avec des requêtes préparées pour éviter les attaques SQL.
- **Protection CSRF** : Chaque action (publication, modification, suppression) est protégée par un token CSRF pour éviter les attaques de type Cross-Site Request Forgery.
- **Validation des fichiers** : Les images téléchargées sont vérifiées pour s'assurer qu'elles sont dans un format accepté (JPG, PNG) et ne dépassent pas une taille définie (par exemple 5 Mo).
- **Pagination et optimisation** : Le mur est paginé pour afficher un nombre limité de publications par page (ex : 10 ou 20 publications) afin d'améliorer les performances.

#### Structure des tables :

- **Table posts** (pour les publications sur le mur) : 
  - `id`, `user_id` (clé étrangère vers `users`), `content` (texte du post), `image_path` (chemin de l'image si elle est uploadée), `created_at` (horodatage de la création), `updated_at` (horodatage de la modification).

- **Table reported_posts** (pour signaler des publications) :
  - `id`, `post_id` (clé étrangère vers `posts`), `user_id` (utilisateur ayant signalé), `reason` (motif du signalement), `created_at` (horodatage).

#### Critères de notation (30 points) :
- **Fonctionnalités des itérations précédentes** (10 points).
- **Publication et gestion des contenus (texte/images)** (10 points).
- **Modération des publications par l'administrateur** (5 points).
- **Modification et suppression des publications par les utilisateurs** (5 points).

---

### **6ème Itération (35 points) : Ajout des likes, commentaires et modération associée**

#### User stories :
- **En tant qu'utilisateur, je veux pouvoir liker les publications des autres utilisateurs pour montrer mon appréciation.**
- **En tant qu'utilisateur, je veux pouvoir commenter les publications des autres utilisateurs pour interagir avec eux.**
- **En tant qu'administrateur, je veux pouvoir modérer les likes et les commentaires pour éviter tout abus ou contenu inapproprié.**
- **En tant qu'utilisateur, je veux pouvoir supprimer ou modifier mes propres commentaires.**

#### Fonctionnalités :
- **Reprise des itérations précédentes** : Inscription, connexion, déconnexion, suppression de compte, gestion des rôles, permissions, requêtes préparées, validation avec Regex, protection CSRF, gestion des emails via SMTP, réinitialisation de mot de passe, audit des actions critiques, mur social avec publication de texte et d'images, modération des publications.

- **Likes et réactions** :
  - **Liker une publication** : Les utilisateurs peuvent liker une publication pour exprimer leur appréciation. Chaque utilisateur ne peut liker une publication qu'une seule fois, et peut retirer son like.
  - **Affichage des likes** : Le nombre de likes s'affiche sur chaque publication.
  
- **Commentaires sur les publications** :
  - **Ajout de commentaires** : Les utilisateurs peuvent commenter les publications des autres utilisateurs.
  - **Affichage des commentaires** : Les commentaires sont affichés sous chaque publication dans l'ordre chronologique, avec pagination pour améliorer les performances.
  - **Modification et suppression des commentaires** : Les utilisateurs peuvent modifier ou supprimer leurs propres commentaires.

- **Modération par l'administrateur** :
  - **Modération des likes** : Les administrateurs peuvent supprimer les likes s'ils sont signalés pour abus ou manipulation.
  - **Modération des commentaires** : Les administrateurs peuvent supprimer les commentaires signalés ou jugés inappropriés. Ils peuvent également modérer les contenus offensants dans les publications et les commentaires.
  - **Signalement des commentaires et likes** : Les utilisateurs peuvent signaler un commentaire ou un like abusif ou inapproprié, qui sera ensuite examiné par un administrateur.

#### Sécurité et contrôle :
- **Requêtes préparées** : Les interactions avec la base de données (likes, commentaires) sont sécurisées avec des requêtes préparées pour éviter les attaques SQL.
- **Protection CSRF** : Chaque action (ajout de like, ajout de commentaire, modification, suppression) est protégée par un token CSRF pour éviter les attaques de type Cross-Site Request Forgery.
- **Validation des contenus** : Les commentaires sont soumis à une validation pour empêcher l'injection de scripts ou de contenu inapproprié.
- **Pagination des commentaires** : Pour les publications avec de nombreux commentaires, une pagination est appliquée pour ne pas surcharger la page.

#### Structure des tables :

- **Table posts** (mise à jour pour les publications sur le mur) : 
  - `id`, `user_id` (clé étrangère vers `users`), `content` (texte du post), `image_path` (chemin de l'image si elle est uploadée), `created_at` (horodatage de la création), `updated_at` (horodatage de la modification).

- **Table comments** (pour les commentaires sur les publications) : 
  - `id`, `post_id` (clé étrangère vers `posts`), `user_id` (clé étrangère vers `users`), `comment_text` (contenu du commentaire), `created_at` (horodatage de la création), `updated_at` (horodatage de la modification).

- **Table likes** (pour les likes sur les publications) :
  - `id`, `post_id` (clé étrangère vers `posts`), `user_id` (clé étrangère vers `users`), `created_at` (horodatage de la création).

- **Table reported_comments** (pour signaler des commentaires) :
  - `id`, `comment_id` (clé étrangère vers `comments`), `user_id` (utilisateur ayant signalé), `reason` (motif du signalement), `created_at`.

- **Table reported_likes** (pour signaler des likes) :
  - `id`, `like_id` (clé étrangère vers `likes`), `user_id` (utilisateur ayant signalé), `reason` (motif du signalement), `created_at`.

#### Critères de notation (35 points) :
- **Fonctionnalités des itérations précédentes** (10 points).
- **Système de likes et gestion des interactions** (10 points).
- **Commentaires avec possibilité de modification et suppression** (10 points).
- **Modération des likes et des commentaires par l'administrateur** (5 points).


### Synthèse :

- **1ère Itération** : Gestion de base des utilisateurs (inscription, connexion, déconnexion) avec hashage.
- **2ème Itération** : Ajout de la suppression de compte, liste des utilisateurs, utilisation de requêtes préparées et gestion des erreurs.
- **3ème Itération** : Gestion des rôles avec une table dédiée, validation avec Regex, protection CSRF, tout en reprenant les fonctionnalités des itérations précédentes.
- **4ème Itération** : Suspension de comptes, ajout d'images de profil, système de réinitialisation de mot de passe via email (SMTP) et audit des actions utilisateurs.
- **5ème Itération** : Mur social avec publication de contenu (texte et images) et modération des publications.
- **6ème Itération** : Ajout de fonctionnalités sociales (likes, commentaires) et gestion de la modération de ces interactions.
