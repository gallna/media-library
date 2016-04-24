<?php
namespace Kemer\MediaLibrary\Item\VideoItem;

use Kemer\MediaLibrary\Item\VideoItem as BaseVideoItem;

class Movie extends BaseVideoItem implements MovieInterface
{
    /** @class upnp */
    public $class = "object.item.videoItem.movie";

    /**
     * @class upnp
     */
    public $channelName;

    /**
     * @class upnp
     */
    public $scheduledStartTime;

    /**
     * @class upnp
     */
    public $scheduledEndTime;

    /**
     * @class upnp
     */
    public $scheduledDuration;

    /**
     * @class upnp
     */
    public $programTitle;

    /**
     * @class upnp
     */
    public $seriesTitle;

    /**
     * @class upnp
     */
    public $episodeCount;

    /**
     * @class upnp
     */
    public $episodeNumber;

    /**
     * @class upnp
     */
    public $episodeSeason;
}
