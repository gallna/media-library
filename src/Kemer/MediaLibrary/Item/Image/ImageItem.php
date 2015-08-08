<?php
namespace Kemer\MediaLibrary\Item\Image;

use Kemer\MediaLibrary\Item as BaseItem;

class ImageItem extends BaseItem implements ImageItemInterface
{
    // upnp:longDescription
    // upnp:storageMedium
    // upnp:rating
    // dc:description
    // dc:publisher
    // dc:date
    // dc:rights

    /**
     * VideoItem constructor
     *
     * @param string $id
     * @param string $title
     * @param string $upnpClass
     */
    public function __construct($id, $title, $upnpClass = "object.item.imageItem")
    {
        parent::__construct($id, $title, $upnpClass);
    }
}

