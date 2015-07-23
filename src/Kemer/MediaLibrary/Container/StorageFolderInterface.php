<?php
namespace Kemer\MediaLibrary\Container;

use Kemer\MediaLibrary\ContainerInterface;

/**
 * A ‘storageFolder’ instance represents a collection of objects stored on some storage medium. The storage
 * folder may be writable or not, indicating whether new items can be created as children of the folder or
 * whether existing child items can be removed. If the parent storage container is not writable, then the
 * ‘storageFolder’ itself cannot be writable. A ‘storageFolder’ may contain other objects, except a
 * ‘storageSystem’ or a ‘storageVolume’. A ‘storageFolder’ may only be a child of the root container or
 * another storage container.
 */
interface StorageFolderInterface extends ContainerInterface
{
    const UPNP_STORAGE_FOLDER = "object.storageFolder";
    /**
     * Combined space, in bytes, used by all the objects held in the storage represented
     * by the container Value –1 is reserved to indicate that the space is ‘unknown’.
     *
     * @param integer $storage
     */
    public function setStorageUsed($storage);

    /**
     * Get combined space.
     *
     * @return integer
     */
    public function getStorageUsed();
}
