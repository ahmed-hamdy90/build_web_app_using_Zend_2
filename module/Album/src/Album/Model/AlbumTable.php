<?php
namespace Album\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

/**
 * Album Table
 * @package Album\Model
 * @author Ahmed Hamdy <ahmedhamdy20@gmail.com>
 */
class AlbumTable
{
    protected $tableGateway;
    
    /**
     * Album Table Constructor
     * @param TableGateway $tableGateway TableGateway Object
     */
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }   
    
    /**
     * Fetch All Album Rows into Album Table into Database
     * @return ResultSet
     */
    public function fetchAll()
    { 
       $resultSet = $this->tableGateway->select();
       return $resultSet;
    }
    
    /**
     * Get Album Object 
     * <br/> Using  It`s Id into album Table in Database
     * @param int|string $id Album`s Id
     * @return array|\ArrayObject Album Object
     * @throws \Exception If there is`t Album row in Database with given Id  
     */
    public function getAlbum($id)
    {
        $id = (int) $id;
        $rowSet = $this->tableGateway->select(array('id' => $id));
        $row    = $rowSet->current();
        
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        
        return $row;
    }        
    
    /**
     * Insert a new Album row into Album Table in Database
     * OR Update an Exists Album row into Album Table
     * @param Album $album Album Object
     * @throws \Exception If There is not Album row in Album table with given Id
     *                   <br/> When Update an Exists Album row.
     */
    public function saveAlbum(Album $album)
    {
        $data = array(
            'title'  => $album->title,
            'artist' => $album->artist
        );
        
        $id = (int) $album->id;
        
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {            
            if ($this->getAlbum($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception("Album id does not exist");
            }
        }
    }
    
    /**
     * Delete an Album row into Album Table in Database
     * @param int|string $id Album`s Id
     */
    public function deleteAlbum($id)
    {
        $id = (int) $id;
        $this->tableGateway->delete(array('id' => $id));
    }        
}