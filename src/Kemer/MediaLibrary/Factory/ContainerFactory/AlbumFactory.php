<?php
namespace Kemer\MediaLibrary\Factory\ContainerFactory;

use Kemer\MediaLibrary\LibraryInterface;
use Kemer\MediaLibrary\Container;
use Kemer\MediaLibrary\ContainerInterface;
use Kemer\MediaLibrary\Container\Album;
use Kemer\MediaLibrary\Item\Audio\MusicTrackInterface;

class AlbumFactory
{
    /**
     * Create MusicAlbum containers from media library
     *
     * @param LibraryInterface $library Media Library to create containers from
     * @param ContainerInterface $container Root container for MusicAlbum containers
     * @return ContainerInterface
     */
    public function createMusicAlbum(LibraryInterface $library, ContainerInterface $container = null)
    {
        $albums = [];
        foreach ($library->getItems() as $item) {
            if ($item instanceof MusicTrackInterface) {
                $albums[(string)$item->getAlbum()][] = $item;
            }
        }
        $container = $container ?: new Container(6, "Music/Album");
        foreach ($albums as $album => $items) {
            $id = sprintf("%s-album-%s", $container->getId(), $album ?: "UNDEFINED");
            $albumContainer = new Album\MusicAlbum($id, $album);
            array_map([$albumContainer, "add"], $items);
            $container->add($albumContainer);
        }
        return $container;
    }
}
