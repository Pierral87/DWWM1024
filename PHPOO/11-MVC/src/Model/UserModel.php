<?php 
namespace ProjetMVC\Model;

class UserModel 
{
    // Ici la props contient la totalité de mon array (normalement on stocke ici l'objet représentant la bdd)
    protected $users;

    public function __construct()
    {
        // echo "<hr>Initialisation du Model UserModel !!!!!! <hr>";

        // J'initialise ici normalement la création de l'objet BDD, dans notre cas, on récupère les valeurs venant de la session 
        $this->users = $_SESSION["users"];
    }

    public function modelSelectAll()
    {
        // Je fais un return de la totalité des données 
        return $this->users;
    }

    public function modelSelectOne($id)
    {

        // return du seul user ayant cet id 
        return $this->users[$id];
    }

    public function modelAdd($nom, $email)
    {
        $this->users[] = ["id" => end($this->users)["id"] + 1, "nom" => $nom, "email" => $email];
        $_SESSION["users"] = $this->users;
    }

    public function modelUpdate($id, $nom, $email)
    {
        $this->users[$id] = ["id" => $id, "nom" => $nom, "email" => $email];
        $_SESSION["users"] = $this->users;
    }

    public function modelDelete($id)
    {
        foreach ($_SESSION["users"] as $index => $user) {
            if ($user['id'] == $id) {
                unset($this->users[$index]);
                $_SESSION["users"] = $this->users;

                return true;
            }
        }
        return false;
    }

}