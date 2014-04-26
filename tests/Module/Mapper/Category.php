
namespace ModuleTest\Mapper;

class CategoryTest extends \PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->_mockAdapter = \Mockery::mock(
            'Zend\Db\Adapter\Adapter'
        );
        $this->_mockGenericTable = new \Generic\Model\GenericTable(
            $this->_mockAdapter
        );
    }

    public function tearDown()
    {
        \Mockery::close();
    }
}
