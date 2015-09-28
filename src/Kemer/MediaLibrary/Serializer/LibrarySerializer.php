<?php
namespace Kemer\MediaLibrary\Serializer;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;



class LibrarySerializer
{
    private $serializer;

    public function __construct()
    {

    }

    /**
     * Serializing an Object
     *
     * @param ObjectInterface $object
     * @return string
     */
    public function serialize($object, $type = "json")
    {
        return $this->serializer->serialize($object, $type);
    }


    /**
     * Create Object from an array
     *
     * @param array $data
     * @return object
     */
    public function fromArray(array $data)
    {
        if (isset($data["className"])) {
            return $this->getObject($data);
        }
        $objects = [];
        foreach ($data as $object) {
            $objects[] = $this->getObjects($object);
        }
        return $objects;
    }

    public function getObjects(array $data)
    {
        if (isset($data["className"])) {
            return $this->getObject($data);
        }
        foreach ($data as $name => $parameter) {
            if (isset($parameter["className"])) {
                $data[$name] = $this->getObject($parameter);
            }
        }
        return $data;
        $class = $data["className"];
        return $class::fromArray($data);
    }

    public function getObject(array $data)
    {
        foreach ($data as $name => $parameter) {
            if (is_array($parameter)) {
                $data[$name] = $this->getObjects($parameter);
            }
        }
        $class = $data["className"];
        return $class::fromArray($data);
    }

    private function getChannels()
    {
        $key = md5(get_class($this));
        //$this->memcache->delete($key);
        if (!$channels = $this->memcache->get($key)) {
            $this->weebTv->logIn("tom.jonik@hotmail.com", "gall32");
            $channels = $this->weebTv->getChannels();
            var_dump($channels);
            $this->memcache->set($key, $channels);
        }

        return $channels;
    }

    protected function createRes($name, $id)
    {
        $protocolInfo = (new ProtocolInfo())
            ->setProtocol(ProtocolInfo::PROTOCOL_HTTP_GET)
            ->setNetwork("*")
            ->setContentFormat("application/x-fcs")
            ->setAdditionalInfo($id);

        // 'http://10.0.10.107:81/app.server/stream.php'
        $res = (new Res($id))
            ->setProtocolInfo($protocolInfo);
        return $res;
    }

    protected function createItem($name, $id)
    {
        return new VideoBroadcast(md5($id), htmlentities(utf8_encode($name)));
    }
}
