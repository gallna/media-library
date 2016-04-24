<?php
namespace Kemer\MediaLibrary\Container;

use Kemer\MediaLibrary\Container;

class Genre extends Container implements GenreInterface
{
    /** @class upnp */
    public $class = "object.container.genre";
    /**
     * A genre description
     * (dc:description)
     *
     * @var string
     */
    public $description;

    /**
     * A genre
     * (upnp:genre)
     *
     * @var string
     */
    public $genre;

    /**
     * A genre long description
     * (upnp:longDescription)
     *
     * @var string
     */
    public $longDescription;
}
