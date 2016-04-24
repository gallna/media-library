<?php
namespace Kemer\MediaLibrary\Container;

use Kemer\MediaLibrary\Container;

class Person extends Container implements PersonInterface
{
    /** @class upnp */
    public $class = "object.container.person";

    /**
     * A language
     * (dc:language)
     *
     * @var string
     */
    public $language;
}
