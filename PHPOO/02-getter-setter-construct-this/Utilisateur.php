<?php 




// Déclaration de la classe Utilisateur 

// -- Le Constructeur (__construct) 
    // Le constructeur est une méthode magique, que l'on défini dans une classe et qui est automatiquement appelée lors de la création d'un objet de cette classe. Il permet souvent d'initialiser les props de l'objet dès sa création 

// -- Le mot-clé $this 
    // Le mot-clé $this fait référence à l'objet courant dans lequel il est utilisé. Il permet d'accèder aux props et méthodes de cet objet depuis l'intérieur de la classe avant même d'avoir spécifié leur instanciation

// -- Les getters 
    // Un getter est une méthode publique qui permet d'accéder aux propriétés d'une classe, cela permet de mieux controler et sécuriser l'accès à une donnée 
    // On aura un getter pour chaque prop de l'objet 

// -- Les setters 
    // Un setter c'est une méthode publique qui permet de modifier la valeur d'une propriété private ou protected. Cela permet de valider et contrôler les changements sur les propriétés 
    // On aura un setter pour chaque prop de l'objet 
    // Setter avec vérif ou sans vérif ? 

    // Un setter sans vérification est toujours utile ! Il faut penser à l'avenir de notre application 
        // Il est toujours bon de normaliser les appels des props de nos objets (c'est à dire, toujours en faisant un appel d'une prop d'un objet en appelant une méthode getProp()) pour s'assurer que ce n'est pas différent d'un objet à l'autre 
        // Idem pour les setters et leurs vérifications, si je n'ai pas de vérification à faire pour le moment, c'est pas grave, je sais que je normalise l'appel d'un changement de prop par ces méthodes setProp()
        // Si un jour je veux rajouter un contrôle sur une prop, j'ai simplement à modifier le code dans la méthode set associée et rien d'autre dans le reste de mon code 
        // Si je défini un setter avec une validation, je m'assure que la propriété en question reçoit uniquement des valeurs valides.

class Utilisateur {
    protected $nom;
    protected $email;

    public function __construct($nom, $email) { // Ici le __construct se lance dès que j'instancie un objet, il récupère les params fournis à l'instanciation (qui sont maintenant des params obligatoires à fournir à l'instanciation) et me permet de les répercuter dans les props de l'objet
        // echo "Initialisation de la classe Utilisateur, je suis passé dans le construct !!! J'ai reçu les infos $nom et $email<hr>";

        // Il est déjà bon d'appeler nos setter à l'intérieur du constructeur, ce qui nous permet déjà de filtrer les données 
        $this->setNom($nom);
        $this->email = $email;
    }

    public function saluer(){
        return "Bonjour, je m'appelle " . $this->nom;
    }

    // Getter pour le nom, cette méthode me permet d'avoir un retourn de la propriété $nom que je ne peux pas manipuler dans le scope global car elle est private ou protected
    public function getNom() {
        return $this->nom;
    }

    // Setter pour modifier le nom, on peut en profiter pour appliquer des contrôles. Je ne peux pas modifier la prop nom depuis le scope global, je suis obligé de passer par le setter 
    public function setNom(string $newNom) {
        if (iconv_strlen($newNom >= 1)) {
            $this->nom = $newNom;
        } else {
            trigger_error("Le nom ne peut pas être vide", E_USER_NOTICE);
        }
    }
}

$utilisateur = new Utilisateur("Pierra", "pierra@mail.com");
// $utilisateur->nom = "Pierra";
// $utilisateur->email = "pierra@mail.com";
echo $utilisateur->saluer() . "<hr>";

// echo $utilisateur->nom; // N'est pas faisable si la props est private
echo $utilisateur->getNom(); // Par contre je peux utiliser le getter qui me retourne la valeur de "nom" 

echo $utilisateur->setNom("Pierre-Alexandre");


echo $utilisateur->saluer() . "<hr>";





// $utilisateur2 = new Utilisateur("Mathieu", "matt@mail.com");
// // $utilisateur2->nom = "Mathieu";
// // $utilisateur2->email = "matt@mail.com";
// echo $utilisateur2->saluer();
?>