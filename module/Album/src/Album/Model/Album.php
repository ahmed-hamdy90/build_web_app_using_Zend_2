<?php
namespace Album\Model;

/**
 * Album Model
 * <br/> repersent as Album Entity
 * @package Album\Model
 * @author Ahmed Hamdy <ahmedhamdy20@gmail.com>
 */
class Album
{
    public $id;
    public $title;
    public $artist;
    
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
}