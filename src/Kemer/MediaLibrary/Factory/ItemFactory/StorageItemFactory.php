<?php
namespace Kemer\MediaLibrary\Factory\ItemFactory;

use Kemer\MediaLibrary\Item;
use Kemer\MediaLibrary\Item\Audio\MusicTrack;
use Kemer\MediaLibrary\Item\Video\VideoItem;
use Kemer\MediaLibrary\Item\Image\ImageItem;
use Kemer\MediaLibrary\Item\ProtocolInfo;
use Kemer\MediaLibrary\Item\Res;

class StorageItemFactory implements StorageItemFactoryInterface
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
     * @param string $folder Path to media folder
     * @return Kemer\MediaLibrary\Container\StorageFolderInterface
     */
    public function createItem(\SplFileInfo $fileinfo)
    {
        if ($fileinfo->isDir()) {
            throw new \InvalidArgumentException(
                "Only files are accepted"
            );
        }
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $fileinfo->getRealPath());

        switch (true) {
            case in_array($mimeType, (array)$this->mimeTypes->audio):
                $item = $this->createAudioItem($fileinfo, $mimeType);
                break;
            case in_array($mimeType, (array)$this->mimeTypes->video):
                $item = $this->createVideoItem($fileinfo, $mimeType);
                break;
            case in_array($mimeType, (array)$this->mimeTypes->image):
                $item = $this->createImageItem($fileinfo, $mimeType);
                break;
            default:
                switch (true) {
                    case isset($this->mimeTypes->audio->{$fileinfo->getExtension()}):
                        $item = $this->createAudioItem($fileinfo, $mimeType);
                        break;
                    case isset($this->mimeTypes->video->{$fileinfo->getExtension()}):
                        $item = $this->createVideoItem($fileinfo, $mimeType);
                        break;
                    case isset($this->mimeTypes->image->{$fileinfo->getExtension()}):
                        $item = $this->createImageItem($fileinfo, $mimeType);
                        break;
                    default:
                        $item = $this->createOtherItem($fileinfo, $mimeType);
                }
        }
        $protocolInfo = (new ProtocolInfo())
            ->setProtocol(ProtocolInfo::PROTOCOL_HTTP_GET)
            ->setNetwork("*")
            ->setContentFormat($mimeType)
            ->setAdditionalInfo("*");

        // 'http://10.0.10.107:81/app.server/stream.php'
        $res = (new Res($fileinfo->getRealPath()))
            ->setProtocolInfo($protocolInfo);
        $item->addRes($res);

        $res = (new Res('http://10.0.10.107:9000'.$fileinfo->getRealPath()))
            ->setProtocolInfo($protocolInfo);
        $item->addRes($res);
        return $item;
    }

    protected function createAudioItem(\SplFileInfo $fileinfo, $mimeType)
    {
        return new MusicTrack(md5($fileinfo->getRealPath()), $fileinfo->getFilename());
    }

    protected function createVideoItem(\SplFileInfo $fileinfo, $mimeType)
    {
        return new VideoItem(md5($fileinfo->getRealPath()), $fileinfo->getFilename());
    }

    protected function createImageItem(\SplFileInfo $fileinfo, $mimeType)
    {
        return new ImageItem(md5($fileinfo->getRealPath()), $fileinfo->getFilename());
    }

    protected function createOtherItem(\SplFileInfo $fileinfo, $mimeType)
    {
        return new Item(md5($fileinfo->getRealPath()), $fileinfo->getFilename());
    }
}
