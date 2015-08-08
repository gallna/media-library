<?php
namespace Kemer\MediaLibrary;

use SimpleXmlElement;

abstract class Object extends Element implements ObjectInterface
{
    // protected $upnpClass;
    // protected $id;
    // protected $parentId = 0;
    // protected $title;
    // protected $restricted = false;

    /**
     * Object constructor
     *
     * @param string $id
     * @param string $title
     * @param string $upnpClass
     */
    public function __construct($id, $title, $upnpClass)
    {
        $this->setId($id);
        $title and $this->setTitle($title);
        $this->setClass($upnpClass);
        parent::__construct(($this instanceof Container ? "container" : "item"));
        //parent::__construct((new \ReflectionObject($this))->getShortName());
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {
        $this->attributes["id"] = $id;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->attributes["id"];
    }

    /**
     * {@inheritDoc}
     */
    public function setParentId($parentId)
    {
        $this->attributes["parentID"] = $parentId;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getParentId()
    {
        return isset($this->attributes["parentID"]) ? $this->attributes["parentID"] : null;
    }

    /**
     * {@inheritDoc}
     */
    public function setClass($class)
    {
        $this->class = new UpnpElement("class", $class);
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
        $this->title = new DcElement("title", $title);
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
        $this->attributes["restricted"] = $restricted;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRestricted()
    {
        return $this->attributes["restricted"];
    }
}
