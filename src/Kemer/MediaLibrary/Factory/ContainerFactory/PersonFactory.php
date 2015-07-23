<?php
namespace Kemer\MediaLibrary\Factory\ContainerFactory;

use Kemer\MediaLibrary\LibraryInterface;
use Kemer\MediaLibrary\Container;
use Kemer\MediaLibrary\ContainerInterface;
use Kemer\MediaLibrary\Container\Person;
use Kemer\MediaLibrary\Item\Video\VideoItemInterface;
use Kemer\MediaLibrary\Item\Audio\MusicTrackInterface;

class PersonFactory
{
    /**
     * Create MovieActor containers from media library
     *
     * @param LibraryInterface $library Media Library to create containers from
     * @param ContainerInterface $container Root container for MovieActor containers
     * @return ContainerInterface
     */
    public function createActor(LibraryInterface $library, ContainerInterface $container = null)
    {
        $actors = [];
        foreach ($library->getItems() as $item) {
            if ($item instanceof VideoItemInterface) {
                if (empty($item->getActors())) {
                    $actors["UNDEFINED"][] = $item;
                } else {
                    foreach ($item->getActors() as $actor) {
                        $actors[(string)$actor][] = $item;
                    }
                }
            }
        }
        $container = $container ?: new Container("A", "Video/Actor");
        foreach ($actors as $actor => $items) {
            $actorContainer = new Person\MovieActor(
                sprintf("%s/actor/%s", $container->getId(), $actor ?: "UNDEFINED"),
                $actor
            );
            array_map([$actorContainer, "add"], $items);
            $container->add($actorContainer);
        }
        return $container;
    }

    /**
     * Create MusicArtist containers from media library
     *
     * @param LibraryInterface $library Media Library to create containers from
     * @param ContainerInterface $container Root container for MusicArtist containers
     * @return ContainerInterface
     */
    public function createArtist(LibraryInterface $library, ContainerInterface $container = null)
    {
        $artists = [];
        foreach ($library->getItems() as $item) {
            if ($item instanceof MusicTrackInterface) {
                if (empty($item->getArtists())) {
                    $artists["UNDEFINED"][] = $item;
                } else {
                    foreach ($item->getArtists() as $artist) {
                        $artists[(string)$artist][] = $item;
                    }
                }
            }
        }

        $container = $container ?: new Container(107, "Music/Artist");
        foreach ($artists as $artist => $items) {
            var_dump($artist);
            $artistContainer = new Person\MusicArtist(
                sprintf("%s/artist/%s", $container->getId(), $artist),
                $artist
            );
            array_map([$artistContainer, "add"], $items);
            $container->add($artistContainer);
        }
        return $container;
    }
}
