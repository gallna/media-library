<?php
namespace Kemer\MediaLibrary\Serializer;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;



class SymfonyLibrarySerializer
{
    private $serializer;

    public function __construct()
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);
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
     * Deserializing an Object
     *
     * @param string data The information to be decoded
     * @param string class The name of the class this information will be decoded to
     * @param string type The encoder used to convert that information into an array
     * @return string
     */
    public function deserialize($data, $class, $type = "json")
    {
        $person = $this->serializer->deserialize($data, $class, $type);
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
