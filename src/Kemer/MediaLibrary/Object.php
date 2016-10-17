<?php
namespace Kemer\MediaLibrary;

abstract class Object implements ObjectInterface, \ArrayAccess, \JsonSerializable
{
    use Traits\AttributesTrait;
    use Traits\DataTrait;

    /**
     * @class upnp
     */
    public $class;

    /**
     * @class dc
     */
    public $title;

    public $res = [];

    /**
     * Object constructor
     *
     * @param array $parameters
     */
    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function setRes(array $res)
    {
        $this->res = $res;
        return $this;
    }

    public function addRes(Res $res)
    {
        $this->res[] = $res;
        return $this;
    }

    public function getRes($res = null)
    {
        return $this->res;
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {
        $this->offsetSet("id", $id);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->offsetGet("id");
    }

    /**
     * {@inheritDoc}
     */
    public function setParentId($parentId)
    {
        $this->offsetSet("parentId", $parentId);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getParentId()
    {
        return $this->offsetGet("parentId") ?: 0;
    }

    /**
     * {@inheritDoc}
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * {@inheritDoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritDoc}
     */
    public function setRestricted($restricted)
    {
        $this->offsetSet("restricted", $restricted);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRestricted()
    {
        $this->offsetGet("restricted");
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return (new Serializer\Serializer())->normalize($this);
    }
}
