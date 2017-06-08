# Test technique Jadeo

## Enoncé 

La société des française des jeux souhaite diffuser en direct sur une chaine télévisée les résultats de son dernier jeu : 
le super SODUKO avec une cagnotte de 1.000.000 €.

Pour cela, vous devez traiter l'ensemble des grilles des jeux fournies et afficher les gagnants dans un délai de 60 secondes maximum.


## Mode Opératoire

Pour vous aider, nous vous fournissons un environnement de développement préconfiguré sous docker 
(mais vous pouvez utiliser) votre propre environnement.

Vous devrez developper et commiter votre projet sur notre dépot avec une documentation et vos remarques à la fin du délai imparti. 


## Contraintes techniques

Les grilles vous sont fournies sous le format d'un fichier plat contenant le nom du joueur et sa grille (data\input.csv).

Vous insérerez toutes les données (grilles & gagnant(s)) dans une base de données.

Vous afficherez les 3 premiers gagnants avec leurs grilles respectives sur une page HTML.



## Contacts

Responsable SI : Arnaud Bartial : a.bartial@jadeofrance.com

Lead Dev : Nicolas Joubert : n.joubert@jadeofrance.com

##Installation

#####1-Installation du projet

<pre> composer install </pre>

#####2-Création de la base de données

<pre> php bin/console doctrine:database:create</pre>

#####3-Mise à jour de la base de données

<pre> php bin/console doctrine:schema:update</pre>

#####4-Importer le fichier CSV à la base de données

<pre>php bin/console import:sudoku:csv </pre>

#####5-Les Solutions possibles
######1ére Solution sur la page internet
En cliquant sur le bouton rouge
######2éme Solution avec une commande symfony
(L'affichage des gagnants se fait sur le site web pour la commande Symfony)
<pre>php bin/console sudoku:checking</pre>

##Remarque

J'ai respecté la contrainte des 60 secondes maximum
sur mon pc portable avec VM :

- Import CSV à la base de données : 22~30 secondes

- Résolution des grilles de sudoku avec l'action du bouton : 7 secondes 

- Résolution des grilles de sudoku avec la commande : 11~15 secondes

J'ai beaucoup apprécié : 

- Comment vérifier le sudoku et le mettre en place en php 

- L'optimisation de la vitesse d'import CSV à la bdd (Au début c'était 1h40 de transfert mais maintenant c'est 22 à 30 secondes
 )
