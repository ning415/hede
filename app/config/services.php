<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Http\Response\Cookies;
use Phalcon\Crypt;

$di->set("cookies",function () use ($di) {
        $cookies = new Cookies();
        $cookies->setDI($di);
        $cookies->useEncryption(true);

        return $cookies;
    }
);

$di->set("crypt",function () {
        $crypt = new Crypt();
        $crypt->setKey('#1dj8$=dp?.ak//j1V$'); // Use your own key!
        // $crypt->usePadding(false);

        return $crypt;
    }
);

$di->set('facebook', function () {
  $config = $this->getConfig();

  include __DIR__ . "/../../public/lib/Facebook/autoload.php";

  return new Facebook\Facebook([
    'app_id' => $config->facebook->appId,
    'app_secret' => $config->facebook->appSecret,
    'default_graph_version' => $config->facebook->version,
  ]);
}, true);

$di->set('google_client', function () {
  $config = $this->getConfig();

  include __DIR__ . "/../../public/lib/Google/src/Google/autoload.php";

  $client = new Google_Client();
  $client->setClientId($config->google->clientId);
  $client->setClientSecret($config->google->clientSecret);
  $client->setRedirectUri($config->google->redirect);
  $client->addScope("email");
    $client->addScope("profile");

  return $client;
}, true);

$di->set('google_service_oauth2', function () {
  $config = $this->getConfig();

  include __DIR__ . "/../../public/lib/Google/src/Google/autoload.php";

  $client = new Google_Client();
  $client->setClientId($config->google->clientId);
  $client->setClientSecret($config->google->clientSecret);
  $client->setRedirectUri($config->google->redirect);

  return new Google_Service_Oauth2($client);
}, true);

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    $view->setDI($this);
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines([
        '.volt' => function ($view) {
            $config = $this->getConfig();

            $volt = new VoltEngine($view, $this);

            $volt->setOptions([
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ]);

            $compiler = $volt->getCompiler();
            $compiler->addFunction('number_format','number_format');

            return $volt;
        },
        '.phtml' => PhpEngine::class

    ]);

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);

    return $connection;
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

$di->set('flashSession', function () { // เปลี่ยนชื่อ Service
    return new FlashSession([ // เริ่มใช้ Service
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});
