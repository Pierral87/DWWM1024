<?php 

class Plombier 
{
    public function getSpecialite()
    {
        return "Plombier : répare la tuyauterie !";
    }
}

class Electricien 
{
    public function getSpecialite() 
    {
        return "Electricien : règle l'electricité !";
    }
}

// La ligne ci dessous me permet d'autoriser la création de nouvelles propriétés à l'intérieur d'un objet 
#[AllowDynamicProperties]
class Entreprise 
{
    public $nbrEmploye = 0;

    public function appelUnEmploye($employe)
    {
        $this->nbrEmploye++; // Ici le nombre d'employés de l'entreprise, s'incrémente à chaque appel de cette méthode 

        // je crée une variable ici contenant un string dynamique à chaque appel de la fonction pour nommé monEmploye1, monEmploye2 etc. mes nouvelles props
        $monEmploye = "monEmploye" . $this->nbrEmploye;
        // $this->{"monEmploye" . $this->nbrEmploye} = new $employe;

        // J'insère dans cette nouvelle prop, un objet de type d'employé qui me sera fourni en param de la méthode (Electricien, Plombier, autre)

        // Ici $this-> fait référence à l'objet courant/en cours d'utilisation
        // Donc sur l'objet $entreprise on appelle la propriété monEmploye1, puis monEmploye2 etc, pour y insérer une instance d'un type d'employé (contenu dans le param $employe)
        $this->$monEmploye = new $employe;
    }
}

$entreprise = new Entreprise; 

var_dump($entreprise);
$entreprise->appelUnEmploye("Electricien");
var_dump($entreprise);

// Cela me permet d'avoir accès aux props et méthodes d'un objet Electricien, à l'intérieur d'un objet Entreprise, pourtant il n'y a pas d'héritage !
// C'est simplement, un objet, dans un autre objet (comme la voiture dans l'exercice pompe à essence, dans la méthode donnerEssence())
echo $entreprise->monEmploye1->getSpecialite();

$entreprise->appelUnEmploye("Plombier");
var_dump($entreprise);
echo $entreprise->monEmploye2->getSpecialite();


