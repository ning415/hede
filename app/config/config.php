<?php
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config([
    'database' => [
        'adapter'     => 'Mysql',
        'host'        => 'localhost:3307',
        'username'    => 'root',
        'password'    => 'banana',
        'dbname'      => 'pos_db',
        'charset'     => 'utf8',
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',

        // This allows the baseUri to be understand project paths that are not in the root directory
        // of the webpspace.  This will break if the public/index.php entry point is moved or
        // possibly if the web server rewrite rules are changed. This can also be set to a static path.
        'baseUri'        => preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]),
    ],
    'facebook' => [
      'appId' => '143633959587929',
      'appSecret' => 'e9039ce3aea5af5796772acb4a13d1a9',
      'version' => 'v2.10',
    ],
    'google' => [
        'clientId' => '112555135499-hdp2n7ia34743ekqb7gbnv0kkmtntsrg.apps.googleusercontent.com',
        'clientSecret' => 'nlH1Bzm_BN_x1-rxRbW_8gUG',
        'redirect' => 'http://localhost/tutorial_phalcon/authen/googlecallback',
        'profile' => 'http://localhost/tutorial_phalcon/authen/profile',
    ]
]);
