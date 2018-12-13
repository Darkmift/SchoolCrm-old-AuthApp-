<?php
session_start();
use Respect\Validation\Validator as v;

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            //site settings
            // 'host' => 'sql206.epizy.com',
            // 'database' => 'epiz_21822353_schoolcrm',
            // 'username' => 'epiz_21822353',
            // 'password' => 'RagnarokAkiVa45',
            //localhost
            'host' => 'localhost',
            'database' => 'schoolcrm',
            'username' => 'Master',
            'password' => 'RagnarokAkiVa45',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ],
    ],

]);

require __DIR__ . '/container.php';
require __DIR__ . '/dbManager.php';

//my middlewares
$app->add(new App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new App\Middleware\OldInputMiddleware($container));
$app->add(new App\Middleware\CsrfViewMiddleware($container));

//csrf import2/2(see container for 1/2)
$app->add($container->csrf);

//my custom rules--called by respect---see first lines on top
v::with('App\\Validation\\Rules\\');

require __DIR__ . '/../app/routes.php';
