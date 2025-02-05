<?php 

/* 

Exercice : Validation d'âge avec gestion des exceptions

Objectif : Créer un script qui demande à l'utilisateur de saisir son âge pour accéder à une section réservée d'un site. Si l'âge est inférieur à 18 ans, lancer une exception et afficher un message d'erreur.

*/

function validerAge($age) 
{
    if ($age < 18) {
        throw new Exception("Vous ne pouvez pas accéder à ce contenu car vous êtes mineur.");
    }
    return true;
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['age'])){
    // $age = trim($_POST["age"]);

    try {
        $age = trim($_POST["age"]);

        // if ($age < 18) {
        //     throw new Exception("Vous ne pouvez pas accéder à ce contenu car vous êtes mineur.");
        // }

        validerAge($age);

        header("Location: ./gestion.php");
        exit;

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>

<form action="" method="post">
    <label for="age">Choisissez votre âge</label>
    <input type="text" name="age" id="age">
    <button type="submit">Envoyer</button>
</form>