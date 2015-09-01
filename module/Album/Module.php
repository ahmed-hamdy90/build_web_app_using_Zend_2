<?php

namespace Album;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

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
                'namespace' => array(
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

}