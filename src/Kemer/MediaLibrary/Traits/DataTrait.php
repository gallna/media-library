<?php
namespace Kemer\MediaLibrary\Traits;

trait DataTrait
{
    protected $data = [];

    public function __get($key)
    {
        if (!$this->__isset($key)) {
            throw new \OutOfBoundsException("The key \"{$key}\" does not exist.");
        }

        return $this->data[$key];
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __isset($key)
    {
        return array_key_exists($key, $this->data);
    }

    public function __unset($key)
    {
        unset($this->data[$key]);
    }

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return mixed|Subject
     */
    public function __call($method, array $arguments = array())
    {
        $property = lcfirst(substr($method, 3));
        if (0 === strpos($method, 'set')) {
            $this->{$property} = $arguments[0];
        } elseif (0 === strpos($method, 'get')) {
            return $this->{$property};
        } else {
            throw new \RuntimeException(
                sprintf("Call to undefined method %s::%s()", __CLASS__, $method)
            );
        }
    }
}
