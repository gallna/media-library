<?php
namespace Kemer\MediaLibrary\Container;

use Kemer\MediaLibrary\ContainerInterface;

/**
 * A ‘genre’ instance represents an unordered collection of ‘objects’ that “belong”
 * to the genre, in a loose sense. It may have a <res> element for playback of all
 * elements of the genre, or not. In the first case, rendering the genre has
 * the semantics of rendering each object in the collection, in some order.
 * In the latter case, a control point needs to separately initiate rendering
 * for each child object. A ‘genre’ container can contain objects of class
 * ‘person’, ‘album’, ‘audioItem’, ‘videoItem’ or “sub”-genres of the same class
 * (e.g. ‘Rock’ contains ‘Alternative Rock’). Which classes of objects a ‘genre’
 * contains in a ContentDirectory implementation is device-dependent.
 */
interface GenreInterface extends ContainerInterface
{
    /**
     * Set a genre long description
     *
     * @param string $longDescription
     * @return self FluidInterface
     */
    //public function setLongDescription($longDescription);

    /**
     * Get a genre long description
     * dc:description)
     *
     * @return string
     */
    //public function getLongDescription();

    /**
     * Set a genre description
     *
     * @param string $description
     * @return self FluidInterface
     */
    //public function setDescription($description);

    /**
     * Get a genre description
     * (upnp:longDescription)
     *
     * @return string
     */
    //public function getDescription();
}
