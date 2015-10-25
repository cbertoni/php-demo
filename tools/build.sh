#!/bin/sh

composer install  || exit 1
./vendor/bin/phpunit  || exit 1
php -S localhost:9876 public/app.php &
./vendor/bin/behat  || exit 1

INTS=$?
kill -s SIGTERM  %%

git status

exit ${INTS}
