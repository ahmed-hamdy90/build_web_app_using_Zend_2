<?php 

return array(
    'controllers' => array(
          'invokables' => array(
               'BookList\Controller\Book' => 'BookList\Controller\BookController',
          ),
    ),
    'router' => array(
        'routes' => array(
            // Move Home Route for Book List Application 
            // From module/Application/config/modue.config.php file
            // To   module/BookList/config/module.config.php file 
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'BookList\Controller\Book',
                        'action'     => 'index',
                    ),
                ),
            ),
            'book' => array(
                'type'    => 'segment',
                'options' => array(
                    'route' => '/book[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'BookList\Controller\Book',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    // Create SiteMap navigation for BookList Module
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'home'
            ),
            array(
                'label' => 'Book',
                'route' => 'book',
                'pages' => array(
                    array(
                        'label'  => 'Add',
                        'route'  => 'book',
                        'action' => 'add'
                    ),
                    array(
                        'label'  => 'Edit',
                        'route'  => 'book',
                        'action' => 'edit'
                    ),
                    array(
                        'label'  => 'Delete',
                        'route'  => 'book',
                        'action' => 'delete'
                    )
                )
            )
        )
    ),
    'service_manager' => array(
        'factories' => array(
            // import navigation Factory Which Used to create BreadCrumb
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            // import authentication Adapter Factory
            // Which used to create basic Http Authentication on Book List Module
            'AuthenticationAdapter' => 'BookList\Factory\AuthenticationAdapterFactory'
        ),
    ),
    // Http Authentication Configuration
    'book_app' => array(
        'auth_adapter' => array(
            'config' => array(
                'accept_schemes' => 'basic digest',
                'realm'          => 'Book List Site',
                'digest_domains' => '/book',
                'nonce_timeout'  => 3600,
            ),
            'basic_passwd_file'  => __DIR__ . '/real/basic_passwd.txt',
            'digest_passwd_file' => __DIR__ . '/real/digest_passwd.txt',            
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'book' => __DIR__ . '/../view',
        ),
    ),
);