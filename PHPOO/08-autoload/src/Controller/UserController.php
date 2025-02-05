<?php 
namespace Controller;
// J'ai mis ce fichier dans le dossier Model, donc je n'oublie surtout pas de lui donner le namespace Model en toute première instruction de mon fichier 

class UserController {
    public function getNom() {
        return "Je suis dans le controller user !!!!!";
    }
}