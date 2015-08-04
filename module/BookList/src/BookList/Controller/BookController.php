<?php

namespace BookList\Controller;

use BookList\Form\BookForm;
use BookList\Model\Book;
use BookList\Model\BookTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BookController extends AbstractActionController
{
    /**
     * BookTable Object
     * @var BookTable
     */
    protected $_bookTable;

    /**
     * Index Action
     * <br/> Responsible for Display List of Books which saved into DataBase
     * @return ViewModel index view
     */
    public function indexAction()
    {
        $pageNumber = (int) $this->params()->fromQuery('page', 1);

        $paginator = $this->getBookTable()->fetchAll(true);
        $paginator->setCurrentPageNumber($pageNumber);
        $paginator->setItemCountPerPage(3);

         return new ViewModel(array(
             'paginator' => $paginator
         ));
        /*
        // return All Book Objects Without Pagination
        return new ViewModel(array(
            'books' => $this->getBookTable()->fetchAll()
        ));
        */
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

            $book = new Book();
            $form->setInputFilter($book->getInputFilter());
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                   
                $book->exchangeArray($form->getData());
                $this->getBookTable()->saveBook($book);
            }
            
            // redirect to list of books
            return $this->redirect()->toRoute('book');
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
        $id   = (int) $this->params()->fromRoute('id', 0);
        $book = $this->getBookTable()->getBook($id);
        
        $form = new BookForm();
            $form->bind($book);
            $form->get('submit')->setValue('Edit');

        $request = $this->getRequest();
        // Check If Request Is Post Verb
        if ($request->isPost()) {

            $form->setInputFilter($book->getInputFilter());
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                
                $this->getBookTable()->saveBook($book);
                // redirect to list of Books
                return $this->redirect()->toRoute('book');
            }
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

            $del = $this->params()->fromPost('del', 'No');
            
            if ($del == 'Yes') {
             
                $id = (int) $this->params()->fromPost('id', 0);
                $this->getBookTable()->deleteBook($id);
            }            
            // redirect to list of books
            $this->redirect()->toRoute('book');
        }

        return new ViewModel(array(
            'id'   => $id,
            'book' => $this->getBookTable()->getBook($id)
        ));
    }

    /**
     * Get BookTable Object Using Service Manager
     * @return BookTable
     */
    public function getBookTable()
    {
        if (!$this->_bookTable) {

            // get Service Locator Manager
            $sm = $this->getServiceLocator();
            $this->_bookTable = $sm->get('BookList\Model\BookTable');
        }

        return $this->_bookTable;
    }

}