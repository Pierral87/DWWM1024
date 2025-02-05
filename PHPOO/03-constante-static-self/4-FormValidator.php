<?php 

/* 

    Classe de vérification de bon format des valeurs saisies dans un form 

    Ici chaque méthode correspond à un contrôle de saisie en rapport à un champ spécifique 
    Cela nous évite d'écrire le code de nos vérifications à chaque formulaire, tout sera centralisé dans la classe FormValidator (que nous n'avons pas besoin d'instancier car les méthodes sont static)
    

*/

class FormValidator{
    public static function isEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function isRequired($value) {
        return !empty($value);
    }
}

// Après avoir faire le if REQUEST_METHOD   POST  et les conditions isset de chacun de mes champs 
// Je procèderai aux verifs de cette façon 

$email = "pierra";
if (FormValidator::isEmail($email)) {
    echo "Email valide";
} else {
    echo "Email invalide";
}