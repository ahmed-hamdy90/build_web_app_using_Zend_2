<?php

 namespace BookList\Model;

 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\Sql\Select;
 use Zend\Db\TableGateway\TableGateway;
 use Zend\Paginator\Adapter\DbSelect;
 use Zend\Paginator\Paginator;

 /**
  * BookTable
  * @package BookList\Model
  * @author ahmed hamdy <ahmedhamdy20@gmail.com>
  */
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
      * Fetch All Books Rows form book table into Database
      * @param boolean $paginated flag for apply pagination on retrieving Book Rows from book table or not
      * @return ResultSet|Paginator
      */
     public function fetchAll($paginated=false)
     {
         if ($paginated) {

             $select = new Select('book');
             $resultSetPrototype = new ResultSet();
             $resultSetPrototype->setArrayObjectPrototype(new Book());
             $paginatorAdapter = new DbSelect(
                 $select,
                 $this->_tableGateway->getAdapter(),
                 $resultSetPrototype
             );
             $paginator = new Paginator($paginatorAdapter);
             return $paginator;
         }

         $resultSet = $this->_tableGateway->select();
         return $resultSet;
     }

     /**
      * Get Book Object Using it`s id form book Table in Database
      * @param int|string $id book`s Id
      * @return array|\ArrayObject Book Object
      * @throws \Exception If there is not Book row in Database with given id
      */
     public function getBook($id)
     {
         $bookId = (int) $id;

         $rowSet = $this->_tableGateway->select(array('id' => $bookId));
         $row    = $rowSet->current();

         if (!$row) {

             throw new \Exception("Could not find row {$bookId}");
         }

         return $row;
     }

     /**
      * Insert\Update Book Object form Book Table in Database
      * @param \BookList\Model\Book $book Book Object
      * @throws \Exception If there is not Book row in Database with given id
      */
     public function saveBook(Book $book)
     {
         $bookData = array(
             'title'  => $book->title,
             'author' => $book->author,
         );

         $bookId = (int) $book->id;

         if ($bookId == 0) {

             $this->_tableGateway->insert($bookData);
         } else {

             if ($this->getBook($bookId)) {

                 $this->_tableGateway->update($bookData, array('id' => $bookId));
             } else {

                 throw new \Exception('Book Id Does not Exists');
             }
         }
     }

     /**
      * Delete Book Object from Book Table in Database
      * @param int|string $id Book`s Id
      */
     public function deleteBook($id)
     {
         $bookId = (int) $id;

         $this->_tableGateway->delete(array('id' => $bookId));
     }

 }