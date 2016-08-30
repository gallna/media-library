<?php
namespace Kemer\MediaLibrary\Item;

use Kemer\MediaLibrary\Item;

class PlaylistItem extends Item
{
    /** @class upnp */
    public $class = "object.item.playlistItem";

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

    /**
     * @class upnp
     */
    public $artist;

    /**
     * @class upnp
     */
    public $storageMedium;

}
