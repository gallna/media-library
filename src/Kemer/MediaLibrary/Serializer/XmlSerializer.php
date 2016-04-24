<?php
namespace Kemer\UPnP\Serializer;

use SimpleXMLIterator;
use Kemer\MediaLibrary\Item\Res;

class XmlSerializer
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

    public function serialize($object)
    {
        $root = new SimpleXMLIterator('<DIDL-Lite xmlns="urn:schemas-upnp-org:metadata-1-0/DIDL-Lite/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dlna="urn:schemas-dlna-org:metadata-1-0/" xmlns:upnp="urn:schemas-upnp-org:metadata-1-0/upnp/"></DIDL-Lite>');
        $this->process($object, $root);

    }


    public function process($object, SimpleXMLIterator $xml)
    {
        $attributes = $this->addAttributes($object, $xml);
        switch ($root->class) {
            case "upnp":
                $class = 'urn:schemas-upnp-org:metadata-1-0/upnp/';
                break;
            case "dc":
                $class = 'http://purl.org/dc/elements/1.1/';
                break;
            default:
                $class = null;
        }

        if ($object instanceof \Iterator) {
            $this->addChilds($object, $xml);
        }

    }

    private function processObject($object, SimpleXMLIterator $xml)
    {
        $attributes = $object;
        foreach ($attributes as $name => $attribute) {
            $xml->addAttribute($name, $attribute);
        }
        $attributes = ["class" => null];
        $reflection = new \ReflectionObject($object);
        $attributes = $this->extractDocComments($reflection->getDocComment());

        foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if ($comment = $property->getDocComment()) {
                preg_match_all("/@(?'annotation'[^\s]+)\s+(?'value'[^\s]+)+/m", $comment, $results);
                if (!empty($result)) {
                    foreach ($results as $result) {
                        $attributes[$result["annotation"]] = $result["value"];
                    }
                    var_dump($comment, $result);
                }
            }
        }
        foreach ($attributes as $name => $attribute) {
            $xml->addAttribute($name, $attribute);
        }
        return $attributes;
    }

    private function processProperty(ReflectionProperty $property, SimpleXMLIterator $xml)
    {
        $attributes = $this->addAttributes($object, $xml);
        $comment = $property->getDocComment();

        $container->addAttribute($property->getName(), $property->getValue());

        switch ($root->class) {
            case "upnp":
                $class = 'urn:schemas-upnp-org:metadata-1-0/upnp/';
                break;
            case "dc":
                $class = 'http://purl.org/dc/elements/1.1/';
                break;
            default:
                $class = null;
        }

        if ($object instanceof \Iterator) {
            $this->addChilds($object, $xml);
        }
    }

    private function addAttributes($object, SimpleXMLIterator $xml)
    {
        $attributes = ["class" => null];
        $reflection = new \ReflectionObject($object);
        foreach ($reflection->getProperties() as $property) {
            if ($comment = $property->getDocComment()) {
                preg_match_all("/@(?'annotation'[^\s]+)\s+(?'value'[^\s]+)+/m", $comment, $results);
                if (!empty($result)) {
                    foreach ($results as $result) {
                        $attributes[$result["annotation"]] = $result["value"];
                    }
                    var_dump($comment, $result);
                }
            }
        }
        foreach ($attributes as $name => $attribute) {
            $xml->addAttribute($name, $attribute);
        }
        return $attributes;
    }

    public function addNamespace($object, SimpleXMLIterator $xml)
    {
        $attributes = $this->addAttributes($object, $xml);
        switch ($root->class) {
            case "upnp":
                $class = 'urn:schemas-upnp-org:metadata-1-0/upnp/';
                break;
            case "dc":
                $class = 'http://purl.org/dc/elements/1.1/';
                break;
            default:
                $class = null;
        }

        if ($object instanceof \Iterator) {
            $this->addChilds($object, $xml);
        }
    }

    public function addChilds(\Iterator $object, $xml)
    {
        $parent = $xml->addChild($this->getName(), htmlentities("value"));
        foreach ($object as $element) {
            $this->process($element, $parent);
        }
    }

    private function extractDocComments($comment, array $attributes = [])
    {
        preg_match_all("/@(?'annotation'[^\s]+)\s+(?'value'[^\s]+)+/m", $comment, $results);
        if (!empty($result)) {
            foreach ($results as $result) {
                $attributes[$result["annotation"]] = $result["value"];
            }
        }
        return $attributes;
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

    private function attributes($object, SimpleXMLIterator $xml)
    {
        $attributes = ["class" => null];
        $reflection = new \ReflectionObject($object);
        foreach ($reflection->getProperties() as $property) {
            if ($comment = $property->getDocComment()) {
                preg_match_all("/@(?'annotation'[^\s]+)\s+(?'value'[^\s]+)+/m", $comment, $results);
                if (!empty($result)) {
                    foreach ($results as $result) {
                        $attributes[$result["annotation"]] = $result["value"];
                    }
                    var_dump($comment, $result);
                }
            }
        }
        foreach ($attributes as $name => $attribute) {
            $xml->addAttribute($name, $attribute);
        }
        return $attributes;
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
