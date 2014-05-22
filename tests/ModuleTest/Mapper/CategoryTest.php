<?php


namespace ModuleTest\Mapper;


use Module\Entity\Category;

class CategoryTest extends AbstractMapperTest
{

    /**
     * @var \Module\Mapper\Category
     */
    protected $mapper;

    public function testFindAll()
    {
        $result = new \ArrayIterator([
            1 =>
                [
                    'id' => 1,
                    'name' => 'Foo',
                ],
            2 => [
                'id' => 2,
                'name' => 'Bar',
            ]
        ]);

        $mockStatement = $this->getStatementStub($result);
        $this->mockDriver->expects($this->once())->method('createStatement')->will($this->returnValue($mockStatement));

        $resultSet = $this->mapper->findAll();

        $this->assertSame(2, $resultSet->count());

        $fooCategory = $resultSet->current();

        $this->assertSame(1, $fooCategory->getId());
        $this->assertSame('Foo', $fooCategory->getName());

        $resultSet->next();
        $barCategory = $resultSet->current();

        $this->assertSame(2, $barCategory->getId());
        $this->assertSame('Bar', $barCategory->getName());
    }

    public function testFindById()
    {
        $result = new \ArrayIterator([
            1 =>
                [
                    'id' => 1,
                    'name' => 'Foo',
                    'category_id' => 1,
                ],
        ]);

        $mockStatement = $this->getStatementStub($result);
        $this->mockDriver->expects($this->once())->method('createStatement')->will($this->returnValue($mockStatement));

        $resultSet = $this->mapper->findById(1);

        $this->assertSame(1, $resultSet->count());

        $fooCategory = $resultSet->current();

        $this->assertSame(1, $fooCategory->getId());
        $this->assertSame('Foo', $fooCategory->getName());
    }

    protected function getEntityPrototype()
    {
        return new Category();
    }

    protected function getMapper()
    {
        return new \Module\Mapper\Category();
    }
}
