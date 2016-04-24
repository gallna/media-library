<?php
namespace Kemer\MediaLibrary\Item;

use Kemer\MediaLibrary\ItemInterface;

/**
 * A ‘videoItem’ instance represents a piece of content that, when rendered,
 * generates some video. It is atomic in the sense that it does not contain
 * other objects in the ContentDirectory.
 * It typically has at least 1 <res> element.
 */
interface VideoItemInterface extends ItemInterface
{
    /**
     * Sets video genre
     * (upnp:genre)
     *
     * @param string
     */
    //public function setGenre($genre);

    /**
     * Gets video genre
     *
     * @return string
     */
    //public function getGenre();

    /**
     * Add an actor
     *
     * @param string $actor
     */
    //public function addActor($actor);

    /**
     * Returns video actors
     *
     * @return []UpnpElement
     */
    //public function getActors();

    // upnp:longDescription
    // upnp:producer
    // upnp:rating
    // upnp:actor
    // upnp:director
    // dc:description
    // dc:publisher
    // dc:language
    // dc:relation
}
