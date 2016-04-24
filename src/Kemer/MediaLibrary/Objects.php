<?php
namespace Kemer\MediaLibrary;

class Objects implements \IteratorAggregate
{
    private $container;
    private $objects = [];

    /**
     * Object constructor
     *
     * @param array $parameters
     */
    public function __construct(ObjectInterface $container = null)
    {
        if ($container) {
            $this->add($container);
        }
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function add(ObjectInterface $object)
    {
        if (!$object->getParentId() && $this->container) {
            $object->setParentId($this->container->getId());
        }
        $this->objects[] = $object;
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->objects);
    }
}
