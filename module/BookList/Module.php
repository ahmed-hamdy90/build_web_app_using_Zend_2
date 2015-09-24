<?php
namespace BookList;

use BookList\Model\Book;
use BookList\Model\BookTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\EventManager\EventInterface;
use Zend\Http\Request  as HttpRequest;
use Zend\Http\Response as HttpResponse;

/**
 * Book List Module Class
 * @author ahmed hamdy <ahmedhamdy20@gamil.com>
 */
class Module implements ConfigProviderInterface, BootstrapListenerInterface
{
    /**
     * On BootStrap Listener for Book List Module
     * @param EventInterface $event Event Manager Object 
     */
    public function onBootstrap(EventInterface $event)
    {        
        $appliaction    = $event->getTarget();
        $serviceManager = $appliaction->getServiceManager();
        
        $appliaction
            ->getEventManager()
            ->attach(MvcEvent::EVENT_DISPATCH, function (MvcEvent $e) use ($serviceManager) {
                $request  = $e->getRequest();
                $response = $e->getResponse();
                
                if (!($request instanceof HttpRequest && $response instanceof HttpResponse)) {
                    return; // we are not in HTTP context - CLI application?
                }
                
                $authAdapter = $serviceManager->get('AuthenticationAdapter');
                $authAdapter->setRequest($request);
                $authAdapter->setResponse($response);
                $result = $authAdapter->authenticate();                

                // Then check the result of basic Http authentication 
                if ($result->isValid()) {
                    return; // erverything OK   
                }
                // Otherwise return Access Denaid to Book List Site
                $response->setContent('Access Denied');
                $response->setStatusCode(HttpResponse::STATUS_CODE_401);

                $e->setResult($response); // short-circuit to application to end
                return false; // stop event propagation  
            });        
    }  
    
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
    * @return mixed
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