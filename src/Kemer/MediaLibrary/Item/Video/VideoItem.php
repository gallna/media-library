<?php
namespace Kemer\MediaLibrary\Item\Video;

use Kemer\MediaLibrary\DcElement;
use Kemer\MediaLibrary\Item as BaseItem;
use Kemer\MediaLibrary\Traits;

/**
 * A ‘videoItem’ instance represents a piece of content that, when rendered,
 * generates some video. It is atomic in the sense that it does not contain
 * other objects in the ContentDirectory.
 * It typically has at least 1 <res> element.
 */
class VideoItem extends BaseItem implements VideoItemInterface
{
    // upnp:producer
    // upnp:rating
    // upnp:director
    // dc:publisher
    // dc:relation

    use Traits\GenreTrait;
    use Traits\PersonTrait;

    /**
     * VideoItem constructor
     *
     * @param string $id
     * @param string $title
     * @param string $upnpClass
     */
    public function __construct($id, $title, $upnpClass = "object.item.videoItem")
    {
        parent::__construct($id, $title, $upnpClass);
    }

    /**
     * {@inheritDoc}
     */
    public function addActor($actor)
    {
        $this->elements["actor"][] = $actor;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getActors()
    {
        return isset($this->elements["actor"]) ? $this->elements["actor"] : [];
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
}
