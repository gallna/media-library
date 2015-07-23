<?php
namespace Kemer\MediaLibrary\Builder;

use Kemer\MediaLibrary\ItemInterface;

interface MetadataBuilderInterface
{
    public function buildMetadata(\SplFileInfo $fileinfo, ItemInterface $item);
}

