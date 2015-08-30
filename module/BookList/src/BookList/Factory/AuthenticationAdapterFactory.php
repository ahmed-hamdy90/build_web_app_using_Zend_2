<?php

namespace BookList\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Authentication\Adapter\Http as HttpAdapter;
use Zend\Authentication\Adapter\Http\FileResolver;

/**
 * Authentication Adapter Factory
 * <br/> Which Used to Generate Authentication Adapter
 * for Basic Http Authentication 
 * @author Ahmed Hamdy <ahmedhamdy20@gamil.com>
 */
class AuthenticationAdapterFactory implements FactoryInterface
{    
    /**
     * Genrate Authentication Adapter Object
     * @param ServiceLocatorInterface $serviceLocator service manager 
     * @return \Zend\Authentication\Adapter\Http
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config     = $serviceLocator->get('config');
        $authConfig = $config['book_app']['auth_adapter'];
        
        $basicResolver = new FileResolver();
        $basicResolver->setFile($authConfig['basic_passwd_file']);
        
        $digestResolver = new FileResolver();
        $digestResolver->setFile($authConfig['digest_passwd_file']);

        $authAdapter = new HttpAdapter($authConfig['config']);
        $authAdapter->setBasicResolver($basicResolver);
        $authAdapter->setDigestResolver($digestResolver);
        
        return $authAdapter;
    }
}