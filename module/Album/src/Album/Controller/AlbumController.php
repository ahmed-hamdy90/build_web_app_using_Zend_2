<?php

namespace Album\Controller;

use Album\Model\AlbumTable;
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
        return new ViewModel();        
    }        
    
    /**
     * Edit Action
     * <br/> Used to Edit Exists Album
     * @return ViewModel edit view
     */
    public function editAction()
    {
        return new ViewModel();        
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