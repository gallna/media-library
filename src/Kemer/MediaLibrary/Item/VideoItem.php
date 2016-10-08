<?php
namespace Kemer\MediaLibrary\Item;

use Kemer\MediaLibrary\Item;

/**
 * A ‘videoItem’ instance represents a piece of content that, when rendered,
 * generates some video. It is atomic in the sense that it does not contain
 * other objects in the ContentDirectory.
 * It typically has at least 1 <res> element.
 */
class VideoItem extends Item implements VideoItemInterface
{
    /** @class upnp */
    public $class = "object.item.videoItem";

    /**
     * @class upnp
     */
    public $genre;

    /**
     * The upnp:genre@extended property shall be a CSV list of genre names, which
     * are individually displayable strings, representing increasingly precise
     * (sub)genre names.  The list shall be ordered with the most general genre first.
     * The first entry in the list shall be equal to the value of the upnp:genre property.
     *
     * @class upnp
     */
    public $extendedGenre;

    /**
     * @class dc
     */
    public $language;

    /**
     * @class dc
     */
    public $description;

    /**
     * @class upnp
     */
    public $longDescription;

    /**
     * Missing video date object
     * (dc:date)
     *
     * @var string
     */
    public $date;

    /**
     * @class upnp
     */
    public $rating;

    /**
     * @class upnp
     */
    public $actor = [];

    /**
     * @class upnp
     */
    public $director = [];

    /**
     * @class upnp
     */
    public $producer = [];

    /**
     * @class dc
     */
    public $publisher = [];

    /**
     * @class dc
     */
    public $relation;
}
