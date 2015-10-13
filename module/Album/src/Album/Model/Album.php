<?php
namespace Album\Model;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;

/**
 * Album Model
 * <br/> repersent as Album Entity
 * @package Album\Model
 * @author Ahmed Hamdy <ahmedhamdy20@gmail.com>
 */
class Album implements InputFilterAwareInterface
{
    public $id;
    public $title;
    public $artist;
    
    protected $inputFilter;
    
    /**
     * Exchange(ReSetting) Album Entity`s properties  
     * with new Data array Contains Album Object Details
     * @param Array $data Array of data
     */
    public function exchangeArray($data) 
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->title  = (!empty($data['title'])) ? $data['title']: null; 
        $this->artist = (!empty($data['artist'])) ? $data['artist']: null; 
    }

    /**
     * Get Properties of Album Entity Object as an array
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * {@inheritDoc}
     * @throws \Exception when calling this function
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
    
    /**
     * {@inheritDoc}
     */
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            
            $inputFilter->add(array(
               'name'     => 'id',
               'required' => true,
               'filters'  => array(
                   array('name' => 'Int')
               ) 
            ));
            
            $inputFilter->add(array(
               'name'     => 'title',
               'required' => true,
               'filters'  => array(
                   array('name' => 'StripTags'),
                   array('name' => 'StringTrim'),
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
               'name'     => 'artist',
               'required' => true,
               'filters'  => array(
                   array('name' => 'StripTags'),
                   array('name' => 'StringTrim'),
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