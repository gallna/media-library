<?php
namespace Kemer\MediaLibrary\Item\Audio;

/**
 * A ‘musicTrack’ instance is a discrete piece of audio that should be interpreted
 * as music (as opposed to, for example, a news broadcast or an audio book).
 * It typically has at least 1 <res> element.
 */
interface MusicTrackInterface extends AudioItemInterface
{
    // upnp:artist No
    // upnp:album No
    // upnp:originalTrackNumber No
    // upnp:playlist No
    // upnp:storageMedium No
    // dc:contributor No
    // dc:date No

    /**
     * Get artist
     *
     * @return []UpnpElement
     */
    public function getArtists();

    /**
     * Add artist
     * (upnp:artist)
     *
     * @param string $artist
     */
    public function addArtist($artist);

    /**
     * Get album
     *
     * @return UpnpElement
     */
    public function getAlbum();

    /**
     * Set album
     * (upnp:album)
     *
     * @param string $artist
     */
    public function setAlbum($album);

    /**
     * Get originalTrackNumber
     *
     * @return UpnpElement
     */
    public function getOriginalTrackNumber();

    /**
     * Set originalTrackNumber
     * (upnp:originalTrackNumber)
     *
     * @param string $artist
     */
    public function setOriginalTrackNumber($originalTrackNumber);

    /**
     * Get playlist
     *
     * @return UpnpElement
     */
    public function getPlaylist();

    /**
     * Set playlist
     * (upnp:playlist)
     *
     * @param string $artist
     */
    public function setPlaylist($playlist);

    /**
     * Get storageMedium
     *
     * @return UpnpElement
     */
    public function getStorageMedium();

    /**
     * Set storageMedium
     * (upnp:storageMedium)
     *
     * @param string $artist
     */
    public function setStorageMedium($storageMedium);

    /**
     * Get contributor
     *
     * @return DcElement
     */
    public function getContributor();

    /**
     * Set contributor
     * (dc:contributor)
     *
     * @param string $artist
     */
    public function setContributor($contributor);

    /**
     * Get date
     *
     * @return DcElement
     */
    public function getDate();

    /**
     * Set date
     * (dc:date)
     *
     * @param string $artist
     */
    public function setDate($date);
}
