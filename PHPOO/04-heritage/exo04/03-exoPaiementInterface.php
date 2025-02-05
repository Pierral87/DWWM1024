<?php 


/* 

    Exercice : 3 - Gérer une simulation d'un mode de paiement via des classes, traits et interfaces

Énoncé :

    Créer une interface PaiementInterface avec une méthode executerPaiement().
    Créer une classe abstraite Paiement qui implémente cette interface, avec une méthode abstraite traiterPaiement().
    Créer deux classes PaiementCarte et PaiementVirement qui héritent de Paiement et implémentent la méthode abstraite.
    Utiliser un trait ValidationPaiement avec une méthode valider() qui vérifie les détails du paiement avant de l'exécuter.
    Dans une des classes (par exemple PaiementCarte), empêcher la surcharge d'une méthode en la marquant comme final. 

    */

    interface PaiementInterface 
    {
        public function executerPaiement();
    }

    trait ValidationPaiement 
    {
        public function valider() 
        {
            if ($this->montant <= 100) return true; 
            else return false;
        }
    }

    abstract class Paiement implements PaiementInterface 
    {
        use ValidationPaiement;
        protected $montant;

        public function __construct($montant)
        {
            $this->montant = $montant;
        }

        abstract protected function traiterPaiement();

        public function executerPaiement() 
        {
            echo "Tentative de paiement en cours...<br>";
            if ($this->valider()) {
                echo "Paiement validé !<br>";
                return $this->traiterPaiement();
            }
            echo "Paiement refusé ! <br>";
        }
    }

    final class PaiementCarte extends Paiement 
    {
        protected function traiterPaiement()
        {
            return "Paiement $this->montant € par carte";
        }
    }

    final class PaiementVirement extends Paiement 
    {
        protected function traiterPaiement()
        {
            return "Paiement $this->montant € par virement";
        }
    }

    $carte = new PaiementCarte(120);
    echo $carte->executerPaiement() . "<hr>";
    $virement = new PaiementVirement(20);
    echo $virement->executerPaiement() . "<hr>";

