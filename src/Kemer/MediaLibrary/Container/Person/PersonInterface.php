<?php
namespace Kemer\MediaLibrary\Container\Person;

use Kemer\MediaLibrary\ContainerInterface;

/**
 * A ‘person’ instance represents an unordered collection of ‘objects’ that “belong” to
 * the people, in a loose sense. It may have a <res> element for playback of
 * all elements belongin to the person, or not. In the first case, rendering
 * the ‘person’ has the semantics of rendering each object in the collection,
 * in some order. In the latter case, a control point needs to separately
 * initiate rendering for each child object. A ‘person’ container can contain
 * objects of classes ‘album’, ‘item’, or ‘playlist’. Which classes of objects
 * a ‘person’ contains in a ContentDirectory implementation is device-dependent.
 */
interface PersonInterface extends ContainerInterface
{
    /**
     * Set a person language
     * (dc:language)
     *
     * @param string $language
     * @return self FluidInterface
     */
    public function setLanguage($language);

    /**
     * Get a person language
     * (dc:language)
     *
     * @return string
     */
    public function getLanguage();
}
