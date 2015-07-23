<?php
namespace Kemer\MediaLibrary\Container;

use Kemer\MediaLibrary\Container;

class PlaylistContainer extends Container implements PlaylistContainerInterface
{
    public function __construct($id, $title, $upnpClass = PlaylistContainerInterface::UPNP_PLAYLIST_CONTAINER)
    {
        parent::__construct($id, $title, $upnpClass);
    }
    // upnp:artist
    // upnp:genre
    // upnp:longDescription
    // upnp:producer
    // upnp:storageMedium
    // dc:description
    // dc:contributor
    // dc:date
    // dc:language
    // dc:rights
}
