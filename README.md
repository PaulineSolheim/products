# products
- Php 7.2  
- Symfony 4.2  
- Sqlite3

## Cloner le projet

- git clone https://github.com/PaulineSolheim/products.git

## Installer les dépendances

- installer nodeJs
- installer yarn et composer :  ``composer install`` et ``yarn install``

## Installer le projet et charger les fixtures 

- créer un fichier .env.local à la racine contenant les variables APP_ENV, APP_SECRET et DATABASE_URL
- indiquer le chemin de la base de données sqlite dans la variable DATABASE_URL
- ``php bin/console doctrine:database:create`` pour créer la base de données
- ``php bin/console doctrine:migration:migrate`` pour créer la structure
- ``php bin/console doctrine:fixtures:load`` pour peupler la base de données

## Compiler les assets et lancer le projet 

- ``yarn encore dev``
- ``php bin/console server:run``
- l’application est accessible sur localhost:8000

##Lancer les tests 

- ``composer require --dev symfony/phpunit-bridge``
- ``composer require --dev symfony/browser-kit symfony/css-selector``
- ``composer require --dev symfony/css-selector``
- exécuter un test spécifique : ``php bin/phpunit tests/ProductControllerTest.php`` ou ``php bin/phpunit tests/CartControllerTest.php``