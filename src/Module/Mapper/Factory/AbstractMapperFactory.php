<?php


namespace Module\Mapper\Factory;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;
use ZfcBase\Mapper\AbstractDbMapper;

abstract class AbstractMapperFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $this->getDbMapper();
        $mapper->setDbAdapter($serviceLocator->get('Zend\Db\Adapter\Adapter'));
        $mapper->setHydrator(new ClassMethods());
        $mapper->setEntityPrototype($this->getPrototypeEntity());

        return $mapper;
    }

    /**
     * @return AbstractDbMapper
     */
    abstract public function getDbMapper();

    /**
     * @return mixed
     */
    abstract public function getPrototypeEntity();
}