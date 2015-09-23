<?php

namespace Album;

use Album\Model\Album;
use Album\Model\AlbumTable;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

/**
 * Album Module Class
 * <br/> Used for load and configure Album Module
 * @package Album
 * @author Ahmed Hamdy <ahmedhamdy20@gmail.com>
 */
class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    /**
     * Get AutoLoader Configuration
     * <br/> responsible for load autoloader file
     *       which used to load classes files in Album Module
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Get Configuration
     * <br/> responsible for include module.config file
     *       which contains configuration for Album Module
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * Get Service Configuration
     * <br/> responsible for initialize service Objects and
     *       Album(act as Service configuration provider) to
     *       merge service configuration with ServiceManger Instance
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Album\Model\AlbumTable' => function($sm) {
                     $tableGateway = $sm->get('AlbumTableGateway');
                     $table        = new AlbumTable($tableGateway);
                     return $table;
                },
                'AlbumTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Album());
                    return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
                },                                
            )
        );
    }        
}