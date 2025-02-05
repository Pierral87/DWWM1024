<?php

/*********************
 
    EXERCICE :

        Création de la classe Vehicule et de la classe Pompe en suivant ces modélisations

    ----------------------
    |   Vehicule         |
    ----------------------
    |-litresReservoir:int|
    ----------------------
    |+setlitresReservoir()|
    |+getlitresReservoir()|
    ----------------------

    ----------------------
    |   Pompe            |
    ----------------------
    | -litresStock:int   |
    ----------------------
    | +setlitresStock()  |
    | +getlitresStock()  |
    | +donnerEssence()   |
    ----------------------

        Spécifications : 
            - Le réservoir d'un véhicule contient maximum 50 litres
            - La méthode donnerEssence() distribue automatiquement le plein (50litres) à la voiture 
            - Gérez les exceptions qui peuvent être rencontrées à l'appel de la méthode donnerEssence()

 */
class Vehicule
{
    private int $litresReservoir;
    const MAX_LITERS = 50;

    public function __construct(int $litresReservoir)
    {

        $this->setlitresReservoir($litresReservoir);
    }

    public function getlitresReservoir()
    {
        return $this->litresReservoir;
    }

    public function setlitresReservoir(int $litresReservoir)
    {

        if ($litresReservoir > self::MAX_LITERS || $litresReservoir < 0) {
            echo "Le réservoir ne peut pas contenir plus de " . self::MAX_LITERS . " litres.</br>";
        } else {
            $this->litresReservoir = $litresReservoir;
        }
    }

    public function afficherReservoir(): void
    {
        echo "Litres dans le réservoir : " . $this->litresReservoir . " litres.</br>";
    }
}

class Pompe
{
    private int $litresStock;

    public function __construct(int $litresStock)
    {
        $this->setlitresStock($litresStock);
    }

    public function getlitresStock()
    {
        return $this->litresStock;
    }

    public function setlitresStock(int $litresStock)
    {
        if ($litresStock < 0) {
            echo "Attention pas de litres négatif ou 0 dans la pompe";
        } else {
            $this->litresStock = $litresStock;
        }
    }

    public function donnerEssence(Vehicule $vehicule)
    {
        $quantiteManquante = Vehicule::MAX_LITERS - $vehicule->getLitresReservoir();

        if ($quantiteManquante >= $this->litresStock) {
            $vehicule->setLitresReservoir($vehicule->getLitresReservoir() + $this->litresStock);
            echo "La pompe ne contient pas assez de carburant pour remplir le réservoir. On a quand même mis ce qu'on pouvait ! à savoir " . $this->litresStock .  " litres</br>";
            $this->setlitresStock(0);
        } else {
            $vehicule->setLitresReservoir(Vehicule::MAX_LITERS);
            $this->litresStock -= $quantiteManquante;
            echo "Il reste " . $this->litresStock . " litres dans la pompe.</br>";
        }
    }
}

$car = new Vehicule(20);
// var_dump($car);
// $car->setlitresReservoir(100);
var_dump($car);


$pompe = new Pompe(0);
var_dump($pompe);

$car->afficherReservoir();
$pompe->donnerEssence($car);
$car->afficherReservoir();
var_dump($pompe);


