<?php


namespace Module\Mapper;


use Zend\Db\Sql\Select;
use ZfcBase\Mapper\AbstractDbMapper;

class Article extends AbstractDbMapper
{
    /**
     * @var string
     */
    protected $tableName = 'article';

    public function findAll()
    {
        $select = $this->getSelect();

        return $this->executeSelect($select);
    }

    public function findByCategory($categoryId)
    {
        $select = $this->getSelect();
        $select->where->equalTo('category_id', (int)$categoryId);

        return $this->executeSelect($select);
    }

    /**
     * @param Select $select
     * @return \Zend\Db\ResultSet\HydratingResultSet
     */
    protected function executeSelect(Select $select)
    {
        $resultSet = $this->select($select);
        $this->getEventManager()->trigger('find', array('resultSet' => $resultSet));

        return $resultSet;
    }
}
