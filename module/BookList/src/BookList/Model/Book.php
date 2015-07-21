<?php

 namespace BookList\Model;

 /**
  * Book Model
  * @package BookList\Model
  * @author ahmed hamdy <ahmedhamdy20@gmail>
  */
 class Book
 {
     public $id;
     public $title;
     public $author;

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

 }
