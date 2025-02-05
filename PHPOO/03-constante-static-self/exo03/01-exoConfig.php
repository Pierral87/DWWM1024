<?php 

/* 

Exercice 1 : Configuration d'une Application Web avec static, self et const

Objectif : Créer une classe Config pour gérer la configuration générale d'une application web. Cette classe contiendra des constantes et des méthodes statiques permettant d'accéder aux informations comme le nom de l'application et les paramètres globaux.

Énoncé :

    Créez une classe Config qui contiendra :
        Une constante APP_NAME qui stockera le nom de l'application.
        Une propriété statique $settings qui contiendra les paramètres globaux de l'application sous forme de key=>value (comme le mode de débogage, ou l'URL de la base de données, mettez des infos aléatoires).
        Une méthode statique setSetting($key, $value) pour ajouter une valeur dans $settings.
        Une méthode statique getSetting($key) pour récupérer une valeur de $settings.
        Une méthode statique getAppName() qui retourne le nom de l'application.

        */

        class Config {
            private const APP_NAME = "ReactWebApp";
        
            private static array $settings = [
                'debug_mode' => true,
                'db_url' => 'mysql:host=localhost;dbname=ReactApp',
                'version' => '1.0.0'
            ];
            
            public static function setSetting( string $key, $value){
                self::$settings[$key] = $value;
            }
            public static function getSetting(string $key){
                return self::$settings[$key] ?? null;
            }
            public static function getAppName(): string{
                return self::APP_NAME;
            }
        }

    echo "Nom de l'app : " . Config::getAppName() . "<hr>";
    echo "Valeur dans settings de la clé db_url : " . Config::getSetting("db_url") . "<hr>";
    echo "Remplacement de valeur dans db_url...<hr>";
    Config::setSetting("db_url", "mysql:host=localhost;dbname=OnPrefereLePhp") . "<hr>";
    echo "Valeur dans settings de la clé db_url : " . Config::getSetting("db_url") . "<hr>";

