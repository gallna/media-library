<?php
namespace Kemer\MediaLibrary\Item\Audio;

use Kemer\MediaLibrary\DcElement;
use Kemer\MediaLibrary\Item;
use Kemer\MediaLibrary\Traits;

class AudioItem extends Item implements AudioItemInterface
{

    // upnp:genre  Required:No
    // upnp:longDescription  Required:No
    use Traits\GenreTrait;
    // dc:language  Required:No
    use Traits\PersonTrait;

    /**
     * AudioItem constructor
     *
     * @param string $id
     * @param string $title
     * @param string $upnpClass
     */
    public function __construct($id, $title, $upnpClass = "object.item.audioItem")
    {
        parent::__construct($id, $title, $upnpClass);
    }


    /**
     * {@inheritDoc}
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getGenre()
    {
        return $this->genre;
    }

    // dc:description  Required:No
    // dc:publisher  Required:No
    // dc:relation  Required:No
    // dc:rights  Required:No
}
