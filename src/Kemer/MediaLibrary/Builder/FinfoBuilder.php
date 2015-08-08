<?php
namespace Kemer\MediaLibrary\Builder;

use Kemer\MediaLibrary\Item\ProtocolInfo;
use Kemer\MediaLibrary\Item\Res;
use Kemer\MediaLibrary\ObjectInterface;
use FilesystemIterator;


class FinfoBuilder implements MetadataBuilderInterface
{
    private $mime = null;
    private $type = null;

    public function buildMetadata(ObjectInterface $object, $file)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $this->mime = finfo_file($finfo, $file);
        finfo_close($finfo);
        var_dump($this->mime);
    }

    private function determine()
    {
        $this->type = null;
        switch ($this->mime) {
            case 'image/jpeg':
                $this->type = MediaType::PICTURE;
                break;
            case 'image/png':
                $this->type = MediaType::PICTURE;
                break;
            case 'audio/mpeg':
                $this->type = MediaType::SOUND;
                break;
            case 'application/pdf':
                $this->type = MediaType::PDF;
                break;
            default:
                $this->type = MediaType::UNKNOWN;
        }
    }
    private function product()
    {
        $media = null;
        switch ($this->type) {
            case MediaType::SOUND:
                $media = new SoundMedia();
                break;
            case MediaType::PICTURE:
                $media = new PictureMedia();
                break;
            case MediaType::PDF:
                $media = new PdfMedia();
                break;
            case MediaType::UNKNOWN:
                $media = new GenericMedia();
                break;
        }
        return ($media);
    }
    public function create($fileName)
    {
        $this->analyse($fileName);
        $this->determine();
        return ($this->product());
    }
}
