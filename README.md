# symfony_user

Installation process

Clone the blog from github to your computer
Run composer install
Add database configuration .env file
Run php bin/console doctrine:database:create to create the database
Run php bin/console doctrine:migrations:diff to create migration
Run php bin/console doctrine:migrations:migrate to execute the migration
Run php bin/console doctrine:fixtures:load to insert the default user into database
