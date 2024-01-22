<?php
declare(strict_types=1);
namespace Usuario;

use Laminas\Router\Http\Segment;
//use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

 
return [
    'controllers' => [
        'factories' => [
            // Add this line
            Controller\YourController::class => ReflectionBasedAbstractFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'Usuario' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/Usuario[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\UsuarioController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],


    'view_manager' => [
        'template_path_stack' => [
            'Usuario' => __DIR__ . '/../view',
        ],
    ],
];
?>