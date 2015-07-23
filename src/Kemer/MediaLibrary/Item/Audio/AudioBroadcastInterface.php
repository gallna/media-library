<?php
namespace Kemer\MediaLibrary\Item\Audio;

/**
 * An ‘audioBroadcast’ instance is a continuus stream of audio that should be interpreted
 * as an audio broadcast (as opposed to, for example, a song or an audio book).
 * It typically has at least 1 <res> element.
 */
interface AudioBroadcastInterface extends AudioItemInterface
{
    // upnp:region No
    // upnp:radioCallSign No
    // upnp:radioStationID No
    // upnp:radioBand No
    // upnp:channelNr No
}
