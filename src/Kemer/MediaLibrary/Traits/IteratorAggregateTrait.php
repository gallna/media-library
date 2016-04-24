<?php
namespace Kemer\MediaLibrary\Traits;

use Kemer\MediaLibrary\ObjectInterface;

trait IteratorAggregateTrait
{
    protected $objects = [];

    /**
     * {@inheritDoc}
     */
    public function add(ObjectInterface $object)
    {
        $object->setParentId($this->getId());
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
