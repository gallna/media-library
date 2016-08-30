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

    // upnp:producer
    // upnp:rating
    // upnp:director
    // dc:publisher
    // dc:relation

    /**
     * A language
     * (dc:language)
     *
     * @var string
     */
    public $language;

    /**
     * A genre
     * (upnp:genre)
     *
     * @var string
     */
    public $genre;

    /**
     * A genre description
     * (dc:description)
     *
     * @var string
     */
    public $description;

    /**
     * A genre long description
     * (upnp:longDescription)
     *
     * @var string
     */
    public $longDescription;

    /**
     * Missing video date object
     * (dc:date)
     *
     * @var string
     */
    public $date;

    public $actor = [];
    public $director;
    public $publisher;
    public $relation;
}
