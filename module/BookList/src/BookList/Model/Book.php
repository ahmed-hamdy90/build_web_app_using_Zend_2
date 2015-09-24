<?php
 namespace BookList\Model;

 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;
 use Zend\InputFilter\InputFilter;
 
 /**
  * Book Model
  * @package BookList\Model
  * @author ahmed hamdy <ahmedhamdy20@gmail>
  */
 class Book implements InputFilterAwareInterface
 {
     public $id;
     public $title;
     public $author;
     protected $inputFilter;

    /**
     * Exchange(ReSetting) parameters of Book Object
     * with new Data array Contains Book Object Details
     * @param array $data Array of Data
     */
    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->title  = (!empty($data['title'])) ? $data['title'] : null;
        $this->author = (!empty($data['author'])) ? $data['author'] : null;

    }

    /**
     * Get Properties of Book Object As an Array
     * @return array 
     */
    public function getArrayCopy()
    {
       return get_object_vars($this); 
    }
    
    /**
     * Set Input Filter Object
     * @param InputFilterInterface $inputFilter
     * @throws Exception if method called
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new Exception("Not Used");
    }
    
    /**
     * Get Input Filter Object
     * @return InputFilter
     */
    public function getInputFilter()
    {
     
        if (!$this->inputFilter) {
            
            $inputFilter = new InputFilter();
            
            $inputFilter->add(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));
            
            $inputFilter->add(array(
               'name'     => 'title',
               'required' => true,
               'filters'  => array(
                   array('name' => 'StripTags'),
                   array('name' => 'StringTrim')
               ),
               'validators' => array(
                   array(                       
                       'name'    => 'StringLength',
                       'options' => array(                           
                           'encoding' => 'UTF-8',
                           'min'      => 1,
                           'max'      => 100 
                       )
                   )
               )                
            ));
            
            $inputFilter->add(array(
               'name'     => 'author',
               'required' => true,
               'filters'  => array(
                   array('name' => 'StripTags'),
                   array('name' => 'StringTrim')
               ),
               'validators' => array(
                   array(                       
                       'name'    => 'StringLength',
                       'options' => array(                           
                           'encoding' => 'UTF-8',
                           'min'      => 1,
                           'max'      => 100 
                       )
                   )
               )                
            ));
            
            $this->inputFilter = $inputFilter;
        }
        
        return $this->inputFilter;
    }    
 }