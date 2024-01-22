<?php
namespace Usuarios;

use Laminas\Router\Http\Segment;
//use Laminas\ServiceManager\Factory\InvokableFactory;

return [
   /* 'controllers' => [
        'factories' => [
            Controller\UsuariosController::class => InvokableFactory::class,
        ],
    ],*/

    'router' => [
        'routes' => [
            'Usuarios' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/Usuarios[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\UsuariosController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],


    'view_manager' => [
        'template_path_stack' => [
            'Usuarios' => __DIR__ . '/../view',
        ],
    ],
];
?>