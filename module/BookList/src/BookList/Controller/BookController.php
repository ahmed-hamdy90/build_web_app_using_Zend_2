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
     *       <br/>In case Post verb -> Add new book details into Database
     *                                 After Submit Book Form
     * @return ViewModel add view
     */
    public function addAction()
    {
        $form = new BookForm();
            $form->get('submit')->setValue('Add');
            // Another way to set Submit button value
            // $form->get('submit')->setAttribute('value', 'Add');

        $request = $this->getRequest();
        // Check If request is Post verb
        if ($request->isPost()) {

        }

        return new ViewModel(array(
            'form' => $form
        ));
    }

    /**
     * Edit Action
     * <br/> Responsible for :
     *       <br/>In case Get verb  -> Display Edit Exists Book Form
     *       <br/>In case Post verb -> Edit Exists book with new submitted details
     *                                 and updated book details into Database
     *                                 After Submit Book Form
     * @return ViewModel edit view
     */
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $form = new BookForm();
            //$form->bind($book);
            $form->get('submit')->setValue('Edit');

        $request = $this->getRequest();
        // Check If Request Is Post Verb
        if ($request->isPost()) {

        }

        return new ViewModel(array(
            'id'   => $id,
            'form' => $form
        ));
    }

    /**
     * Delete Action
     * <br/> Responsible for :
     *       <br/>In case Get verb  -> Display Delete Exists Book Form
     *       <br/>In case Post verb -> delete Exists book from Database
     *                                 After Submit Book Form
     * @return ViewModel edit view
     */
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id) {

            return $this->redirect()->toRoute('book');
        }

        $request = $this->getRequest();
        // Check If Request if Post Verb
        if ($request->isPost()) {

        }

        return new ViewModel(array(
            'id'   => $id,
            //'book' => $book
        ));
    }

}