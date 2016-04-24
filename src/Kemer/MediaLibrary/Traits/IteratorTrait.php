<?php
namespace Kemer\MediaLibrary\Traits;

use Kemer\MediaLibrary\ObjectInterface;

trait IteratorTrait
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
    public function rewind()
    {
        reset($this->objects);
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        return current($this->objects);
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return key($this->objects);
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        next($this->objects);
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
        return $this->key() !== null;
    }

    /**
     * {@inheritDoc}
     */
    public function hasChildren()
    {
        return $this->current() instanceof ContainerInterface;
    }

    /**
     * {@inheritDoc}
     */
    public function getChildren()
    {
        return $this->current();
    }

    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return count($this->objects);
    }
}
