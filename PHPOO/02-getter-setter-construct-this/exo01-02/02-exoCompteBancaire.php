<?php

/* 

EXERCICE : 
            Création d'une classe CompteBancaire selon la modélisation suivante 

    ----------------------
    |   CompteBancaire   |
    ----------------------
    | -titulaire:string  |
    | -solde:float       |
    ----------------------
    | +__construct()     |
    | +getTitulaire()    |
    | +setTitulaire()    |
    | +getSolde()        |
    | +setSolde()        |
    | +afficherSolde()   |
    | +retirer()         |
    | +deposer()         |
    ----------------------

*/
class CompteBancaire {
    private string $titulaire;
    private float $solde;

    // Constructeur
    public function __construct(string $titulaire, float $soldeInitial) {
        $this->setTitulaire($titulaire);
        // if ($soldeInitial < 0) {
        //     throw new InvalidArgumentException("Le solde initial ne peut pas être négatif.");
        // }
        // $this->solde = $soldeInitial;
        $this->setSolde($soldeInitial);
    }

    // Getter titulaire
    public function getTitulaire(): string {
        return $this->titulaire;
    }

    // Setter titulaire
    public function setTitulaire(string $titulaire): void {
        if (empty($titulaire)) {
            throw new InvalidArgumentException("Le nom du titulaire ne peut pas être vide.");
        }
        $this->titulaire = $titulaire;
    }

    // Getter solde
    public function getSolde(): float {
        return $this->solde;
    }

    // Setter solde (usage interne)
    public function setSolde(float $montant): void {
        if ($montant < 0) {
            throw new InvalidArgumentException("Le solde ne peut pas être négatif.");
        }
        $this->solde = $montant;
    }

    // Affiche solde actuel
    public function afficherSolde(): string {
        return "Le solde du compte de {$this->titulaire} est de : {$this->solde} €";
    }

    // Méthode pour retirer de l'argent
    public function retirer(float $montant): void {
        if ($montant <= 0) {
            throw new InvalidArgumentException("Le montant à retirer doit être supérieur à zéro.");
        }
        if ($montant > $this->solde) {
            throw new InvalidArgumentException("Fonds insuffisants pour effectuer ce retrait.");
        }
        $this->solde -= $montant;
        echo "Montant retiré : {$montant} €. " . $this->afficherSolde() . PHP_EOL . "</br>";
    }

    // Méthode pour déposer de l'argent
    public function deposer(float $montant): void {
        if ($montant <= 0) {
            throw new InvalidArgumentException("Le montant à déposer doit être supérieur à zéro.");
        }
        $this->solde += $montant;
        echo "Montant déposé : {$montant} €. " . $this->afficherSolde() . PHP_EOL . "</br>";
    }
}

// Exemple d'utilisation
try {
    $compte = new CompteBancaire("Antoine", 100.0);

    // Affichage du solde
    echo $compte->afficherSolde() . PHP_EOL . "</br>";

    // Dépôt
    $compte->deposer(-60.0);

    // Retrait
    $compte->retirer(30.0);
    
} catch (InvalidArgumentException $e) {
    echo "Erreur : " . $e->getMessage() . PHP_EOL;
}