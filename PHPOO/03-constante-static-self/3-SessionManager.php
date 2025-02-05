<?php 

/* 

Exemple : Classe de gestion de session 

Les méthodes static de cette classe nous permettent de lancer des instructions sans instancier de classe.
Ici la classe gère toutes les actions sur la session ce qui nous évite de manipuler directement la superglobale $_SESSION, tout est déjà prédéfini dans chaque méthode de notre classe SessionManager 

Ici le static nous permet de gérer la session à travers une classe utilitaire sans avoir besoin de créer une instance à chaque fois.

*/

class SessionManager{
    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function destroy() {
        session_destroy();
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        return  isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
}

SessionManager::start();
SessionManager::set("user", "Pierra");
echo SessionManager::get("user");
SessionManager::destroy();

