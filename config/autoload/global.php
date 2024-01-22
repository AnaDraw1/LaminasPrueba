<?php
 use laminas\Session\Storage\SessionArrayStorage;
 use laminas\Session\Validator\RemoteAddr;
 use laminas\Session\Validator\HttpUserAgent;

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

 return [
    'db' => [
        'driver' => 'Pdo',
        'dsn'    => sprintf('sqlite:%s/data/laminastutorial.db', realpath(getcwd())),
    ],
   
            // Session configuration.
            'session_config' => [
                // Session cookie will expire in 1 hour.
               // permite definir el tiempo de vida de la cookie y por cuanto tiempo el motor PHP almacenará nuestra información de sesión en el servidor. 
             'cookie_lifetime' => 60*60*1,
                // Session data will be stored on server maximum for 30 days.
             'gc_maxlifetime'     => 60*60*24*30,
            ],
            // Session manager configuration.
            'session_manager' => [
                // Session validators (used for security).
                'validators' => [
                    RemoteAddr::class,
                    HttpUserAgent::class,
                ]
            ],
            // Session storage configuration.
            'session_storage' => [
                'type' => SessionArrayStorage::class
            ],
        


            'session' => [
                
                'config' => [
                    'class' => \Laminas\Session\Config\SessionConfig::class,
                    'options' => [
                        'name' => 'session_name',
                    ],
                ],
                'storage' => \Laminas\Session\Storage\SessionArrayStorage::class,
                'validators' => [
                    \Laminas\Session\Validator\RemoteAddr::class,
                    \Laminas\Session\Validator\HttpUserAgent::class,
                ]
            ]
            // ...
        ];


   
