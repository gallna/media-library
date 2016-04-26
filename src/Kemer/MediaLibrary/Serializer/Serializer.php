<?php
namespace Kemer\MediaLibrary\Serializer;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;

use Kemer\MediaLibrary\Res;
use Kemer\MediaLibrary\ProtocolInfo;

class Serializer
{
    private $serializer;

    private $classMap = [
        "object.item" => "Item",
        "object.item.videoItem" => "Item\VideoItem",
        "object.item.videoItem.movie" => "Item\VideoItem\Movie",
        "object.item.videoItem.videoBroadcast" => "Item\VideoItem\VideoBroadcast",
        "object.item.epgItem" => "Item\EpgItem",
        "object.item.epgItem.videoProgram" => "Item\EpgItem\VideoProgram",
        "object.container.person" => "Container\Person",
        "object.container.genre" => "Container\Genre",
        "object.container.genre.movieGenre" => "Container\Genre\MovieGenre",
        "object.container.channelGroup" => "Container\ChannelGroup",
        "object.container.channelGroup.videoChannelGroup" => "Container\ChannelGroup\VideoChannelGroup",
        "object.container.epgContainer" => "Container\EpgContainer",
    ];

    public function __construct()
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function getSerializer(array $normalizers = [])
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers[] = new ObjectNormalizer();
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
    public function deserialize($json, $class = null, $type = "json")
    {
        if (!$class) {
            if (false === ($data = json_decode($json))) {
                throw new \InvalidArgumentException(
                    sprintf("Invalid json to deserialize")
                );
            }
            return is_array($data)
                ? $this->deserializeArray($data)
                : $this->deserializeObject($json, $this->getClass($data));
        }
        return $this->deserializeObject($json, $class, $type);
    }

    public function deserializeArray(array $data, $type = "json")
    {
        $objects = [];
        foreach ($data as $object) {
            $objects[] = $this->deserialize(json_encode($object), $this->getClass($object), "json");
        }
        return $objects;
    }

    public function deserializeObject($json, $class, $type = "json")
    {
        $object = $this->serializer
            ->deserialize($json, $class, $type);
        if (isset($object->res)) {
            $object->res = $this->createRes($object->res);
        }
        return $object;
    }

    protected function createRes(array $data)
    {
        $res = [];
        foreach ($data as $resource) {
            $res[] = Res::fromArray($resource);
        }
        return $res;
    }

    protected function getClass($data)
    {
        if (is_string($data)) {
            if (!($data = json_decode($data))) {
                throw new \InvalidArgumentException(
                    sprintf("Invalid data to deserialize")
                );
            }
        }
        if (!isset($data->class)) {
            throw new \RuntimeException(
                sprintf("Couldn't get upnp class name from '%s'",
                    is_object($data) ? get_class($data) : gettype($data)
                )
            );
        }
        if (!isset($this->classMap[$data->class])) {
            throw new \RuntimeException(
                sprintf("Couldn't find class name for upnp class %s", $data->class)
            );
        }
        return "Kemer\\MediaLibrary\\".$this->classMap[$data->class];
    }
}
