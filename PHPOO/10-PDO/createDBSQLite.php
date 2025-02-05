<?php 
// Connexion à SQLite
$pdo = new PDO('sqlite:' . __DIR__ . '/dialogue.sqlite');

// Activer les erreurs et le mode exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// S'assurer que les données sont stockées en UTF-8
$pdo->exec('PRAGMA encoding = "UTF-8";');

// Création de la table si elle n'existe pas
$createTableSQL = "
CREATE TABLE IF NOT EXISTS commentaire (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    pseudo TEXT NOT NULL,
    message TEXT NOT NULL,
    date_enregistrement DATETIME DEFAULT CURRENT_TIMESTAMP
)";
$pdo->exec($createTableSQL);
