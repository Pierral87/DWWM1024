<?php

/************************************
   
    EXERCICE :
        Création d'une classe Membre avec cette modélisation 

    ----------------------
    |   Membre           |
    ----------------------
    |  - pseudo :string  |
    |  - email :string   |
    ----------------------
    | + __construct()    |
    | + getPseudo()      |
    | + setPseudo()      |
    | + getEmail()       |
    | + setEmail()       |
    ----------------------

            // S'assurer du bon fonctionnement de la classe à l'instanciation, à l'appel de ses props/méthodes
            // Appliquer des contrôles sur les setters et gérer les cas d'erreurs d'une façon ou d'une autre 

   
 ************************** */

class Membre
{
    private $pseudo;
    private $email;

    public function __construct($pseudo = null, $email = null)
    {
        if ($pseudo != null) {
            $this->setPseudo($pseudo);
        }
        if ($email != null) {
            $this->setEmail($email);
        }

        // echo "Coucou cest le constructeur";
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        if (is_string($pseudo) && iconv_strlen($pseudo) >= 3 && iconv_strlen($pseudo) <= 20) {
            $this->pseudo = $pseudo;
        } else {
            return "Le pseudo doit contenir entre 3 et 20 caractères";
        }
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            return "L'email n'est pas valide";
        }
    }
}

$membre = new Membre("toto", "toto@gmail.com");
var_dump($membre);
echo $membre->getPseudo();
echo "<br>";
echo $membre->getEmail();
echo "<br>";
echo $membre->setPseudo("t");
echo "<br>";
echo $membre->setEmail("lau.com");
