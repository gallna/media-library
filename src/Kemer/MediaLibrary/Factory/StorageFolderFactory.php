<?php
namespace Kemer\MediaLibrary\Factory;

use Kemer\MediaLibrary\Container\StorageFolder;
use Kemer\MediaLibrary\Container\StorageFolderInterface;
use Kemer\MediaLibrary\Builder\MetadataBuilderInterface;
use Kemer\MediaLibrary\Item;
use FilesystemIterator;
use RecursiveDirectoryIterator;

class StorageFolderFactory
{
    private $metadataBuilder;
    private $itemFactory;

    public function __construct(
        ItemFactory\StorageItemFactoryInterface $itemFactory,
        MetadataBuilderInterface $builder
    ) {
        $this->metadataBuilder = $builder;
        $this->itemFactory = $itemFactory;
    }

    /**
     * Create StorageFolder from given folder
     *
     * @param string $folder Path to media folder
     * @return Kemer\MediaLibrary\Container\StorageFolderInterface
     */
    public function createStorageFolder($folder, StorageFolderInterface $storageFolder = null)
    {
        if (!is_dir($folder)) {
            throw new \InvalidArgumentException(
                sprintf("Folder '%s' does not exists", $folder)
            );
        }
        $recursiveDirectoryIterator = new RecursiveDirectoryIterator(
            $folder,
            FilesystemIterator::SKIP_DOTS | FilesystemIterator::CURRENT_AS_SELF
        );
        return $this->scanFolder($recursiveDirectoryIterator, $storageFolder);
    }

    protected function scanFolder(RecursiveDirectoryIterator $items, StorageFolderInterface $storageFolder = null)
    {
        $storageFolder = $storageFolder ?: new StorageFolder($items->getRealPath(), $items->getBasename());
        foreach ($items as $item) {
            $storageFolder->add(
                $item->hasChildren()
                    ? $this->scanFolder($item->getChildren())
                    : $this->scanItem($item)
            );
        }
        return $storageFolder;
    }

    protected function scanItem(\SplFileInfo $fileinfo)
    {
        $item = $this->itemFactory->createItem($fileinfo);
        $this->metadataBuilder->buildMetadata($fileinfo, $item);
        return $item;
    }
}
