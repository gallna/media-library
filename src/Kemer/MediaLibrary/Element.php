<?php
namespace Kemer\MediaLibrary;

use SimpleXMLIterator;
use Kemer\MediaLibrary\Item\Res;

class Element implements \ArrayAccess
{
    protected $attributes = [];
    protected $elements = [];

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
        $container = $root->addChild($this->getName(), htmlentities($this->getValue()), $class);

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

    public function getName()
    {
        if ($this instanceof Container) {
            return "container";
        }
        if ($this instanceof Item) {
            return "item";
        }
        return strtolower((new \ReflectionObject($this))->getShortName());
    }

    public function toArray()
    {
        $parameters["className"] = get_class($this);
        $parameters["type"] = $this->getName();
        $this->parseArray($this->attributes, $parameters);
        $this->parseArray($this->elements, $parameters);
        return $parameters;
    }

    protected function parseArray($elements, &$parameters = [])
    {
        foreach ($elements as $name => $element) {
            if ($element instanceof Element) {
                $parameters[$name] = $element->toArray();
            } elseif (is_array($element)) {
                $parameters[$name] = $this->parseArray($element);
            } else {
                $parameters[$name] = $element;
            }
        }
        return $parameters;
    }

    /**
     * Create Object from an array
     *
     * @param array $data
     * @return object
     */
    public static function fromArray(array $data, $self = null)
    {
        if (!$self && !isset($data["id"])) {
            throw new \Exception("Required parameter 'id' is not set");
        }
        $self = $self ?: new static($data["id"], $data["title"], $data["class"]);
        foreach ($data as $name => $parameter) {
            if (method_exists($self, $setter = "set".ucfirst($name))) {
                $self->{$setter}($parameter);
            } else {
                $self->elements[$name] = $parameter;
            }
        }
        return $self;
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
        $this->elements[$name] = $element;
        return $this;
    }
}
