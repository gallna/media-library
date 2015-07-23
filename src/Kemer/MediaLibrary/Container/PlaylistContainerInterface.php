<?php
namespace Kemer\MediaLibrary\Container;

use Kemer\MediaLibrary\ContainerInterface;

/**
 * A ‘playlistContainer’ instance represents a collection of ‘objects’. It is different from ‘musicAlbum’ in the
 * sense that a ‘playlistContainer’ may contain a mix of audio, video and images and is typically created by a
 * user, while an ‘album’ is typically a fixed published sequence of songs (e.g., an audio CD). A
 * ‘playlistContainer’ may have a <res> element for playback of the whole playlist or not. This <res> element
 * may be a dynamically created playlist resource, as described in Section 2.8.9.2, or a reference to a playlist
 * file authored outside of the ContentDirectory service (e.g., an external M3U file); this is device-dependent.
 * In any case, rendering the playlist has the semantics defined by the playlist resource (e.g., ordering,
 * transition effects, etc.). If the ‘playlistContainer’ has no <res> element, a control point needs to separately
 * initiate rendering for each child object, typically in the order the children are received from a ‘Browse’
 * action.
 */
interface PlaylistContainerInterface extends ContainerInterface
{
    const UPNP_PLAYLIST_CONTAINER = "object.container.playlistContainer";
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
