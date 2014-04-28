<?php


namespace ModuleTest\Entity;


use Mockery\Mock;
use Module\Entity\Article;
use Module\Entity\Category;
use Module\Entity\Collection\ArticleCollection;
use Module\Entity\Factory\CategoryDataFactory;
use Zend\Db\ResultSet\ResultSet;

class CategoryDataFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CategoryDataFactory
     */
    protected $factory;

    public function testFindById()
    {
        $category = new Category();
        $category->setId(1);
        $category->setName('Foo');

        $resultSet = new ResultSet();
        $resultSet->initialize(new \ArrayIterator([1 => $category]));

        $categoryMapper = \Mockery::mock('Module\Mapper\Category');
        $categoryMapper->shouldReceive('findById')->with(1)->once()->andReturn($resultSet);

        $articleMapper = \Mockery::mock('Module\Mapper\Article');

        $factory = new CategoryDataFactory($categoryMapper, $articleMapper);

        $this->assertEquals($factory->createCategory(1), $category);
    }

    public function testFindAll()
    {
        $category = new Category();
        $category->setId(1);
        $category->setName('Foo');

        $categoryResult = new ResultSet();
        $categoryResult->initialize(new \ArrayIterator([1 => $category]));

        $categoryMapper = \Mockery::mock('Module\Mapper\Category');
        $categoryMapper->shouldReceive('findById')->with(1)->once()->andReturn($categoryResult);

        $fooArticle = new Article();
        $fooArticle->setId(1);
        $fooArticle->setCategoryId(1);
        $fooArticle->setHeadline('Foo');
        $fooArticle->setCategory($category);

        $barArticle = new Article();
        $barArticle->setId(2);
        $barArticle->setCategoryId(1);
        $barArticle->setHeadline('Bar');
        $barArticle->setCategory($category);

        $articleResult = new ResultSet();
        $articleResult->initialize(new \ArrayIterator([1 => $fooArticle, 2 => $barArticle]));

        $articleMapper = \Mockery::mock('Module\Mapper\Article');
        $articleMapper->shouldReceive('findByCategory')->with(1)->once()->andReturn($articleResult);

        $factory = new CategoryDataFactory($categoryMapper, $articleMapper);

        $articleCollection = new ArticleCollection();
        $articleCollection->offsetSet(1, $fooArticle);
        $articleCollection->offsetSet(2, $barArticle);

        $category->setArticleCollection($articleCollection);

        $this->assertEquals($factory->createCategoryWithRelation(1), $category);
    }

    public function tearDown()
    {
        \Mockery::close();
    }
} 