<?php

namespace BookList\Controller;

use BookList\Form\BookForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BookController extends AbstractActionController
{
    /**
     * Index Action
     * <br/> Responsible for Display List of Books which saved into DataBase
     * @return ViewModel index view
     */
    public function indexAction()
    {
        return new ViewModel(array(
            'books' => []
        ));
    }

    /**
     * Add Action
     * <br/> Responsible for :
     *       <br/>In case Get verb  -> Display Add new Book Form
     *       <br/>In case Post verb -> Add new book details into Database after Submit Book Form
     * @return ViewModel add view
     */
    public function addAction()
    {
        $form = new BookForm();
            $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        // Check If request is Post verb
        if ($request->isPost()) {

        }

        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function editAction()
    {

    }

    public function deleteAction()
    {

    }

}