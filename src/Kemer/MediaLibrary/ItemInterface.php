<?php
namespace Kemer\MediaLibrary;

/**
 * This is a derived class of object used to represent “atomic” content objects,
 * i.e., object that don’t contain other objects, for example, a music track on
 * an audio CD. The XML expression of any instance of a class that is derived from
 * item is the <item> tag.
 */
interface ItemInterface
{
    const UPNP_ITEM = "object.item";
    /**
     * Set an id property of the item being referred to.
     *
     * @param string $id
     */
    //public function setRefId($id);

    /**
     * Id property of the item being referred to.
     *
     * @return string
     */
    //public function getRefId();
}
