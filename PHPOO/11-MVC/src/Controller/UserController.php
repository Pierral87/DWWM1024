<?php

namespace ProjetMVC\Controller;

use ProjetMVC\Model\UserModel;

class UserController
{

    // Cette prop va contenir un objet de type Model, notre élément qui nous sert à piocher nos données en BDD
    protected $model;

    public function __construct()
    {
        // echo "<hr>Initialisation de mon controller UserController WOW ! <hr>";
        // J'initialise ici un objet de type UserModel, c'est mon Model qui me sert à me retourner mes données sur les utilisateurs 
        $this->model = new UserModel;
    }

    // La méthode render me permet de gérer l'affichage de mes vues 
    public function render($layout, $vue, $parameters = array())
    {

        // extract() : fonction prédéfinie qui permet de transformer les clés d'un array en variable, qui auront la valeur la clé en question du array
        // par exemple "title" => "List User"
        // deviendra
        // $title = "List User";
        extract($parameters);

        ob_start(); // On démarre une mise en tampon, pour faire en sorte de ne pas exécuter directement le code au client, mais le mets de côté pour pouvoir le manipuler avant de relacher l'affichage 

        require_once "src/View/$vue";

        $content = ob_get_clean(); // Ici on clean la mémoire tampon en "insérant" dans $content tous les éléments chargé depuis le ob_start, à savoir le require de notre vue

        ob_start(); 
        require_once "src/View/$layout"; // Appel de la structure de ma page, à ce niveau grâce au ob_get_clean on a bien la var $content qui est définie, j'aurai donc ma page entièrement modélisée 

        return ob_end_flush(); // A cette étape, la mise en tampon est terminée et je libère l'affichage pour l'utilisateur
    }

    // Ici la méthode qui me permet de comprendre les requêtes de l'utilisateur
    public function handleRequest()
    {
        if (isset($_GET["op"])) {
            $op = $_GET["op"];
        } else {
            $op = null;
        }

        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        } else {
            $id = null;
        }

        try {
            // S'il a demandé à voir un utilisateur
            if ($op == "select") {
                $this->select($id);
            } 
            // S'il a demandé à ajouter un user
            elseif ($op == "add") {
                $this->add();
            }
            // S'il a demandé à modifier un user 
            elseif ($op == "update") {
                var_dump($_GET);
                $this->update($id);
            } 
            // S'il a demandé à supprimer un utilisateur
            elseif ($op == "delete") {
                $this->delete($id);
            // Sinon, on affiche tout
            } else {
                $this->selectAll();
            }

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    // Ci-dessous la méthode me permettant de gérer la demande d'affichage de tous les utilisateurs 
    public function selectAll() 
    {
        // J'appelle mon model pour lui demander de me retourner tous les utilisateurs de ma base (mon array)
        $data = $this->model->modelSelectAll();
        // var_dump($data);
        // require("templateListUser.php");
        // $title = "Liste des utilisateurs";
        // $content = require("src/View/ListUser.php");
        // require("src/View/layout.php");

        // J'appelle la méthode render qui me permet de gérer l'affichage de mon contenu
        // Je transmet : 
            // le layout, c'est la structure de la page 
            // la vue, c'est le contenu de la page qui sera inséré dans le layout 
            // les params, ce sont les différentes données dont j'ai besoin pour mener à bien l'affichage de ma vue et mon layout 
                // Ici je transmet le titre de la page (changeant à chaque scénario) ainsi que les data reçus du Model 
        $this->render("layout.php", "ListUser.php", 
        [
            "title" => "Liste des utilisateur",
            "data" => $data
        ]);
    }

    public function select($id) 
    {
        // Je dois lancer la méthode modelSelectOne($id)
        $this->render("layout.php", "OneUser.php", [
            "title" => "Information de l'utilisateur $id",
            "data" => $this->model->modelSelectOne($id)
        ]);
    }

    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $nom = $_POST['nom'] ?? '';
            $email = $_POST['email'] ?? '';

            // Validation basique
            if (!empty($nom) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Appel au modèle pour ajouter l'utilisateur
                $this->model->modelAdd($nom, $email);
                // Redirection vers la liste des utilisateurs
                header('Location: ' . URL . 'index.php');
                // var_dump($_POST);
                exit;
            } else {
                $message = "Erreur : nom ou email invalide.";
            }
        }
        $this->render("layout.php", "AddUser.php", [
            "title" => "Ajout d'un utilisateur",
        ]);
    }

    public function update($id)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données soumises
            $id = $_POST['id'] ?? null;
            $nom = $_POST['nom'] ?? '';
            $email = $_POST['email'] ?? '';

            // Validation basique
            if ($id !== null && !empty($nom) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Appel au modèle pour mettre à jour les données
                $this->model->modelUpdate($id, $nom, $email);

                // Redirection vers la liste des utilisateurs
                header('Location: ' . URL . 'index.php');
                exit;
            }
        }

        $this->render("layout.php", "UpdateUser.php", [
            "title" => "Modification d'un utilisateur",
            "data" => $this->model->modelSelectOne($id)
        ]);
    }

    public function delete($id) {
        $this->model->modelDelete($id);
        header('Location: ' . URL . 'index.php');
        exit;
    }
}
