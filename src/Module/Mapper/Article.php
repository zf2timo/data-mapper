<?php


namespace Module\Mapper;


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

        $resultSet = $this->select($select);
        $this->getEventManager()->trigger('find', array('resultSet' => $resultSet));

        return $resultSet;
    }
} 