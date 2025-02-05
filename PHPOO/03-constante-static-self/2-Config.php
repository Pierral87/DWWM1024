<?php 

/* 

Exemple : Gestion de classe de configuration 

Ici je stocke des éléments de config dans des constantes (ou props statique) et je me sers de méthode pour les renvoyer.
Idem que User.php cela m'évite de retaper à la main les chemin d'accès dans mon code. 
Egalement je m'assure de ne pas faire de faute à la saisie et tout est classé dans une seule et même classe, cela me permet de centraliser la configuration de mon app.

*/

class Config {

    private const BASE_URL = "https://www.monsite.com/";
    private const UPLOAD_PATH = "uploads/";

    public static function getBaseUrl() {
        return self::BASE_URL;
    }

    public static function getUploadPath() {
        return self::UPLOAD_PATH;
    }
}

echo "URL : " . Config::getBaseUrl() . "<hr>";
echo "Upload Path : " . Config::getUploadPath() . "<hr>";