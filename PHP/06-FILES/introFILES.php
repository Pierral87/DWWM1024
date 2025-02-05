<?php

/* 

$_FILES est une superglobale de PHP ! Encore une fois un array ! 

Elle est utilisée pour récupérer les informations sur les pièces jointes envoyés par un formulaire HTML ! 

ATTENTION, il ne faut pas oublier l'attribut enctype="multipart/form-data"  dans notre balise form, sinon impossibilité de récupérer la pièce jointe 

Egalement, un input type="file" n'est pas visible dans le $_POST mais uniquement dans le $_FILES 

$_FILES est un tableau array associatif avec des clés qui représentent les informations sur notre fichier notamment le "name" pour le nom du fichier et le "tmp_name" pour le chemin vers le fichier temporaire représentant cet envoi, sur le serveur !  

"error" est un int représentant un code d'erreur, 0 pour pas d'erreur  

*/

var_dump($_POST);
var_dump($_FILES);

// array (size=1)
//   'fichier' => 
//     array (size=6)
//       'name' => string 'php.png' (length=7)
//       'full_path' => string 'php.png' (length=7)
//       'type' => string 'image/png' (length=9)
//       'tmp_name' => string 'C:\wamp64\tmp\php6EA7.tmp' (length=25)
//       'error' => int 0
//       'size' => int 151597

$extensionsOk = ["jpg", "jpeg", "png", "gif", "webp"];
$dossierUpload = "upload/";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fichier"]) && $_FILES["fichier"]["error"] == UPLOAD_ERR_OK) {
    // La constant UPLOAD_ERR_OK contient un int représentant le code erreur "0" pour "pas de problème d'upload", il existe beaucoup d'autres cas d'erreurs nommés eux aussi UPLOAD_ERR_QQCHOZ 

    $nomFichier = basename($_FILES["fichier"]["name"]); // basename nous permet de récupérer uniquement la fin d'un chemin d'accès, en gros, le nom du fichier lui même (entier), pour être sur de filtrer uniquement le nom du fichier

    $fichierTemporaire = $_FILES["fichier"]["tmp_name"];

    $extensionFichier = strtolower(pathinfo($nomFichier, PATHINFO_EXTENSION)); // pathinfo avec le filtre PATHINFO_EXTENSION permet de récupérer uniquement l'extension d'un fichier

    var_dump($nomFichier);
    var_dump($extensionFichier);

    // Vérification de l'extension du fichier 
    if (in_array($extensionFichier, $extensionsOk)) {
        // filtrage du nom du fichier (caractères spéciaux non autorisés et donc remplacés par preg_replace)
        $nomFichier = preg_replace("/[^a-zA-Z0-9._-]/", "_", $nomFichier);
        $nomFichier = strtolower(pathinfo($nomFichier, PATHINFO_FILENAME));

        // Ajout d'un identifiant unique en début du nom de fichier pour éviter les collisions 
        $nomFichier = uniqid() . "_" . $nomFichier . "." . $extensionFichier;

        var_dump($nomFichier);

        $destination = $dossierUpload . $nomFichier;

        if (move_uploaded_file($fichierTemporaire, $destination)) {
            $message = '<div class="alert alert-success" role="alert"> Fichier correctement uploadé !</div>';
        } else {
            $message = '<div class="alert alert-danger" role="alert"> Erreur à l\'envoie du fichier !</div>';
        }
    }
}


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de fichier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Upload de fichier</h1>

                <?= $message ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="fichier" class="form-label">Sélectionnez un fichier à télécharger</label>
                        <input type="file" class="form-control" id="fichier" name="fichier" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>