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
    'view_manager' => array(
        'template_path_stack' => array(
            'book' => __DIR__ . '/../view',
        ),
    ),
);