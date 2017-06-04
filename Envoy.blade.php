@servers(['alemni-server' => ['ubuntu@ec2-52-35-243-250.us-west-2.compute.amazonaws.com']])

@task('listing', ['on' => 'alemni-server'])
    cat /var/www/api
    ls -la
@endtask

@task('deploy-live', ['on' => 'alemni-server'])
    cd /var/www/api
    php artisan down
    git pull
    @if ($branch)
        git checkout {{ $branch }}
    @endif
    composer install
    php artisan migrate --force
    php artisan cache:clear
    php artisan config:cache
    php artisan route:cache
    php artisan artisan view:clear
    php artisan artisan optimize
    php artisan up
@endtask

@task('deploy-dev', ['on' => 'alemni-server'])
    cd /var/www/api
    php artisan down
    git pull
    @if ($branch)
        git checkout {{ $branch }}
    @endif
    composer install
    composer install
    php artisan migrate --force
    php artisan up
@endtask