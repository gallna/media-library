<?php
namespace Kemer\MediaLibrary;

use SimpleXMLIterator;

class Container extends Object implements ContainerInterface, \RecursiveIterator, \Countable
{
    protected $objects = [];

    public function __construct($id, $title, $upnpClass = ContainerInterface::UPNP_CLASS)
    {
        parent::__construct($id, $title, $upnpClass);
    }

    public function add(ObjectInterface $object)
    {
        $object->setParentId($this->getId());
        $this->objects[] = $object;
        return $this;
    }

    public function all()
    {
        return $this->objects;
    }

    public function asXML(SimpleXMLIterator $root = null)
    {
        $this->attributes["childCount"] = $this->count();
        return parent::asXml($root);
    }

    public function asXMLz(SimpleXmlElement $root = null)
    {
        if (!$root instanceof SimpleXmlElement) {
            $root = new SimpleXmlElement('<DIDL-Lite xmlns="urn:schemas-upnp-org:metadata-1-0/DIDL-Lite/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dlna="urn:schemas-dlna-org:metadata-1-0/" xmlns:upnp="urn:schemas-upnp-org:metadata-1-0/upnp/"></DIDL-Lite>');
            foreach ($this->elements as $element) {
                $element->asXML($root);
            }
            return $root->asXML();
        } else {
            $container = $root->addChild('container');
            $container->addAttribute('restricted', '1');
            $container->addAttribute('id', $this->getId());
            $container->addAttribute('parentID', $this->getParentId());
            $container->addChild('title', $this->getTitle(), 'http://purl.org/dc/elements/1.1/');
            $container->addChild('class', $this->getClass(), 'urn:schemas-upnp-org:metadata-1-0/upnp/');
            return $container;
        }
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
