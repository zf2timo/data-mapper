<?php


namespace ModuleTest\Mapper;


use Module\Entity\Article;
use PHPUnit_Framework_MockObject_MockObject;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\ClassMethods;

class ArticleTest extends AbstractMapperTest
{

    /**
     * @var \Module\Mapper\Article
     */
    protected $mapper;

    public function testAnotherMock()
    {
        $result = new \ArrayIterator([1 =>
            [
                'id' => 1,
                'headline' => 'Foo',
                'category_id' => 1,
            ],
            2 => [
                'id' => 2,
                'headline' => 'Bar',
                'category_id' => 2
            ]
        ]);

        // mock statement returning our roles
        $mockStatement = $this->getStatementStub($result);
        $this->mockDriver->expects($this->any())->method('createStatement')->will($this->returnValue($mockStatement));

        $resultSet = $this->mapper->findAll();
        $fooArticle = $resultSet->current();

        $this->assertEquals(1, $fooArticle->getId());
        $this->assertEquals('Foo', $fooArticle->getHeadline());
        $this->assertEquals(1, $fooArticle->getCategoryId());

        $resultSet->next();
        $barArticle = $resultSet->current();

        $this->assertEquals(2, $barArticle->getId());
        $this->assertEquals('Bar', $barArticle->getHeadline());
        $this->assertEquals(2, $barArticle->getCategoryId());
    }

    public function testFindByCategory()
    {
        $result = new \ArrayIterator(
            [
                1 => [
                    'id' => 1,
                    'headline' => 'Foo',
                    'category_id' => 1,
                ],
                2 => [
                    'id' => 2,
                    'headline' => 'Bar',
                    'category_id' => 1
                ]
            ]
        );

        $mockStatement = $this->getStatementStub($result);
        $this->mockDriver->expects($this->any())->method('createStatement')->will($this->returnValue($mockStatement));

        $resultSet = $this->mapper->findByCategory(1);

        $this->assertEquals(2, $resultSet->count());

        $fooArticle = $resultSet->current();

        $this->assertEquals(1, $fooArticle->getId());
        $this->assertEquals('Foo', $fooArticle->getHeadline());
        $this->assertEquals(1, $fooArticle->getCategoryId());

        $resultSet->next();
        $barArticle = $resultSet->current();

        $this->assertEquals(2, $barArticle->getId());
        $this->assertEquals('Bar', $barArticle->getHeadline());
        $this->assertEquals(1, $barArticle->getCategoryId());

    }

    protected function getEntityPrototype()
    {
        return new Article();
    }

    protected function getMapper()
    {
        return new \Module\Mapper\Article();
    }
}