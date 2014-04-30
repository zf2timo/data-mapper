<?php


namespace ModuleTest\Mapper;


use Module\Mapper\Category;
use PHPUnit_Framework_MockObject_MockObject;
use Zend\Stdlib\Hydrator\ClassMethods;

abstract class AbstractMapperTest extends \PHPUnit_Framework_TestCase
{

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

        $mapper = $this->getMapper();
        $mapper->setDbAdapter($this->getAdapterStub($this->mockDriver));
        $mapper->setHydrator(new ClassMethods());
        $mapper->setEntityPrototype($this->getEntityPrototype());

        $this->mapper = $mapper;
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

    abstract protected function getEntityPrototype();

    abstract  protected function getMapper();
}
 