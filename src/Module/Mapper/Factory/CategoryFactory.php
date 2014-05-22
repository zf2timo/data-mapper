<?php


namespace Module\Mapper\Factory;


use Module\Entity\Category as CategoryEntity;
use Module\Mapper\Category;
use ZfcBase\Mapper\AbstractDbMapper;

class CategoryFactory extends AbstractMapperFactory
{

    /**
     * @return AbstractDbMapper
     */
    public function getDbMapper()
    {
        return new Category();
    }

    /**
     * @return mixed
     */
    public function getPrototypeEntity()
    {
        return new CategoryEntity();
    }
}
