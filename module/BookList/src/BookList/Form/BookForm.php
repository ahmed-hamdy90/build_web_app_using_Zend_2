<?php
namespace BookList\Form;

use Zend\Form\Form;

class BookForm extends Form
{
    /**
     * Book Form Constructor
     * @param String|null $name name for Book form
     */
    public function __construct($name=null)
    {
        // we want to ignore the name of Form Which passed as parameter
        parent::__construct("book");

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
            'name'    => 'author',
            'type'    => 'Text',
            'options' => array(
                'label' => 'author'
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