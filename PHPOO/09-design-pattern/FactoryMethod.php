<?php 

    /* 

        Pattern du Factory Method 

        Ce pattern délègue la création d'objet à un autre objet possèdant des méthodes spécifiques pour instancier.
        Cela évite d'instancier directement les objets dans le code global et aussi de ne pas avoir besoin de spécifier directement les classes concrètes.
        Ici, j'ai deux classes, ClasseChien et ClasseChat, que je n'instancie pas directement, je les instancie via la classe AnimalFactory qui possède une méthode me permettant d'instancier ces types d'objets (d'ailleurs, sans forcément spécifier leur vrai nom de classe, je demande chien ça me crée un objet ClasseChien)
        Cela me permet de centraliser les instanciations des objets de ce contexte Animal, au même endroit.
        
     */

     class ClasseChien {
        public function parler() {
            return "Wan wan";
        }
     }

     class ClasseChat {
        public function parler() {
            return "Nyan nyan";
        }
     }

     class AnimalFactory {
        public static function create($type) {
            if ($type == "chien") {
                return new ClasseChien;
            } elseif ($type == "chat") {
                return new ClasseChat;
            }
            return null;
        }
     }

     // Utilisation 
     $chien = AnimalFactory::create("chien");
     $chat = AnimalFactory::create("chat");

     var_dump($chien);
     var_dump($chat);
