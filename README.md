# Pour installer le site, installer le dossier parent nommé geii sur Uwamp ce  qui vous permettra de l'ouvrir dans votre navigateur.

# Il n'y a normalement rien à installer.

# Pour que le site fonctionne, il faut lui ajouter une base de données.
# Nous l'avons ajouter au projet dans le fichier geiiBD.sql

# Une fois que vous l'avez créez, allez dans le fichier /geii/modele/connectionBd.php et insérez le nom de votre base dans la valeur du champs $dbName.
# vous devrez aussi y renseignez votre hôte, identifiant et mot de passe d'accès à votre gestionnaire de base de données.

# Pour accéder à la page d'accueil du site, aller dans votre localhost depuis votre navigateur et ouvrez /geii/accueil.php.
# A part la connection de l'administrateur, tout est accessible depuis cette page d'accueil.

# Pour les pages suivantes : AfficherOffreBD.php et AfficherProjet.php étant donné l'abscence de header suite à un problème avec Boostrap vous devez  utiliser les différentes flèches de redirection pour revenir à la page d'accueil de l'entreprise
# Pour connecter un administateur, l'url à utiliser est la suivante : /geii/view/vues_admin/Admin.php l'identifiant et le mot de passe pour accèder à cette page sont les suivants : id: admin et mdp : admin

