<?php


namespace Module\Mapper;


use Zend\Db\Sql\Select;
use ZfcBase\Mapper\AbstractDbMapper;

class Category extends AbstractDbMapper
{
    /**
     * @var string
     */
    protected $tableName = 'category';

    /**
     * @return \Zend\Db\ResultSet\HydratingResultSet
     */
    public function findAll()
    {
        $select = $this->getSelect();

        return $this->executeSelect($select);
    }

    /**
     * @param int $id
     * @return \Zend\Db\ResultSet\HydratingResultSet
     */
    public function findById($id)
    {
        $select = $this->getSelect();
        $select->where->equalTo('id', (int)$id);

        return $this->executeSelect($select);
    }

    /**
     * @param Select $select
     * @return \Zend\Db\ResultSet\HydratingResultSet
     */
    public function executeSelect(Select $select)
    {
        $resultSet = $this->select($select);
        $this->getEventManager()->trigger('find', array('resultSet' => $resultSet));

        return $resultSet;
    }
} 