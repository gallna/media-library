<?php
namespace Kemer\MediaLibrary\Item\EpgItem;

use Kemer\MediaLibrary\Item\EpgItem as BaseEpgItem;

class VideoProgram extends BaseEpgItem
{
    /** @class upnp */
    public $class = "object.item.epgItem.videoProgram";

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


    /**
     * A language
     * (dc:language)
     *
     * @var string
     */
    public $language;

    /**
     * A genre
     * (upnp:genre)
     *
     * @var string
     */
    public $genre;

    /**
     * A genre description
     * (dc:description)
     *
     * @var string
     */
    public $description;

    /**
     * A genre long description
     * (upnp:longDescription)
     *
     * @var string
     */
    public $longDescription;

    /**
     * @class upnp
     */
    public $actor = [];

    /**
     * @class upnp
     */
    public $director;

    /**
     * @class upnp
     */
    public $publisher;

    /**
     * @class dc
     */
    public $relation;

}
