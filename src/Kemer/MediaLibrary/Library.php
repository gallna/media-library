<?php
namespace Kemer\MediaLibrary;

class Library implements LibraryInterface
{
    /**
     * Library items
     *
     * @var array
     */
    protected $items = [];

    /**
     * Library containers
     *
     * @var array
     */
    protected $containers = [];

    /**
     * Library objects
     *
     * @var array
     */
    protected $objects = [];

    /**
     * A combined method to set Containers and Items
     *
     * @param Traversable $objects
     * @return $this
     */
    public function set($objects)
    {
        if (is_array($objects) || $objects instanceof \Traversable) {
            array_map([$this, "add"], iterator_to_array($objects));
        } else {
            throw new Exception\InvalidArgumentException(
                sprintf(
                    "Only array or instance of Traversable can be accepted, '%s' provided",
                    get_type($objects)
                )
            );
        }
        return $this;
    }

    /**
     * A combined method to add either Container or Item
     *
     * @param ObjectInterface $object
     * @return $this
     */
    public function add(ObjectInterface $object)
    {
        $this->objects[$object->getId()] = $object;
        if ($object instanceof ContainerInterface) {
            return $this->addContainer($object);
        }
        return $this->addItem($object);
    }

    /**
     * {@inheritDoc}
     */
    public function addContainer(ContainerInterface $container)
    {
        if (!isset($this->containers[$hash = spl_object_hash($container)])) {
            $this->containers[$hash] = $container;
            $recursiveIteratorIterator = new \RecursiveIteratorIterator(
                $container,
                \RecursiveIteratorIterator::CHILD_FIRST
            );
            foreach($recursiveIteratorIterator as $item) {
                $this->add($item);
            }
        }
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getContainers()
    {
        return $this->containers;
    }

    /**
     * {@inheritDoc}
     */
    public function addItem(ItemInterface $item)
    {
        $this->items[spl_object_hash($item)] = $item;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getItems()
    {
        return array_values($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function get($id)
    {
        return $this->objects[$id];
    }

    /**
     * {@inheritDoc}
     */
    public function filter($callbackOrKey, $value = null)
    {
        if (is_callable($callbackOrKey)) {
            return array_filter($this->objects, $callbackOrKey);
        }
        return array_values(
            array_filter($this->objects, function ($item) use ($callbackOrKey, $value) {
                return $item->{$callbackOrKey} == $value;
            })
        );
    }

    /**
     * {@inheritDoc}
     */
    public function search($id, $callbackOrKey, $value = null)
    {
        $object = $this->get($id);
        if ($object instanceof ContainerInterface) {
            return (new static())->set($object)->filter($callbackOrKey, $value);
        }
        return $object;
    }
}
