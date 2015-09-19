<?php

namespace Album\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet;

/**
 * Album Table
 * @package Album\Model
 * @author Ahmed Hamdy <ahmedhamdy20@gmail.com>
 */
class AlbumTable
{
    protected $_tableGateway;
    
    /**
     * Album Table Constructor
     * @param TableGateway $tableGateway TableGateway Object
     */
    public function __construct(TableGateway $tableGateway)
    {
        $this->_tableGateway = $tableGateway;
    }   
    
    /**
     * Fetch All Album Rows into Album Table into Database
     * @return ResultSet
     */
    public function fetchAll()
    { 
       $resultSet = $this->_tableGateway->select();
       return $resultSet;
    } 
    
}