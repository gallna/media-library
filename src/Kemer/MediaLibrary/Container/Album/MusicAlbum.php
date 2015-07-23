<?php
namespace Kemer\MediaLibrary\Container\Album;

/**
 * A ‘musicAlbum’ instance is an ‘album’ which contains items of class ‘musicTrack’
 * or ‘sub’-albums of class ‘musicAlbum’. It can be used to model, for example, an audio-CD.
 */
class MusicAlbum extends Album
{
    /**
     * Set artist
     * (upnp:artist)
     *
     * @param string $artist
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
        return $this;
    }

    /**
     * Get artist
     *
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set genre
     * (upnp:genre)
     *
     * @param string $artist
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set producer
     * (upnp:producer)
     *
     * @param string $artist
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;
        return $this;
    }

    /**
     * Get producer
     *
     * @return string
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * Set albumArtURI
     * (upnp:albumArtURI)
     *
     * @param string
     */
    public function setAlbumArtURI($albumArtURI)
    {
        $this->albumArtURI = $albumArtURI;
        return $this;
    }

    /**
     * Get albumArtURI
     *
     * @return string
     */
    public function getAlbumArtURI()
    {
    return $this->albumArtURI;
    }

     /**
     * Set toc
     * (upnp:toc)
     *
     * @param string $artist
     */
    public function setToc($toc)
    {
        $this->toc = $toc;
        return $this;
    }

    /**
     * Get toc
     *
     * @return string
     */
    public function getToc()
    {
        return $this->toc;
    }

}
