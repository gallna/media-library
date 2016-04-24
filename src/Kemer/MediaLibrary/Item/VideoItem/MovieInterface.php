<?php
namespace Kemer\MediaLibrary\Item\VideoItem;

use Kemer\MediaLibrary\Item\VideoItemInterface;

/**
 * A ‘movie’ instance is a discrete piece of video that should be interpreted as
 * a movie (as opposed to, for example, a continuus TV broadcast or a music video clip).
 * It typically has at least 1 <res> element.
 */
interface MovieInterface extends VideoItemInterface
{
    // upnp:storageMedium
    // upnp:DVDRegionCode
    // upnp:channelName
    // upnp:scheduledStartTime
    // upnp:scheduledEndTime
}
