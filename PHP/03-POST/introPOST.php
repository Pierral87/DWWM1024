<?php

/* 

Le protocole POST est l'un des principaux protocoles utilisés pour envoyer des données d'un navigateur vers un serveur (l'autre c'est GET, mais on évitera de l'utiliser pour des form)

POST va envoyer les données dans le corps de la requête HTTP, cela nous permet de transmettre des informations plus volumineuses et aussi plus sensibles (car invisible à l'utilisateur)


    Transmission de données : 
        - POST principalement utilisé pour envoyer des donées qui ne doivent pas être visibles dans l'URL ou qui contiennent beaucoup d'info 
            - Formulaire d'inscription
            - Telechargement de fichier 
            - Soumission de données qui modifient un état sur le serveur 

    Syntaxe d'utilisation de POST en PHP 
        On récupère les informations du formulaire envoyer en method="post" dans la superglobale $_POST, c'est encore une fois un tableau array ! 
        Pour bien récupérer nos données il ne faut pas oublier de renseigner les attributs "name" de nos input/champs du form, sinon POST ne va pas les récupérer ! 
        Configuration : Dans le php.ini on peut modifier plusieurs éléments de configuration de POST notamment la taille maximale autorisée pour les envois de fichiers 

    Contexte d'utilisation de POST 
        Formulaire d'inscription / connexion 
        Enregistrement en base de données 
        Téléchargement de fichiers 
        Systèmes de paiement 


    Comparaison GET et POST 

    GET : 
        - Les données sont envoyées via l'URL 
        - Visible dans la barre d'adresse
        - Limité en taille par la longueur max de l'URL 
        - Pratique pour récupérer des données (les requêtes SELECT), pas d'action en BDD

    POST :
        - Les données sont envoyées dans le corps de la requête HTTP 
        - Invisible (sécurisé)
        - Pas de limite stricte (car on peut la régler dans le php.ini)
        - Idéal pour envoyer des données, soumettre des form

*/

// var_dump($_POST);
$content = null;

var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["name"], $_POST["email"], $_POST["message"])) {

        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $message = trim($_POST["message"]);

        $content = '
        <div class="card">
  <div class="card-header">
    Voici vos coordonnées et votre message
  </div>
  <div class="card-body">
    <p class="card-text">Nom : ' . $name . '</p>
    <p class="card-text">Email : ' . $email . '</p>
    <p class="card-text">Message  : ' . $message . '</p>
  </div>
</div>
    ';
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire avec POST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Contactez-nous</h1>
                <form action="" method="post" class="mb-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>

                <!-- Affichage des informations soumises -->
                <?= $content ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>