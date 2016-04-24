<?php
namespace Kemer\MediaLibrary\Item\VideoItem;

use Kemer\MediaLibrary\Item\VideoItemInterface;

/**
 * A tvStation represents an (Internet or conventional) tv station, and is derived from the cdsItemContainer
 * base class. A tv channel can contain other items representing the broadcast schedule of the channel, or it
 * can be present as an atomatic item, for example when no schedule information is known. In the latter case,
 * the ‘childCount’ attribute of the <container> tag will simply be ‘0’. The tvStation class identifies the
 * following properties:
 * A ‘videoBroadcast’ instance is a continuus stream of video that should be interpreted as a broadcast (e.g., a
 * convential TV channel or a Webcast).
 * It typically has at least 1 <res> element.
 */
interface VideoBroadcastInterface extends VideoItemInterface
{
    // upnp:icon
    // upnp:region
    // upnp:channelNr
}
