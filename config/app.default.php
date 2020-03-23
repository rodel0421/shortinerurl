<?php
return [
    'debug' => false,
    'App' => [
        'namespace' => 'App',
        'encoding' => env('APP_ENCODING', 'UTF-8'),
        'defaultLocale' => env('APP_DEFAULT_LOCALE', 'en_US'),
        'base' => false,
        'dir' => 'src',
        'webroot' => 'webroot',
        'wwwRoot' => WWW_ROOT,
        // 'baseUrl' => env('SCRIPT_NAME'),
        'fullBaseUrl' => '__FULLBASEURL__',
        'imageBaseUrl' => 'img/',
        'cssBaseUrl' => 'css/',
        'jsBaseUrl' => 'js/',
        'paths' => [
            'plugins' => [ROOT . DS . 'plugins' . DS],
            'templates' => [APP . 'Template' . DS],
            'locales' => [APP . 'Locale' . DS],
        ],
    ],
    /*'Client'=>[
        'contact_us_email'=>'',
        'privacy_policy_url'=>'',
        'requiredFields'=>[
            'User_supervisor'=>true,
            'User_supervisor_email'=>true,
            'User_supervisor_phone'=>true
            ]
    ],*/
    /*'Shibboleth'=>[
        'title'=>'Institutional Login',
        'password_help'=>'',
        'password_link'=>'',
        'url'=>'/Shibboleth.sso/Login',
        'dataSource'=>'/Shibboleth.sso/DiscoFeed'
        ],*/
    /*'CustomText'=>[
        'TripsSolo'=> //Show when only one person is on a trip
            '',
        'TripsNoSelf'=> //Show when they have stated that they are attending the trip but have not added themselves in the personnel list
            '',
        'EquipmentOverdue'=> //Text for email for overdue equipment
            '',
        'EquipmentReturnReminder'=> //Text for email for equipment due back next day
            '', 
        'TripSupervisor'=> //Wording for trip approval for supervisors
            '' 
    ],*/
    /*'LDAP'=>[
        'name'=>'',
        'password_help'=>'',
        'password_link'=>'',
        'ldap'=>[
            'default'=>[
                'base_dn'=>'',
                'admin_username' => '',
                'admin_password' => '',
                'admin_account_suffix'=>'',
                'account_suffix'=>'',
                'admin_account_prefix'=>'',
                'account_prefix'=>'',
                'domain_controllers'=>['']
        ]]
    ],*/
    'Security' => [
        'salt' => env('SECURITY_SALT', '__SALT__'),
    ],
    'Asset' => [
        // 'timestamp' => true,
    ],
    'Cache' => [
        'default' => [
            'className' => 'File',
            'path' => CACHE,
            'url' => env('CACHE_DEFAULT_URL', null),
        ],
        '_cake_core_' => [
            'className' => 'File',
            'prefix' => 'myapp_cake_core_',
            'path' => CACHE . 'persistent/',
            'serialize' => true,
            'duration' => '+1 years',
            'url' => env('CACHE_CAKECORE_URL', null),
        ],
        '_cake_model_' => [
            'className' => 'File',
            'prefix' => 'myapp_cake_model_',
            'path' => CACHE . 'models/',
            'serialize' => true,
            'duration' => '+1 years',
            'url' => env('CACHE_CAKEMODEL_URL', null),
        ],
    ],
    'Error' => [
        'errorLevel' => E_ALL,
        'exceptionRenderer' => 'Cake\Error\ExceptionRenderer',
        'skipLog' => ['Cake\Routing\Exception\MissingControllerException'],
        'log' => true,
        'trace' => true,
    ],
    'EmailTransport' => [
        'default' => [
            'className' => 'Mail',//Use PHP
        ],
    ],
    'Email' => [
        'default' => [
            'transport' => 'default',
            'from' => 'no-reply@localhost',
            //'charset' => 'utf-8',
            //'headerCharset' => 'utf-8',
        ],
    ],
    'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            
            'username' => '__USERNAME__',
            'password' => '__PASSWORD__',
            'database' => '__DATABASE__',
            'encoding' => 'utf8',
            'timezone' => 'UTC',
            'flags' => [],
            'cacheMetadata' => true,
            'log' => false,

            'quoteIdentifiers' => true,

            'url' => env('DATABASE_URL', null),
        ],
        'migrate' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            'username' => '__USERNAME___update',
            'password' => '__PASSWORD__',
            'database' => '__DATABASE__',
            'encoding' => 'utf8',
            'timezone' => 'UTC',
            'flags' => [],
            'cacheMetadata' => true,
            'log' => false,
            'quoteIdentifiers' => true,
            'url' => env('DATABASE_URL', null),
        ],
        'reports' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            'username' => '__USERNAME___ro',
            'password' => '__PASSWORD__',
            'database' => '__DATABASE__',
            'encoding' => 'utf8',
            'timezone' => 'UTC',
            'flags' => [],
            'cacheMetadata' => true,
            'log' => false,
            'quoteIdentifiers' => true,
            'url' => env('DATABASE_URL', null),
        ]
    ],
    'Log' => [
        'debug' => [
            'className' => 'Cake\Log\Engine\FileLog',
            'path' => LOGS,
            'file' => 'debug',
            'levels' => ['notice', 'info', 'debug'],
            'url' => env('LOG_DEBUG_URL', null),
        ],
        'error' => [
            'className' => 'Cake\Log\Engine\FileLog',
            'path' => LOGS,
            'file' => 'error',
            'levels' => ['warning', 'error', 'critical', 'alert', 'emergency'],
            'url' => env('LOG_ERROR_URL', null),
        ],
    ],
    'Session' => [
        'defaults' => 'php',
    ],
];
