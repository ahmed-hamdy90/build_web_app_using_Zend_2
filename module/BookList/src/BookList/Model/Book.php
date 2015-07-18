<?php

     namespace BookList\Model;

     class Book 
     {
         public $id;
         public $title;
         public $author;

        /**
         * Exhange(ReSetting) paramters of Book Object 
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
