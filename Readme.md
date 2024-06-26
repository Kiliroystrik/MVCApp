# Projet Bibliothèque PHP MVC

Ce projet est une application simple de gestion de bibliothèque en PHP utilisant le modèle MVC. Il implémente les principes de la programmation orientée objet et utilise Composer pour l'autoloading. Et en respectant la POO.

## Objectif ##
Fournir une application fonctionnelle permettant de gérer un CRUD des entrées de livres (ajout, modification, suppression et affichage).

## Rappel MVC ##
- `Modèle` : Gère la logique des données et les interactions avec la base de données (par exemple, des requêtes SQL directes).
- `Vue` : Présente les données à l'utilisateur (HTML, CSS) et peut contenir des scripts PHP pour afficher le contenu dynamique.
- `Contrôleur` : Fait le lien entre le modèle et la vue, traite les entrées de l'utilisateur, modifie les données du modèle et met à jour la vue.

## Rappel POO

La Programmation Orientée Objet (POO) est un paradigme de programmation qui utilise des "objets" pour modéliser des éléments du monde réel. Ce paradigme est fondamental dans de nombreux langages de programmation modernes, y compris PHP, et offre plusieurs avantages pour le développement de systèmes complexes. Voici les principes clés de la POO que tout développeur doit comprendre :

- `Encapsulation` : Ce principe concerne le regroupement des données (attributs) et des méthodes (fonctions) qui manipulent ces données en une seule unité, ou classe, en restreignant l'accès direct aux composants internes de l'objet. Cela est généralement réalisé à l'aide de modificateurs d'accès qui définissent clairement ce qui peut être accédé de l'extérieur de la classe.

- `Abstraction` : L'abstraction permet de se concentrer sur ce qu'un objet fait, plutôt que sur la façon dont il le fait, en exposant uniquement les détails nécessaires. Dans une classe, cela signifie exposer des interfaces publiques tout en cachant les détails de l'implémentation interne (les méthodes et les variables).

- `Héritage` : L'héritage permet à une classe d'hériter des propriétés et méthodes d'une autre classe. Dans la POO, nous définissons souvent une classe de base (ou parent) avec des attributs et des méthodes qui seront communs à toutes les classes dérivées (enfants) qui l'étendent pour réutiliser le code.

- `Polymorphisme` : Ce principe permet aux classes d'être utilisées à travers leurs interfaces plutôt qu'explicitement, ce qui signifie que plusieurs classes peuvent être traitées comme étant du même type si elles héritent de la même classe de base ou implémentent la même interface. Cela permet de programmer de manière plus générale et flexible.

### Exemple en PHP

Considérons une classe simple en PHP qui illustre certains de ces principes :

```php
<?php
abstract class Vehicle {
    protected $speed = 0;

    public function setSpeed($speed) {
        $this->speed = $speed;
    }

    abstract public function makeSound();
}

class Car extends Vehicle {
    public function makeSound() {
        return "Vroom";
    }
}

// Utilisation
$myCar = new Car();
$myCar->setSpeed(100);
echo $myCar->makeSound();  // Affiche 'Vroom'
```

## Prérequis
- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Composer

## Configuration initiale

**1. Configuration de la base de données**
- Créer une base de données MySQL.
- Importer le schéma fourni ci-dessous.

### Script SQL pour la création de la base de données et des tables

```sql
CREATE DATABASE IF NOT EXISTS library;
USE library;

CREATE TABLE IF NOT EXISTS books (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
author VARCHAR(255) NOT NULL,
year INT NOT NULL
);

```

**2. Installation des dépendances avec Composer**

### Installation de Composer

Avant de pouvoir installer les dépendances nécessaires pour ce projet, vous devez avoir Composer installé sur votre machine. Composer est un outil de gestion de dépendances pour PHP qui permet d'installer et de mettre à jour les bibliothèques sur lesquelles votre projet dépend.

> Pour installer Composer, suivez les instructions sur le site officiel de Composer :

- Visitez [Get Composer](https://getcomposer.org/download/) pour les instructions détaillées.
- Suivez les étapes pour installer Composer sur votre système d'exploitation (Windows, macOS, Linux).

> Une fois Composer installé, vous pouvez installer les dépendances requises pour ce projet en exécutant la commande suivante à la racine de votre projet :

```bash
composer install
```

> Après modification, exécutez la commande suivante pour regénérer l'autoloader :
```bash
composer dump-autoload
```

**3. Autoloading avec Composer**

#### Qu'est-ce que l'Autoloading?

> L'autoloading en PHP est un mécanisme qui permet de charger automatiquement des fichiers PHP contenant des classes lorsque ces classes sont nécessaires. Au lieu de devoir inclure manuellement les fichiers avec `require` ou `include`, l'autoloader de Composer s'assure que les fichiers sont chargés automatiquement dès que vous instanciez une nouvelle classe.

#### Configuration de l'Autoloading

> Composer gère l'autoloading grâce à un fichier de configuration nommé `composer.json`. En définissant les règles dans la section `autoload`, Composer sait où trouver les classes de votre application en fonction de leur espace de noms.

**Pour configurer l'autoloading dans votre projet, assurez-vous que le contenu de votre fichier `composer.json` ressemble à ceci :**

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
```

> Dans cet exemple, PSR-4 est une norme qui spécifie comment les fichiers correspondant aux espaces de noms doivent être placés dans la structure des répertoires. Ici, toutes les classes sous l'espace de noms App\ seront chargées à partir du dossier src/.

**Regénération de l'Autoloader**
>Après avoir modifié ou vérifié que votre fichier composer.json est correctement configuré, vous devez régénérer l'autoloader pour mettre à jour les chemins de classe. Exécutez cette commande dans le terminal :

```bash
composer dump-autoload
```
> Cette commande permet à Composer de réanalyser les fichiers et de mettre à jour l'autoloader en fonction de la configuration spécifiée.
**4. Démarrage de l'application**

> Lancez le serveur intégré de PHP depuis la racine du projet :

```bash
php -S localhost:8000
```
**5. Accéder à l'application**
```http
http://localhost:8000
```

## Structure du projet

Ce projet est organisé en plusieurs dossiers et fichiers principaux pour faciliter le développement et la maintenance. Voici une description détaillée de chaque composant :

- **`src/`** : Ce dossier est le cœur de l'application. Il contient tous les éléments spécifiques au développement de votre application MVC, organisés en sous-dossiers :
  - **`model/`** : Contient les classes modèles qui gèrent la logique métier et les interactions avec la base de données. Les modèles sont responsables de récupérer, de manipuler et de stocker les données.
  - **`view/`** : Contient les fichiers qui génèrent l'output utilisateur (frontend). Ces fichiers sont principalement composés de HTML avec des insertions de PHP pour rendre les données dynamiques provenant des modèles.
  - **`controller/`** : Contient les classes contrôleurs qui reçoivent les entrées de l'utilisateur, font le traitement nécessaire en faisant appel aux modèles, et sélectionnent la vue appropriée à afficher.
  - **`data/`** : Un sous-dossier spécialisé pour gérer la configuration et les interactions avec la base de données, comme la classe `Database` utilisant le Singleton Pattern pour la connexion à la base de données.

- **`vendor/`** : Dossier généré automatiquement par Composer. Il contient toutes les bibliothèques et dépendances tierces que votre projet utilise. Ce dossier ne devrait pas être modifié manuellement, car Composer le gère à travers les fichiers `composer.json` et `composer.lock`.

- **`index.php`** : Fichier point d'entrée de l'application. Ce fichier initialise l'application, configure les dépendances et routage, et démarre le processus de traitement des requêtes utilisateur. Il charge l'autoloader de Composer, instancie le contrôleur principal, et délègue le contrôle à celui-ci pour la gestion des actions requises.

### Note sur la structure:

- Chaque composant et dossier est conçu pour séparer clairement les responsabilités au sein de l'application, suivant les principes du modèle MVC. Cette séparation aide à maintenir le code organisé, facile à tester, et simplifie la modification ou l'extension des fonctionnalités à l'avenir.


## Exercice - Pas à pas

### 1. Installer la bibliothèque Dotenv
Avant de configurer la connexion à la base de données, il est essentiel de sécuriser les informations de connexion en les stockant dans des variables d'environnement. Nous utiliserons la bibliothèque `vlucas/phpdotenv` pour charger ces variables depuis un fichier `.env`.

> **Instructions :**
> - Exécutez la commande suivante pour installer la bibliothèque Dotenv via Composer :
>   ```bash
>   composer require vlucas/phpdotenv
>   ```

### 2. Créer le fichier `.env`
Créez un fichier `.env` à la racine de votre projet pour stocker les identifiants de votre base de données de manière sécurisée. Assurez-vous que ce fichier n'est pas ajouté à votre système de contrôle de version en l'ajoutant à votre fichier `.gitignore`.

> **Contenu du fichier `.env` :**
> ```
> DB_HOST=localhost
> DB_NAME=ma_base_de_donnees
> DB_USERNAME=mon_utilisateur
> DB_PASSWORD=mon_mot_de_passe
> ```

### 3. Créer le fichier `Database.php` pour la connexion à la base de données
**Objectif : Établir une connexion à la base de données réutilisable à travers toute l'application.**

> **Instructions :**
> - Utiliser le pattern Singleton pour s'assurer qu'une seule instance de connexion à la base de données est créée.
> - Utiliser PDO pour la connexion afin de profiter de ses avantages en termes de sécurité et de facilité d'utilisation.
> - Charger les informations de connexion depuis le fichier `.env` à l'aide de la bibliothèque Dotenv.
> - Gérer les exceptions pour capturer et traiter les erreurs de connexion.

> **Exemple de mise en œuvre dans `Database.php` :**
```php
 <?php
use Dotenv\Dotenv;
use PDO;
use PDOException;
use RuntimeException;

use Dotenv\Dotenv; // Importe la classe Dotenv de la bibliothèque vlucas/phpdotenv pour utiliser les variables d'environnement
use PDO; // Importe la classe PDO pour l'utilisation de la connexion à la base de données
use PDOException; // Importe la classe d'exception PDOException pour gérer les erreurs de connexion
use RuntimeException; // Importe la classe RuntimeException pour lancer des exceptions en cas d'erreur

class Database {
    private static $instance; // Déclare une propriété statique qui gardera l'instance unique de la classe (Singleton)

    private $conn; // Déclare une propriété pour stocker l'objet de connexion à la base de données

    private function __construct() { // Constructeur privé pour empêcher l'instanciation directe de la classe
        $this->loadCredentials(); // Appelle la méthode pour charger les informations de connexion et établir la connexion
    }

    public static function getInstance() { // Méthode publique statique pour obtenir l'instance unique de la classe
        if (!isset(self::$instance)) { // Vérifie si l'instance n'existe pas déjà
            self::$instance = new Database(); // Crée une nouvelle instance de la classe si elle n'existe pas
        }
        return self::$instance; // Retourne l'instance existante ou nouvellement créée
    }

    public function getConnection() { // Méthode publique pour obtenir l'objet de connexion à la base de données
        return $this->conn; // Retourne la propriété conn qui contient l'objet PDO de connexion à la base de données
    }

    private function loadCredentials() { // Méthode privée pour charger les informations de connexion à partir des variables d'environnement
        $dotenv = Dotenv::createImmutable(__DIR__); // Crée un objet Dotenv pour le répertoire courant
        $dotenv->load(); // Charge les variables d'environnement du fichier .env dans le répertoire courant

        $host = $_ENV['DB_HOST']; // Récupère le nom d'hôte de la base de données depuis les variables d'environnement
        $dbName = $_ENV['DB_NAME']; // Récupère le nom de la base de données depuis les variables d'environnement
        $username = $_ENV['DB_USERNAME']; // Récupère le nom d'utilisateur de la base de données depuis les variables d'environnement
        $password = $_ENV['DB_PASSWORD']; // Récupère le mot de passe de la base de données depuis les variables d'environnement

        $this->establishConnection($host, $dbName, $username, $password); // Appelle la méthode pour établir la connexion à la base de données avec les informations chargées
    }

    private function establishConnection($host, $dbName, $username, $password) { // Méthode privée pour établir la connexion à la base de données
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

```

- ### 2. Créer le modèle Book.php
**Objectif : Gérer toutes les opérations liées aux livres dans la base de données.**

> **Instructions :**
Créer une classe `Book` qui utilisera l'instance de connexion de `Database.php`.
Implémente des méthodes pour effectuer les opérations `CRUD` (Créer, Lire, Mettre à jour, Supprimer) sur les livres.
S'assurer que chaque méthode gère proprement les données et les exceptions.

- ### 3. Continuation du développement MVC
> Après avoir configuré la base de données et le `modèle`, les prochaines étapes incluront la création des `contrôleurs` et des `vues` pour interagir avec ces modèles.

- ### 4. Créer le contrôleur BookController.php

**Objectif : Orchestrer la communication entre les vues et le modèle Book.**

> **Instructions :**
Créer une classe `BookController` qui initialisera le modèle `Book`.
Ajouter des méthodes pour chaque action utilisateur possible (affichage, ajout, modification, suppression de livres).
S'assurer que le `contrôleur` passe les données appropriées à la vue.

- ### 5. Créer les vues pour afficher et gérer les livres

**Objectif : Fournir des interfaces utilisateur pour interagir avec l'application.**

> **Instructions :**
Créer des fichiers de `vue` en PHP qui `afficheront les données des livres` et contiendront des `formulaires pour les entrées de l'utilisateur`.
S'assurer que les `vues utilisent les données fournies par le contrôleur` pour afficher correctement le contenu.