<?php
namespace Kemer\MediaLibrary\Item\Video;

/**
 * A ‘musicVideoClip’ instance is a discrete piece of video that should be interpreted
 * as a clip supporting a song (as opposed to, for example, a continuus TV broadcast or a movie).
 * It typically has at least 1 <res> element.
 */
interface MusicVideoClipInterface extends VideoItemInterface
{
    // upnp:artist
    // upnp:storageMedium
    // upnp:album
    // upnp:scheduledStartTime
    // upnp:scheduledStopTime
    // upnp:director
    // dc:contributor
    // dc:date
}
