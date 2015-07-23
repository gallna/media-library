<?php
namespace Kemer\MediaLibrary\Factory\ItemFactory;

interface StorageItemFactoryInterface
{
    /**
     * Create ItemInterface object from provided file
     *
     * @param SplFileInfo $fileinfo
     * @return Kemer\MediaLibrary\ItemInterface
     */
    public function createItem(\SplFileInfo $fileinfo);
}
