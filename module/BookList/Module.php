<?php

namespace BookList;

/**
 * Book List Module Class
 * @author ahmed hamdy <ahmedhamdy20@gamil.com>
 */
class Module
{
    /**
     * Get AutoLoader Configuration
     * <br/> responsible for load autoloader file
     *       which used to load classes files in BookList Module
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
                )
            )
        );
        
    }        

   /**
    * Get Configuration
    * <br/> responsible for include module.config file 
    *       which contains configuration for BookList Module   
    * @return string
    */
    public function getConfig()
    {
       return include __DIR__ . '/config/module.config.php';        
    }        
    
}