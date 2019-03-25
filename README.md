# products
Php 7.2
Symfony 4.2
Sqlite3

Pour installer le projet et charger les fixtures :
créer un fichier .env.local à la racine
indiquer le chemin de la base de données sqlite3 
lancer php bin/console doctrine:database:create pour créer la base de données
lancer php bin/console doctrine:migration:migrate pour créer la structure
lancer php bin/console doctrine:fixtures:load pour peupler la base de données

Pour compiler les assets :
installer nodeJs
installer yarn et composer
composer install et ‘yarn instal’l 

Pour lancer le projet :
php bin/console server:run
l’application est accessible sur localhost:8000

Pour lancer les test :
composer require --dev symfony/phpunit-bridge
composer require --dev symfony/browser-kit symfony/css-selector
composer require --dev symfony/css-selector
pour lancer un test spécifique : php bin/phpunit tests/ProductControllerTest.php
