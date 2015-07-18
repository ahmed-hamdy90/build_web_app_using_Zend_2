<?php

     namespace BookList\Model;
     
     use Zend\Db\TableGateway\TableGateway;
     
     class BookTable 
     {
         protected $_tableGateway;
         
         /**
          * Book Table Constructor 
          * @param TableGateway $tableGateway TableGateway Object
          */
         public function __construct(TableGateway $tableGateway)
         {
             $this->_tableGateway = $tableGateway;
         }
         
         /**
          * Fetch All Books Rows into book table in DataBase
          * @return \Zend\Db\ResultSet\ResultSet
          */
         public function fetchAll()
         {
             $resultSet = $this->_tableGateway->select();
             return $resultSet;
         }   
         
     }