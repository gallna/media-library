<?php
namespace Kemer\MediaLibrary;

use SimpleXmlElement;

class Item extends Object implements ItemInterface
{
    const VIDEO_ITEM = "object.item.videoItem";

    /**
     * Object constructor
     *
     * @param string $id
     * @param string $title
     * @param string $upnpClass
     */
    public function __construct($id, $title = null, $upnpClass = ItemInterface::UPNP_ITEM)
    {
        parent::__construct($id, $title, $upnpClass);
    }

    public function setRes(array $res)
    {
        $this->elements["res"] = $res;
        return $this;
    }

    public function addRes($res)
    {
        $this->elements["res"][] = $res;
        return $this;
    }

    public function getRes($res = null)
    {
        return $this->elements["res"];
    }
}
