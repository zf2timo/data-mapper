<?php


namespace ModuleTest\Mapper;


use Module\Entity\Article;
use PHPUnit_Framework_MockObject_MockObject;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\ClassMethods;

class ArticleTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Module\Mapper\Article
     */
    protected $mapper;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    protected $mockDriver;

    /**
     * @return \Module\Mapper\Article
     */
    protected function setUp()
    {
        $this->mockDriver = $this->getDriverStub();

        $mapper = new \Module\Mapper\Article();
        $mapper->setDbAdapter($this->getAdapterStub($this->mockDriver));
        $mapper->setHydrator(new ClassMethods());
        $mapper->setEntityPrototype(new Article());

        $this->mapper = $mapper;
    }

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

    /**
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function getDriverStub()
    {
        $mockConnection = $this->getMock('Zend\Db\Adapter\Driver\ConnectionInterface');
        $mockDriver = $this->getMock('Zend\Db\Adapter\Driver\DriverInterface');
        $mockDriver->expects($this->any())->method('getConnection')->will($this->returnValue($mockConnection));
        return $mockDriver;
    }

    /**
     * @param $mockDriver
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function getAdapterStub($mockDriver)
    {
        $mockAdapter = $this->getMock('Zend\Db\Adapter\Adapter', null, array($mockDriver));
        return $mockAdapter;
    }

    /**
     * @param $result
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function getStatementStub($result)
    {
        $mockStatement = $this->getMock('Zend\Db\Adapter\Driver\StatementInterface');
        $mockStatement->expects($this->any())->method('execute')->will($this->returnValue($result));
        return $mockStatement;
    }
}