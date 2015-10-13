<?php
namespace Album\Controller;

use Album\Model\Album;
use Album\Model\AlbumTable;
use Album\Form\AlbumForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Album Controller
 * @package Album\Controller
 * @author Ahmed Hamdy <ahmedhamdy20@gmail.com>
 */
class AlbumController extends AbstractActionController
{
    /**
     * Album Table instance 
     * @var AlbumTable 
     */
    protected $albumTable;
    
    /**
     * Index Action 
     * <br/> Used to Display Album List
     * @return ViewModel index view
     */
    public function indexAction()
    {        
        return new ViewModel(array(
           'albums' => $this->getAlbumTable()->fetchAll()
        ));
    }
    
    /**
     * Add Action
     * <br/> Used to create a new Album
     * @return ViewModel add View 
     */
    public function addAction()
    {
        $form = new AlbumForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $album = new Album();
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $album->exchangeArray($form->getData());
                $this->getAlbumTable()->saveAlbum($album);

                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }        
    
    /**
     * Edit Action
     * <br/> Used to Edit Exists Album
     * @return ViewModel edit view
     */
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album', array(
                'action' => 'add'
            ));
        }

        // Get the album with the specified id.
        // An Exception is thrown if it connot be found, in which case go to index page
        try {
            $album = $this->getAlbumTable()->getAlbum($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('album', array(
                'action' => 'index'
            ));
        }

        $form = new AlbumForm();
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');
        // Or also can change Submit button value using setValue() method like into AddAction
        // $form->get('submit')->setValue('Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getAlbumTable()->saveAlbum($album);

                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }
        return new ViewModel(array(
            'id'   => $id,
            'form' => $form
        ));
    }        
    
    /**
     * Delete Action
     * <br/> Used to delete Exists Album
     * @return ViewModel delete view
     */
    public function deleteAction()
    {
        return new ViewModel();        
    }
    
    /**
     * Get AlbumTable Instance 
     * @return AlbumTable
     */
    public function getAlbumTable() 
    {
        if (!$this->albumTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Album\Model\AlbumTable');
        }
        return $this->albumTable;
    }        
}