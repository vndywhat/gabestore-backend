#echo "entrypoint ."
#pwd

processFile=docker/.laravel.lock
queueLockFile=docker/.queue-ready.lock

rm docker/.queue-ready.lock

# composer install
composer install
composer dumpautoload

if [ ! -f "$processFile" ]; then
    echo "$processFile does not exist."
    echo "Initial setup..."

    # waiting when db connection will ready
    while ! curl -o - --http0.9 mysqldb:3306; do sleep 5; done

    # prepare conf
    cp .env.example .env
    cp docker/etc/php/php.ini.example docker/etc/php/php.ini

    # app keygen
    php artisan key:generate

    #  migration
    php artisan migrate

    # init test user
    php artisan db:seed

    # passport install
    php artisan passport:install

    # public storage
    php artisan storage:link

    # touch install indication file
    touch docker/.laravel.lock
fi

# run migrate
php artisan migrate

# refresh doc
# php artisan scribe:generate

if [ ! -f "$queueLockFile" ]; then
    touch docker/.queue-ready.lock
fi

# execute CMD or command
TST=$@
#echo $TST
exec bash -c "$TST"
#exec $@
