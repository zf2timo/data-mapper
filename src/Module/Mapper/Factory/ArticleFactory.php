<?php


namespace Module\Mapper\Factory;


use Module\Entity\Article as ArticleEntity;
use Module\Mapper\Article;
use ZfcBase\Mapper\AbstractDbMapper;

class ArticleFactory extends AbstractMapperFactory
{

    /**
     * @return AbstractDbMapper
     */
    public function getDbMapper()
    {
        return new Article();
    }

    /**
     * @return mixed
     */
    public function getPrototypeEntity()
    {
        return new ArticleEntity();
    }
}
