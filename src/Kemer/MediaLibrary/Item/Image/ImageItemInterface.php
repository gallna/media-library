<?php
namespace Kemer\MediaLibrary\Item\Image;

use Kemer\MediaLibrary\ItemInterface;

/**
 * An ‘imageItem’ instance represents a piece of content that, when rendered,
 * generates some still image. It is atomic in the sense that it does not contain
 * other objects in the ContentDirectory.
 * It typically has at least 1 <res> element.
 */
interface ImageItemInterface extends ItemInterface
{
    // upnp:longDescription
    // upnp:storageMedium
    // upnp:rating
    // dc:description
    // dc:publisher
    // dc:date
    // dc:rights
}
