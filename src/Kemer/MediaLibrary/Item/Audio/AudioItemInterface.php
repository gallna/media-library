<?php
namespace Kemer\MediaLibrary\Item\Audio;

use Kemer\MediaLibrary\ItemInterface;

/**
 * An ‘audioItem’ instance represents a piece of content that, when rendered, generates
 * some audio (Movies, TV broadcasts, etc., that also contain an audio track are excluded
 * from this definition; those objects should be classified under ‘videoItem’). It is
 * atomic in the sense that it does not contain other objects in the ContentDirectory.
 * It typically has at least 1 <res> element.
 */
interface AudioItemInterface extends ItemInterface
{
    /**
     * Sets music genre
     * (upnp:genre)
     *
     * @param string
     */
    public function setGenre($genre);

    /**
     * Gets music genre
     *
     * @return string
     */
    public function getGenre();
    // upnp:longDescription  Required:No
    // dc:description  Required:No
    // dc:publisher  Required:No
    // dc:language  Required:No
    // dc:relation  Required:No
    // dc:rights  Required:No
}
