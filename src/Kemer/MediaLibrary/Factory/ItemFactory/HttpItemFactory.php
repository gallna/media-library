<?php
namespace Kemer\MediaLibrary\Factory\ItemFactory;

use Kemer\MediaLibrary\Item;
use Kemer\MediaLibrary\Item\Audio\MusicTrack;
use Kemer\MediaLibrary\Item\Video\VideoItem;
use Kemer\MediaLibrary\Item\Image\ImageItem;
use Kemer\MediaLibrary\Item\ProtocolInfo;
use Kemer\MediaLibrary\Item\Res;
use Zend\Uri\Http as HttpUri;
use Zend\Uri\UriInterface;
use Zend\Uri\UriFactory;

class HttpItemFactory
{
    public function __construct(stdClass $mimeTypes = null)
    {
        if (!$mimeTypes) {
            $mimeTypes = json_decode(file_get_contents(__DIR__."/../mime-types.json"));
        }
        $this->mimeTypes = $mimeTypes;
    }
    /**
     * Create StorageFolder from given folder
     *
     * @param string $url
     * @return ItemInterface
     */
    public function createItem($url)
    {
        $uri = UriFactory::factory($url);
        if (!$uri instanceof HttpUri) {
            throw new \InvalidArgumentException(
                sprintf('HttpItemFactory accepts only http url, "%s" given', $url)
            );
        }
        $path = $uri->getPath();
        $pathinfo = pathinfo($path);
        if (!isset($pathinfo['extension'])) {
            throw new \InvalidArgumentException(
                sprintf("Couldn't detect url type, from '%s'", $url)
            );
        }
        $extension = $pathinfo['extension'];

        switch (true) {
            case array_key_exists($extension, (array)$this->mimeTypes->audio):
                $mimeType = $this->mimeTypes->audio->{$extension};
                $item = $this->createAudioItem($uri, $mimeType);
                break;
            case array_key_exists($extension, (array)$this->mimeTypes->video):
                $mimeType = $this->mimeTypes->video->{$extension};
                $item = $this->createVideoItem($uri, $mimeType);
                break;
            case array_key_exists($extension, (array)$this->mimeTypes->image):
                $mimeType = $this->mimeTypes->image->{$extension};
                $item = $this->createImageItem($uri, $mimeType);
                break;
            default:
                $item = $this->createOtherItem($fileinfo, $mimeType);
        }

        $protocolInfo = (new ProtocolInfo())
            ->setProtocol(ProtocolInfo::PROTOCOL_HTTP_GET)
            ->setNetwork("*")
            ->setContentFormat($mimeType)
            ->setAdditionalInfo("*");

        // 'http://10.0.10.107:81/app.server/stream.php'
        $res = (new Res($url))
            ->setProtocolInfo($protocolInfo);
        $item->addRes($res);
        return $item;
    }

    protected function createAudioItem(UriInterface $uri, $mimeType)
    {
        return new MusicTrack(md5((string)$uri), (string)$uri);
    }

    protected function createVideoItem(UriInterface $uri, $mimeType)
    {
        return new VideoItem(md5((string)$uri), (string)$uri);
    }

    protected function createImageItem(UriInterface $uri, $mimeType)
    {
        return new ImageItem(md5((string)$uri), (string)$uri);
    }

    protected function createOtherItem(UriInterface $uri, $mimeType)
    {
        return new Item(md5((string)$uri), (string)$uri);
    }
}
