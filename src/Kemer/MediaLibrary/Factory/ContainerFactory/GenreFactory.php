<?php
namespace Kemer\MediaLibrary\Factory\ContainerFactory;

use Kemer\MediaLibrary\LibraryInterface;
use Kemer\MediaLibrary\Container;
use Kemer\MediaLibrary\ContainerInterface;
use Kemer\MediaLibrary\Container\Genre;
use Kemer\MediaLibrary\Item\VideoItemInterface;

class GenreFactory
{
    /**
     * Create VideoGenre containers from media library
     *
     * @param LibraryInterface $library Media Library to create containers from
     * @param ContainerInterface $container Root container for VideoGenre containers
     * @return ContainerInterface
     */
    public function createVideoGenre(LibraryInterface $library, ContainerInterface $container = null)
    {
        $genres = [];
        foreach ($library->getItems() as $item) {
            $genres[$item->getGenre()][] = $item;
        }
        $container = $container ?: new Container(9, "Video/Genre");
        foreach ($genres as $genre => $items) {
            $id = sprintf("%s-genre-%s", $container->getId(), $genre ?: "UNDEFINED");
            $genreContainer = new Genre\VideoGenre($id, $genre ?: "UNDEFINED", "object.container.genre.videoGenre");
            array_map([$genreContainer, "add"], $items);
            $container->add($genreContainer);
        }
        return $container;
    }

    /**
     * Create MusicGenre containers from media library
     *
     * @param LibraryInterface $library Media Library to create containers from
     * @param ContainerInterface $container Root container for MusicGenre containers
     * @return ContainerInterface
     */
    public function createMusicGenre(LibraryInterface $library, ContainerInterface $container = null)
    {
        $genres = [];
        foreach ($library->getItems() as $item) {
            $genres[(string)$item->getGenre()][] = $item;
        }
        $container = $container ?: new Container(5, "Music/Genre");
        foreach ($genres as $genre => $items) {
            $id = sprintf("%s-genre-%s", $container->getId(), $genre ?: "UNDEFINED");
            $genreContainer = new Genre\MusicGenre($id, $genre ?: "UNDEFINED", "object.container.genre.musicGenre");
            array_map([$genreContainer, "add"], $items);
            $container->add($genreContainer);
        }
        return $container;
    }
}
