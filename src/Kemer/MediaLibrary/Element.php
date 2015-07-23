<?php
namespace Kemer\MediaLibrary;

use SimpleXMLIterator;

class Element implements \ArrayAccess
{
    private $__private = [];
    private $value;
    protected $attributes = [];
    protected $elements = [];

    public function __construct($name, $value = null)
    {
        $this->setName($name);
        $this->setValue($value);
    }

    /**
     * Set element name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->__private["name"] = $name;
        return $this;
    }

    /**
     * Get element name
     *
     * @return string
     */
    public function getName()
    {
        return $this->__private["name"];
    }

    /**
     * Set element value
     *
     * @param string $value
     */
    public function setValue($value)
    {
        $this->__private["value"] = $value;
        return $this;
    }

    public function __toString()
    {
        return $this->getValue();
    }

    /**
     * Get element value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->__private["value"];
    }

    public function asXML(SimpleXMLIterator $root = null)
    {
        if (!$root instanceof SimpleXMLIterator) {
            $root = new SimpleXMLIterator('<DIDL-Lite xmlns="urn:schemas-upnp-org:metadata-1-0/DIDL-Lite/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dlna="urn:schemas-dlna-org:metadata-1-0/" xmlns:upnp="urn:schemas-upnp-org:metadata-1-0/upnp/"></DIDL-Lite>');
            $this->toXml($root);
            return $root;
        } else {
            return $this->toXml($root);
        }
    }

    public function toXML(SimpleXMLIterator $root)
    {
        switch (true) {
            case $this instanceof UpnpElement:
                $class = 'urn:schemas-upnp-org:metadata-1-0/upnp/';
                break;
            case $this instanceof DcElement:
                $class = 'http://purl.org/dc/elements/1.1/';
                break;
            default:
                $class = null;
        }
        $container = $root->addChild($this->getName(), $this->getValue(), $class);

        foreach ($this->attributes as $name => $attribute) {
            $container->addAttribute($name, $attribute);
        }
        foreach ($this->elements as $elements) {
            if (is_array($elements)) {
                foreach($elements as $element) {
                    $element->toXML($container);
                }
            } else {
                $elements->toXML($container);
            }

        }
        return $container;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $attribute)
    {
        if (is_null($offset)) {
            $this->attributes[] = $attribute;
        } else {
            $this->attributes[$offset] = $attribute;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->attributes[$offset]);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet($offset)
    {
        return isset($this->attributes[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * {@inheritDoc}
     */
    public function __get($name)
    {
        return array_key_exists($name, $this->elements) ? $this->elements[$name] : null;
    }

    /**
     * {@inheritDoc}
     */
    public function __set($name, $element)
    {
        if (!($element instanceof Element)) {
            throw new \OutOfBoundsException(
                sprintf(
                    "Only instance of '%s' class accepted '%s' added as %s",
                    'Element',
                    gettype($element),
                    $name
                )
            );
        }
        $this->elements[$name] = $element;
        return $this;
    }
}
