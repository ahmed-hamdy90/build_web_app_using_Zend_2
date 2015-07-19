<?php

namespace BookList;

use BookList\Model\Book;
use BookList\Model\BookTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

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

    /**
     * Get Service Configuration
     * <br/> responsible for initialize service Objects and
     *       BookList(act as Service configuration provider) to
     *       merge service configuration with ServiceManger Instance
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'BookList\Model\BookTable' => function($sm) {

                    $tableGateway = $sm->get('BookTableGateway');
                    $table        = new BookTable($tableGateway);
                    return $table;
                },
                'BookTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Book());
                    return new TableGateway(
                        'book',
                        $dbAdapter,
                        null,
                        $resultSetPrototype
                    );
                },
            ),
        );

    }

}