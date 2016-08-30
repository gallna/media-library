<?php
namespace Kemer\MediaLibrary\Container;

use Kemer\MediaLibrary\Container;

class Playlist extends Container
{
    /** @class upnp */
    public $class = "object.container.playlistContainer";

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
    public $producer;

    /**
     * @class upnp
     */
    public $storageMedium;

    /**
     * @class dc
     */
    public $contributor;

    /**
     * @class dc
     */
    public $rights;
}
