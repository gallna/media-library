<?php
namespace Kemer\MediaLibrary\Container;

use Kemer\MediaLibrary\Container as BaseContainer;

class StorageFolder extends BaseContainer implements StorageFolderInterface
{
    public function __construct($id, $title, $upnpClass = StorageFolderInterface::UPNP_STORAGE_FOLDER)
    {
        parent::__construct($id, $title, $upnpClass);
    }

    /**
     * Combined space, in bytes, used by all the objects held in the storage represented
     * by the container Value –1 is reserved to indicate that the space is ‘unknown’.
     *
     * @var integer
     */
    protected $storageUsed = -1;

    /**
     * {@inheritDoc}
     */
    public function setStorageUsed($storageUsed)
    {
        $this->storageUsed = $storageUsed;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getStorageUsed()
    {
        return $this->storageUsed;
    }
}
