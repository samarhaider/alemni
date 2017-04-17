<?php
return [
    /*
      |--------------------------------------------------------------------------
      | Application Name
      |--------------------------------------------------------------------------
      |
      | This value is the name of your application. This value is used when the
      | framework needs to place the application's name in a notification or
      | any other location as required by the application or its packages.
     */

    'name' => 'Laravel',
    /*
      |--------------------------------------------------------------------------
      | Application Environment
      |--------------------------------------------------------------------------
      |
      | This value determines the "environment" your application is currently
      | running in. This may determine how you prefer to configure various
      | services your application utilizes. Set this in your ".env" file.
      |
     */
    'env' => env('APP_ENV', 'production'),
    /*
      |--------------------------------------------------------------------------
      | Application Debug Mode
      |--------------------------------------------------------------------------
      |
      | When your application is in debug mode, detailed error messages with
      | stack traces will be shown on every error that occurs within your
      | application. If disabled, a simple generic error page is shown.
      |
     */
    'debug' => env('APP_DEBUG', false),
    /*
      |--------------------------------------------------------------------------
      | Application URL
      |--------------------------------------------------------------------------
      |
      | This URL is used by the console to properly generate URLs when using
      | the Artisan command line tool. You should set this to the root of
      | your application so that it is used when running Artisan tasks.
      |
     */
    'url' => env('APP_URL', 'http://localhost'),
    /*
      |--------------------------------------------------------------------------
      | Application Timezone
      |--------------------------------------------------------------------------
      |
      | Here you may specify the default timezone for your application, which
      | will be used by the PHP date and date-time functions. We have gone
      | ahead and set this to a sensible default for you out of the box.
      |
     */
    'timezone' => 'UTC',
    /*
      |--------------------------------------------------------------------------
      | Application Locale Configuration
      |--------------------------------------------------------------------------
      |
      | The application locale determines the default locale that will be used
      | by the translation service provider. You are free to set this value
      | to any of the locales which will be supported by the application.
      |
     */
    'locale' => 'en',
    /*
      |--------------------------------------------------------------------------
      | Application Fallback Locale
      |--------------------------------------------------------------------------
      |
      | The fallback locale determines the locale to use when the current one
      | is not available. You may change the value to correspond to any of
      | the language folders that are provided through your application.
      |
     */
    'fallback_locale' => 'en',
    /*
      |--------------------------------------------------------------------------
      | Encryption Key
      |--------------------------------------------------------------------------
      |
      | This key is used by the Illuminate encrypter service and should be set
      | to a random, 32 character string, otherwise these encrypted strings
      | will not be safe. Please do this before deploying an application!
      |
     */
    'key' => env('APP_KEY'),
    'cipher' => 'AES-256-CBC',
    /*
      |--------------------------------------------------------------------------
      | Logging Configuration
      |--------------------------------------------------------------------------
      |
      | Here you may configure the log settings for your application. Out of
      | the box, Laravel uses the Monolog PHP logging library. This gives
      | you a variety of powerful log handlers / formatters to utilize.
      |
      | Available Settings: "single", "daily", "syslog", "errorlog"
      |
     */
    'log' => env('APP_LOG', 'single'),
    'log_level' => env('APP_LOG_LEVEL', 'debug'),
    /*
      |--------------------------------------------------------------------------
      | Autoloaded Service Providers
      |--------------------------------------------------------------------------
      |
      | The service providers listed here will be automatically loaded on the
      | request to your application. Feel free to add your own services to
      | this array to grant expanded functionality to your applications.
      |
     */
    'providers' => [
        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
        /*
         * Package Service Providers...
         */
        Laravel\Tinker\TinkerServiceProvider::class,
        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        /*
         * Added By Samar...
         */
        Dingo\Api\Provider\LaravelServiceProvider::class, # Added on 16-Feb-2017
        Tymon\JWTAuth\Providers\JWTAuthServiceProvider::class, # Added on 16-Feb-2017
        Brotzka\DotenvEditor\DotenvEditorServiceProvider::class, # Added on 16-Feb-2017
        Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider::class, # Added on 16-Feb-2017
//        Artdarek\OAuth\OAuthServiceProvider::class, # Added on 17-Feb-2017
        SimpleSoftwareIO\SMS\SMSServiceProvider::class, # Added on 17-Feb-2017
        Laravel\Socialite\SocialiteServiceProvider::class, # Added on 29-Mar-2017
        Qylinfly\ActionLog\ActionLogServiceProvider::class, # Added on 30-Mar-2017
        Laracademy\Generators\GeneratorsServiceProvider::class, # Added on 05-Apr-2017
        \Conner\Tagging\Providers\TaggingServiceProvider::class, # Added on 07-Apr-2017
        Matriphe\Imageupload\ImageuploadServiceProvider::class, # Added on 15-Apr-2017
        Gerardojbaez\Messenger\MessengerServiceProvider::class, # Added on 15-Apr-2017
    ],
    /*
      |--------------------------------------------------------------------------
      | Class Aliases
      |--------------------------------------------------------------------------
      |
      | This array of class aliases will be registered when this application
      | is started. However, feel free to register as many as you wish as
      | the aliases are "lazy" loaded so they don't hinder performance.
      |
     */
    'aliases' => [
        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        
        
        /*
         * Added By Samar...
         */
        'JWTAuth' => Tymon\JWTAuth\Facades\JWTAuth::class, # Added on 16-Feb-2017
        'JWTFactory' => Tymon\JWTAuth\Facades\JWTFactory::class, # Added on 16-Feb-2017
        'DotenvEditor' => Brotzka\DotenvEditor\DotenvEditorFacade::class, # AdAdded on 16-Feb-2017
//        'OAuth'     => Artdarek\OAuth\Facade\OAuth::class, # AdAdded on 17-Feb-2017
        'SMS' => SimpleSoftwareIO\SMS\Facades\SMS::class, # AdAdded on 17-Feb-2017
        'Socialite' => Laravel\Socialite\Facades\Socialite::class, # Added on 29-Mar-2017
        'ActionLog' => Qylinfly\ActionLog\Facades\ActionLogFacade::class, # Added on 30-Mar-2017
        'Imageupload' => Matriphe\Imageupload\ImageuploadFacade::class, # Added on 15-Apr-2017
        'Messenger' => Gerardojbaez\Messenger\Facades\Messenger::class, # Added on 15-Apr-2017
    ],
    
//    'token_secret' => 'some random string',
//	'facebook_secret' => 'fed5207016307f1a7aaaed79811503f3',
//	'foursquare_secret' => '',
//	'google_secret' => '2dxQ-fyO4xGVNdxHnvpYDTRZ',
//	'google_client_id' => '426586124483-l4gnl9dmatfr8p88nikj6rv0p2l7ku4v.apps.googleusercontent.com',
//	'github_secret' => '',
//	'instagram_secret' => '',
//	'linkedin_secret' => '',
//	'live_secret' => '',
//	'yahoo_secret' => '',
//	'twitter_key' => 'dHWO2u5ZyiYP9KEqYvuSLg',
//	'twitter_secret' => 'aP9SGd9rNko4zfjPo972KEnFSfQuwyOu8yCr9FYRCM',
    
];
