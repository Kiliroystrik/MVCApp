<?php

use Dotenv\Dotenv; // Importe la classe Dotenv de la bibliothèque vlucas/phpdotenv pour utiliser les variables d'environnement
use PDO; // Importe la classe PDO pour l'utilisation de la connexion à la base de données
use PDOException; // Importe la classe d'exception PDOException pour gérer les erreurs de connexion
use RuntimeException; // Importe la classe RuntimeException pour lancer des exceptions en cas d'erreur

class Database
{
    private static $instance; // Déclare une propriété statique qui gardera l'instance unique de la classe (Singleton)

    private $conn; // Déclare une propriété pour stocker l'objet de connexion à la base de données

    private function __construct()
    { // Constructeur privé pour empêcher l'instanciation directe de la classe
        $this->loadCredentials(); // Appelle la méthode pour charger les informations de connexion et établir la connexion
    }

    public static function getInstance()
    { // Méthode publique statique pour obtenir l'instance unique de la classe
        if (!isset(self::$instance)) { // Vérifie si l'instance n'existe pas déjà
            self::$instance = new Database(); // Crée une nouvelle instance de la classe si elle n'existe pas
        }
        return self::$instance; // Retourne l'instance existante ou nouvellement créée
    }

    public function getConnection()
    { // Méthode publique pour obtenir l'objet de connexion à la base de données
        return $this->conn; // Retourne la propriété conn qui contient l'objet PDO de connexion à la base de données
    }

    private function loadCredentials()
    { // Méthode privée pour charger les informations de connexion à partir des variables d'environnement
        $dotenv = Dotenv::createImmutable(__DIR__); // Crée un objet Dotenv pour le répertoire courant
        $dotenv->load(); // Charge les variables d'environnement du fichier .env dans le répertoire courant

        $host = $_ENV['DB_HOST']; // Récupère le nom d'hôte de la base de données depuis les variables d'environnement
        $dbName = $_ENV['DB_NAME']; // Récupère le nom de la base de données depuis les variables d'environnement
        $username = $_ENV['DB_USERNAME']; // Récupère le nom d'utilisateur de la base de données depuis les variables d'environnement
        $password = $_ENV['DB_PASSWORD']; // Récupère le mot de passe de la base de données depuis les variables d'environnement

        $this->establishConnection($host, $dbName, $username, $password); // Appelle la méthode pour établir la connexion à la base de données avec les informations chargées
    }

    private function establishConnection($host, $dbName, $username, $password)
    { // Méthode privée pour établir la connexion à la base de données
        try {
            $this->conn = new PDO( // Tente de créer un nouvel objet PDO pour la connexion à la base de données
                "mysql:host=$host;dbname=$dbName", // Chaîne de connexion qui inclut l'hôte et le nom de la base de données
                $username, // Nom d'utilisateur pour la connexion à la base de données
                $password  // Mot de passe pour la connexion à la base de données
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configure l'objet PDO pour qu'il lance des exceptions en cas d'erreur
        } catch (PDOException $e) { // Attrape les exceptions PDO si une erreur se produit lors de la connexion
            throw new RuntimeException("Connection error: " . $e->getMessage()); // Lance une RuntimeException avec le message d'erreur de la PDOException
        }
    }
}
