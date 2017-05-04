
> composer update
> php artisan migrate
> cd public && npm install


> php artisan db:seed --class=StudentQuestionnariesSeeder
> php artisan db:seed --class=TutorQuestionnariesSeeder

For documentation creation
> php artisan api:docs --name API --use-version v2 --output-file api-documentation.md


https://github.com/DivineOmega/laravel-multiple-choice
http://stackoverflow.com/questions/7102521/database-design-for-developing-quiz-web-application-using-php-and-mysql


php artisan generate:modelfromtable --table=questions --folder=app/Models --namespace="app\Models"

https://marvelapp.com/1gg0873
