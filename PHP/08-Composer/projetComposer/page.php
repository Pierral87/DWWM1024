<?php 

// Chargement de l'autoload de composer
require __DIR__ . '/vendor/autoload.php';

// Importation de la dépendance sur ce fichier
use Ramsey\Uuid\Uuid;

$uuid = Uuid::uuid4();

var_dump($uuid);