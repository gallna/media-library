<?php
namespace Kemer\MediaLibrary\Builder;

use Kemer\MediaLibrary\Item\Audio\AudioItemInterface;
use Kemer\MediaLibrary\Item\Video\VideoItemInterface;
use Kemer\MediaLibrary\Item\Image\ImageItemInterface;
use Kemer\MediaLibrary\Item\ProtocolInfo;
use Kemer\MediaLibrary\Item\Res;
use Kemer\MediaLibrary\ItemInterface;
use Axelarge\ArrayTools\WrappedArray;

class GetID3Builder implements MetadataBuilderInterface
{
    protected $getID3;
    protected $memcache;

    public function __construct($getID3, $memcache)
    {
        $this->getID3 = $getID3;
        $this->memcache = $memcache;
    }

/*
  0 => string 'GETID3_VERSION' (length=14)
  1 => string 'filesize' (length=8)
  2 => string 'filepath' (length=8)
  3 => string 'filename' (length=8)
  4 => string 'filenamepath' (length=12)
  5 => string 'avdataoffset' (length=12)
  6 => string 'avdataend' (length=9)
  7 => string 'fileformat' (length=10)
  8 => string 'audio' (length=5)
  9 => string 'video' (length=5)
  10 => string 'tags' (length=4)
  11 => string 'encoding' (length=8)
  12 => string 'mime_type' (length=9)
  13 => string 'matroska' (length=8)
  14 => string 'playtime_seconds' (length=16)
  15 => string 'tags_html' (length=9)
  16 => string 'bitrate' (length=7)
  17 => string 'playtime_string' (length=15)
  18 => string 'comments' (length=8)
  19 => string 'comments_html' (length=13)
 */

    public function buildMetadata(\SplFileInfo $fileinfo, ItemInterface $item)
    {
        $key = "tags_".$fileinfo->getRealPath();
        //$this->memcache->delete($key);
        if (!$analyzed = $this->memcache->get($key)) {
            $analyzed = $this->getID3->analyze($fileinfo->getRealPath());
            $this->memcache->set($key, $analyzed);
        }
        $tags = \getid3_lib::CopyTagsToComments($analyzed);
        //var_dump(isset($analyzed["comments"]) ? $analyzed["comments"] : $analyzed);
        $tags = new WrappedArray($analyzed);
        switch (true) {
            case $item instanceof AudioItemInterface:
                $this->buildAudioMetadata($item, $tags);
                break;
            case $item instanceof VideoItemInterface:
                $this->buildVideoMetadata($item, $tags);
                break;
            case $item instanceof ImageItemInterface:
                $this->buildImageMetadata($item, $tags);
                break;
            default:
                $this->buildOtherMetadata($item, $tags);
        }
        return $item;
    }

    protected function buildAudioMetadata(AudioItemInterface $item, WrappedArray $info)
    {
        $res = $item->getRes()[0];
        $res->setSize($info->getNested('filesize'));
        $res->setDuration($info->getNested('playtime_seconds'));
        $res->setBitrate($info->getNested('bitrate'));
        //var_dump($info);
        if ($info->hasKey("comments")) {
            $this->addComments($item, new WrappedArray($info->get("comments")));
        }
    }

    protected function buildVideoMetadata(VideoItemInterface $item, WrappedArray $info)
    {
        $res = $item->getRes()[0];
        $res->setSize($info->getNested('filesize'));
        $res->setDuration($info->getNested('playtime_seconds'));
        $res->setBitrate($info->getNested('bitrate'));
        if ($info->hasKey("comments")) {
            $this->addComments($item, new WrappedArray($info->get("comments")));
        }

        if ($info->hasKey("video")) {
        }

    }

    protected function buildImageMetadata(ImageItemInterface $item, WrappedArray $info)
    {
        $res = $item->getRes()[0];
        $res->setSize($info->getNested('filesize'));
    }

    protected function buildOtherMetadata(ItemInterface $item, WrappedArray $info)
    {
        //var_dump($info);
    }

    protected function addComments(ItemInterface $item, WrappedArray $comments)
    {
        if ($comments->hasKey("title")) {
            $item->setTitle($comments->get("title")[0]);
        }
        if ($comments->hasKey("genre")) {
            $item->setGenre($comments->get("genre")[0]);
        }
        if ($comments->hasKey("track")) {
            $item->setOriginalTrackNumber($comments->get("track")[0]);
        }
        if ($comments->hasKey("album")) {
            $item->setAlbum($comments->get("album")[0]);
        }
        if ($comments->hasKey("artist")) {
            $item->addArtist($comments->get("artist")[0]);
        }
        if ($comments->hasKey("language")) {
            $item->setLanguage($comments->get("language")[0]);
        }
    }
}



class GetID3Builderzz
{
    protected $getID3;

    public function __construct($getID3)
    {
        $this->getID3 = $getID3;
    }

/*
  0 => string 'GETID3_VERSION' (length=14)
  1 => string 'filesize' (length=8)
  2 => string 'filepath' (length=8)
  3 => string 'filename' (length=8)
  4 => string 'filenamepath' (length=12)
  5 => string 'avdataoffset' (length=12)
  6 => string 'avdataend' (length=9)
  7 => string 'fileformat' (length=10)
  8 => string 'audio' (length=5)
  9 => string 'video' (length=5)
  10 => string 'tags' (length=4)
  11 => string 'encoding' (length=8)
  12 => string 'mime_type' (length=9)
  13 => string 'matroska' (length=8)
  14 => string 'playtime_seconds' (length=16)
  15 => string 'tags_html' (length=9)
  16 => string 'bitrate' (length=7)
  17 => string 'playtime_string' (length=15)
  18 => string 'comments' (length=8)
  19 => string 'comments_html' (length=13)
 */

    public function buildMetadata(ObjectInterface $object, $file)
    {
        $analyzed = $this->getID3->analyze($file);
        $tags = \getid3_lib::CopyTagsToComments($analyzed);
        $protocolInfo = new ProtocolInfo();
        $protocolInfo->setProtocol(ProtocolInfo::PROTOCOL_HTTP_GET);
        $protocolInfo->setNetwork("*");
        if (isset($analyzed['mime_type'])) {
            $protocolInfo->setContentFormat($analyzed['mime_type']);
        }

        $protocolInfo->setAdditionalInfo("*");
        $res = new Res($file);
        $res->setProtocolInfo($protocolInfo);
        $object->addRes($res);

        return $analyzed;
    }
}

