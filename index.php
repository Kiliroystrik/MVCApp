<?php
// Charger toutes les dépendances Composer
require_once __DIR__ . '/vendor/autoload.php';

// Charger le gestionnaire de base de données
use App\Database;

// Initialiser la connexion à la base de données
// Ici, étant dans le point d'entrée de l'application, on instancie la classe Database
// Afin d'avoir une seule connexion à la base de données, pour toute la duree de l'application
$database = Database::getInstance();
