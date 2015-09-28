<?php
namespace Kemer\MediaLibrary\Item\Audio;

use Kemer\MediaLibrary\Item as BaseItem;
use Kemer\MediaLibrary\Traits;
use Kemer\MediaLibrary\UpnpElement;
use Kemer\MediaLibrary\DcElement;

class MusicTrack extends AudioItem implements MusicTrackInterface
{
    /**
     * MusicTrack constructor
     *
     * @param string $id
     * @param string $title
     * @param string $upnpClass
     */
    public function __construct($id, $title, $upnpClass = "object.item.audioItem.musicTrack")
    {
        parent::__construct($id, $title, $upnpClass);
    }

    /**
     * {@inheritDoc}
     */
    public function addArtist($artist)
    {
        $this->elements['artist'][] = $artist;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getArtists()
    {
        return isset($this->elements['artist']) ? $this->elements['artist'] : [];
    }

    /**
     * {@inheritDoc}
     */
    public function setAlbum($album)
    {
        $this->album = $album;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * {@inheritDoc}
     */
    public function setOriginalTrackNumber($originalTrackNumber)
    {
        $this->originalTrackNumber = $originalTrackNumber;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getOriginalTrackNumber()
    {
        return $this->originalTrackNumber;
    }

    /**
     * {@inheritDoc}
     */
    public function setPlaylist($playlist)
    {
        $this->playlist = $playlist;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPlaylist()
    {
        return $this->playlist;
    }

    /**
     * {@inheritDoc}
     */
    public function setStorageMedium($storageMedium)
    {
        $this->storageMedium = $storageMedium;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getStorageMedium()
    {
        return $this->storageMedium;
    }

    /**
     * {@inheritDoc}
     */
    public function setContributor($contributor)
    {
        $this->contributor = $contributor;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getContributor()
    {
        return $this->contributor;
    }

    /**
     * {@inheritDoc}
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDate()
    {
        return $this->date;
    }
}
