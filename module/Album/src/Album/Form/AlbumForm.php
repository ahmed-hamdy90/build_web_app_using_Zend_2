<?php
namespace Album\Form;

use Zend\Form\Form;

/**
 * Album Form Class
 * <br/> repersent Form Which will used to add/Edit an Album 
 * @package Album\Form
 * @author Ahmed Hamdy <ahmedhamdy20@gmail.com>
 */
class AlbumForm extends Form 
{
   /**
    * Album Form Constructor
    * @param string $name form name
    */
   public function  __construct($name = null)
   {
       // we want to ignore the name passed
       parent::__construct("album");
       
       $this->add(array(
           'name' => 'id',
           'type' => 'Hidden'
       ));
       
       $this->add(array(
           'name'    => 'title',
           'type'    => 'Text',
           'options' => array(
               'label' => 'Title'
           )
       ));
       
       $this->add(array(
           'name'    => 'title',
           'type'    => 'Text',
           'options' => array(
               'label' => 'Title'
           )
       ));
       
       $this->add(array(
           'name'    => 'artist',
           'type'    => 'Text',
           'options' => array(
               'label' => 'Artist'
           )
       ));
       
       $this->add(array(
           'name'       => 'submit',
           'type'       => 'Submit',
           'attributes' => array(
               'value' => 'Go',
               'id'    => 'submitbutton'
           )
       ));
   }        
}