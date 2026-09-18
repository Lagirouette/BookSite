# TomTroc - Structure MVC

projet PHP en architecture MVC.

Structure créée:

- `public/` : front controller et ressources publiques
- `app/router/` : classes de base (autoloader, controller, router)
- `app/Controllers/` : contrôleurs
- `app/Models/` : modèles
- `app/Views/` : vues
- `config/` : fichiers de configuration
- `migrations/` : schéma SQL
- `assets/` : CSS et images

Fichiers importants:

- `public/index.php` : point d'entrée
- `app/router/Autoloader.php` : autoload simple
- `app/router/Controller.php` : classe de base pour les contrôleurs
- `config/database.php` : paramètres de connexion
- `migrations/schema.sql` : schéma initial (utilisateurs, livres, messages)
- `migrations/seed.sql` : données de démonstration pour commencer

Lancer le serveur PHP depuis la racine du projet :

```bash
php -S localhost:8000 -t public public/index.php
```

Initialiser la base de données avec MySQL :

```bash
mysql -u root -p tomtroc < migrations/schema.sql
mysql -u root -p tomtroc < migrations/seed.sql
```

