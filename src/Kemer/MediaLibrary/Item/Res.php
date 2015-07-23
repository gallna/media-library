<?php
namespace Kemer\MediaLibrary\Item;

use Kemer\MediaLibrary\Element;

class Res extends Element
{
    private $bitrate;
    private $importUri;

    public function __construct($res)
    {
        parent::__construct("res", $res);
    }

    /**
     * Resource uri
     *
     * @param string $res
     */
    public function setRes($res)
    {
        $this->res = $res;
        return $this;
    }

    public function getRes()
    {
        return $this->res;
    }

    /**
     * Size in bytes of the resource
     *
     * @param integer $size
     */
    public function setSize($size)
    {
        $this->attributes["size"] = $size;
        return $this;
    }

    public function getSize()
    {
        return $this->attributes["size"];
    }

    /**
     * Time duration of the playback of the resource, at normal speed
     *
     * @param string $duration H+:MM:SS[.F+], or H+:MM:SS[.F0/F1]
     */
    public function setDuration($duration)
    {
        $this->attributes["duration"] = $duration;
        return $this;
    }

    public function getDuration()
    {
        return $this->attributes["duration"];
    }

    /**
     * Bitrate in bytes/seconds of the encoding of the resource
     *
     * @param integer $bitrate
     */
    public function setBitrate($bitrate)
    {
        $this->bitrate = $bitrate;
        return $this;
    }

    public function getBitrate()
    {
        return $this->bitrate;
    }

    /**
     * Astring that identifies the recommended HTTP protocol for transmitting
     * the resource (see also UPnP A/V Conection Manager Service template,
     * section 2.5.2). If not present, then the content has not yet been fully
     * imported by CDS and is not yet accesible for playback purposes.
     *
     * @param ProtocolInfo $protocolInfo
     */
    public function setProtocolInfo(ProtocolInfo $protocolInfo)
    {
        $this->attributes["protocolInfo"] = $protocolInfo;
        return $this;
    }

    public function getProtocolInfo()
    {
        return $this->attributes["protocolInfo"];
    }

    public function setImportUri($importUri)
    {
        $this->importUri = $importUri;
        return $this;
    }

    public function getImportUri()
    {
        return $this->importUri;
    }

    public function asXMLa(\SimpleXmlElement $root = null)
    {
        $res = $root->addChild('res', $this->getRes());
        $res->addAttribute('protocolInfo', (string)$this->getProtocolInfo());
        $res->addAttribute('size', $this->getSize());
        $res->addAttribute('duration', $this->getDuration());
    }
}
