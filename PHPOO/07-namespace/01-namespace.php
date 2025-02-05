<?php 

/* 

    -- Les Namespaces 

    Les namespaces en PHP sont un moyen d'organiser et de structurer nos classes, interfaces, fonctions ou autres, de manière logique.
    Cela permet d'éviter les conflits de noms, particulièrement dans les projets complexes et riches en classes et fonctions ou lorsque l'on fait appel à des bibliothèques externes.

    Les namespaces permettent d'éviter les collisions de noms en séparant les espaces de noms (comme des dossiers virtuels à l'échelle de notre code) et en clarifiant de quel namespace vient telle ou telle classe 

    Sans namespace, toutes les classes et fonctions sont déclarées dans un espace global.

*/

// Fichier 1 : 
// class Utilisateur {
//     public function getNom() {
//         return "Pierra";
//     }
// }

// Ici, un conflit se produit entre nos deux classes, elles ont le même nom et sont dans le même scope global

// Fichier 2 : 
// class Utilisateur {
//     public function getNom() {
//         return "Bob";
//     }
// }

// Grâce aux namespaces on peut résoudre cette problématique 

// Fichier 1 : 
namespace Librairie1;
class Utilisateur {
    public function getNom() {
        return "Pierra";
    }
}

// Fichier 2 : 
namespace Librairie2;
class Utilisateur {
    public function getNom() {
        return "Bob";
    }
}

$user = new \Librairie2\Utilisateur;

// Plus de conflit ici car j'ai deux classes Utilisateur, qui sont en fait deux éléments différents, l'un étant Utilisateur venant de Librairie1 et l'autre étant Utilisateur venant de Librairie2 

// La déclaration d'un namespace se fait toujours en première instruction de notre fichier (juste après l'ouverture de php),
// On peut également avoir des noms de namespace composé, en séparant les mots par des \ 
// ---------------------------------------
// <?php 
namespace MonProjet\Modele;

class Utilisateur {
    public function getNom() {
        return "Albert";
    }
}

// -- Utilisation des classes dans les namespaces 

//  Pour utiliser une classe appartenant à un namespace différent, on doit spécifier son namespace complet (ou FQN - Fully Qualified Name). Ou utiliser l'instruction use pour "importer" un namespace dans le fichier courant et éviter de toujours écrire le FQN 


namespace MonProjet\Controller;

$modelUser = new \MonProjet\Modele\Utilisateur();
echo $modelUser->getNom();

// Avec use : 
namespace MonProjet\Controller;

use MonProjet\Modele\Utilisateur;
// Si jamais j'avais la nécessité d'utiliser une classe de même nom qu'une autre (mais heureusement venant d'un autre namespace), je peux soit utiliser le FQN, dans ce cas là, pas de doute, ou sinon je peux donner un alias (un surnom) à cette classe, ici ci dessous, je renomme User1  la classe Utilisateur venant de Librairie2
use Librairie2\Utilisateur AS User1;


// En utilisant use, cela m'évite d'appeler les FQN pour instancier mes objets
$utilisateur = new Utilisateur(); // Ici seulement new Utilisateur 
echo $utilisateur->getNom();
var_dump($utilisateur);
$user = new User1; // Ici seulement new User1 (l'alias que j'ai donné à Librairie2\Utilisateur)
var_dump($user);



// Namespace Global 
// La constante magique ci dessous m'indique le namespace dans lequel je me trouve, ici dans MonProjet\Controller 
// Lorsque je suis dans un namespace, JE NE SUIS PLUS DANS LE SCOPE GLOBAL DE PHP !!!
// Ce qui veut dire que je n'ai plus accès "basiquement" aux classes natives de PHP, par exemple ci dessous un new Exception me retourne une erreur, il pense devoir chercher Exception venant du namespace MonProjet\Controller, plutôt que Exception du scope global
// Le fait de rajouter un \ devant le nom \Exception me permet de retourner vers l'espace global le temps de la ligne pour l'appel de la classe en question 
echo __NAMESPACE__ ;

class MonController {
    public function maFunction() {
        throw new \Exception();
    }
}


/* 

    --- Fonctionnement des Namespaces avec les dossiers 

    Il est recommandé de faire correspondre la structure des namespace avec la structure des dossiers pour mieux organiser le projet 

    Exemple : 

        - MonProjet/ 
            - Modele/ 
                - Utilisateur.php 
            - Controller/ 
                - UtilisateurController.php 

    Ainsi, le fichier Utilisateur.php pourrait avoir le namespace MonProjet\Modele et UtilisateurControler.php le namespace MonProjet\Controller 

    --- Namespace et Autoload 

        Les namespaces sont généralement utilisés conjointement avec l'autoload des classes pour éviter de devoir inclure manuellement chaque fichier
        Pour chaque classe que j'utilise (chacune dans un fichier séparé), je dois faire un require maclasse1.php,   require maclasse2.php etc 
        Pour cela on utilise la convention PSR-4 

    --- Qu'est ce que la convention PSR-4 ? 
    
        C'est une convention de nommage et d'organisation des fichiers dans un projet qui vise à standardiser l'autoloading des classes en fournissant une structure claire pour mapper les namespaces aux dossiers et les classes aux fichiers 
        Cela permettra de charger automatiquement les classes d'un projet sans avoir à réécrire nos require 

            - Chaque classe doit avoir un namespace qui correspond à sa structure de répertoire sur le serveur 
            - Nom de la classe doit correspondre au nom du fichier dans lequel la classe est définie (class Utilisateur dans Utilisateur.php )
            - Autoloading permettra de rentrer dans chaque dossier en rapport aux noms des namespace et ensuite de piocher le fichier correspondant à la classe 

        Point important de la PSR-4, c'est que l'on nommera un namespace racine qui sera mappé vers un dossier spécifique et ensuite on utilisera les noms des namespaces comme nom de dossiers

        Exemple : 

        Namespace : MonProjet\Controller 
        Fichier : UserController.php 

        le namespace racine MonProjet qui sera mappé vers un dossier nommé "src" 

            - src/  
                - Controllers/ 
                    - UserController.php 

        
        --- Bonnes pratiques de nommage des namespace 

            - Nommer les namespaces de façon logique : Organisez vos classes par fonctionnalité. Par exemple on regroupe les Model dans un namespace Model, les controleurs dans Controller, nos propres classes dans un namespace MyClasses 
            - On suit la norme PSR-4 avec le dossier racine puis ensuite des dossiers en rapport à nos namespaces
            - On évite les noms trop longs ou ambigus 

*/

