# Projet Bibliothèque PHP MVC

Ce projet est une application simple de gestion de bibliothèque en PHP utilisant le modèle MVC. Il implémente les principes de la programmation orientée objet et utilise Composer pour l'autoloading. 

## Objectif ##
Fournir une application fonctionnelle permettant de gérer un CRUD des entrées de livres (ajout, modification, suppression et affichage).

## Rappel MVC ##
- `Modèle` : Gère la logique des données et les interactions avec la base de données (par exemple, des requêtes SQL directes).
- `Vue` : Présente les données à l'utilisateur (HTML, CSS) et peut contenir des scripts PHP pour afficher le contenu dynamique.
- `Contrôleur` : Fait le lien entre le modèle et la vue, traite les entrées de l'utilisateur, modifie les données du modèle et met à jour la vue.

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

## Structure du projet ##
- `src/`: Dossier contenant les `modèles`, les `vues`, les `contrôleurs` et la configuration de la base de données, `data`.
- `vendor/`: Dossier généré par `Composer` contenant les dépendances du projet.

## Exercice - Pas à pas ##
- ### 1. Créer le fichier `Database.php` pour la connexion à la base de données
**Objectif : Établir une connexion à la base de données réutilisable à travers toute l'application.**

>**Instructions :**
Utiliser le pattern Singleton pour s'assurer qu'une seule instance de connexion à la base de données est créée.
Utiliser PDO pour la connexion afin de profiter de ses avantages en termes de sécurité et de facilité d'utilisation.
Gèrer les exceptions pour capturer et traiter les erreurs de connexion.

>**Aide**
#### Comprendre le Singleton Pattern

Le **Singleton Pattern** est un modèle de conception utilisé en programmation orientée objet qui assure qu'une classe n'a qu'une seule instance et fournit un point d'accès global à cette instance. Ce pattern est particulièrement utile pour gérer des ressources partagées, telles que les connexions à une base de données, où plusieurs instances pourraient entraîner des problèmes de performance ou de cohérence.

#### Fonctionnement du Singleton Pattern

Pour implémenter le Singleton Pattern, suivez ces étapes :

1. **Rendre le constructeur privé :** Cela empêche l'instanciation directe de la classe depuis l'extérieur de celle-ci.

2. **Créer une propriété statique privée :** Cette propriété stockera l'unique instance de la classe.

3. **Fournir une méthode statique publique d'accès :** Cette méthode est le point d'accès global à l'instance. Elle vérifie si l'instance existe déjà, la crée si nécessaire et la retourne.

#### Utilisation du Singleton pour une connexion à la base de données

Un exemple pratique d'utilisation du Singleton Pattern est la gestion d'une connexion à une base de données. Voici un exemple d'implémentation en PHP :

```php
<?php

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        // Code de connexion à la base de données
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
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

- ### 4. Créer le contrôleur BooksController.php

**Objectif : Orchestrer la communication entre les vues et le modèle Book.**

> **Instructions :**
Créer une classe `BooksController` qui initialisera le modèle `Book`.
Ajouter des méthodes pour chaque action utilisateur possible (affichage, ajout, modification, suppression de livres).
S'assurer que le `contrôleur` passe les données appropriées à la vue.

- ### 5. Créer les vues pour afficher et gérer les livres

**Objectif : Fournir des interfaces utilisateur pour interagir avec l'application.**

> **Instructions :**
Créer des fichiers de `vue` en PHP qui `afficheront les données des livres` et contiendront des `formulaires pour les entrées de l'utilisateur`.
S'assurer que les `vues utilisent les données fournies par le contrôleur` pour afficher correctement le contenu.