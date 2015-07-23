<?php
namespace Kemer\MediaLibrary\Item\Audio;

use Kemer\MediaLibrary\DcElement;
use Kemer\MediaLibrary\Item as BaseItem;
use Kemer\MediaLibrary\Traits;

class AudioItem extends BaseItem implements AudioItemInterface
{
    // upnp:genre  Required:No
    // upnp:longDescription  Required:No
    use Traits\GenreTrait;
    // dc:language  Required:No
    use Traits\PersonTrait;

    /**
     * {@inheritDoc}
     */
    public function setGenre($genre)
    {
        $this->genre = new DcElement('genre', $genre);
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
