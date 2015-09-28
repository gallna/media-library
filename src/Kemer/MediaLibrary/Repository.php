<?php
namespace Kemer\ContentDirectory;

use Kemer\UPnP\ContentDirectory;

class Repository implements RepositoryInterface
{
    protected $objects = [];


    public function __construct(ContainerInterface $objects)
    {
        $this->objects = $objects;
    }
    /**
     * [findById description]
     *
     * @param string $id
     * @param ContentDirectory\FilterInterface $filter
     * @param ContentDirectory\SortCriteriaInterface $sortCriteria
     * @return array
     */
    public function findById($id, FilterInterface $filter = null, SortCriteriaInterface $sortCriteria = null)
    {
        if ($id == 0) {
            return $this;
        }
        foreach(new RecursiveIteratorIterator($this->objects, RecursiveIteratorIterator::CHILD_FIRST) as $object) {
            if($object->getId() == $id) {
                return $object;
            }
        }
    }

    public function filter(\Closure $callback)
    {
        return array_filter($this->elements, $callback);
    }
}
