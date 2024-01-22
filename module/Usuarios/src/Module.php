<?php
namespace Usuarios;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\UsuariosTable::class => function($container) {
                    $tableGateway = $container->get(Model\UsuariosTableGateway::class);
                    return new Model\UsuariosTable($tableGateway);
                },
                Model\UsuariosTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Usuarios());
                    return new TableGateway('Usuarios', $dbAdapter, null, $resultSetPrototype);
                },
            ],


            
        ];
    }


    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\UsuariosController::class => function($container) {
                    return new Controller\UsuariosController(
                        $container->get(Model\UsuariosTable::class)
                    );
                },
            ],
        ];
    }
}
?>


