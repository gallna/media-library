<?php
namespace Kemer\MediaLibrary\Item;

use Kemer\MediaLibrary\Item as BaseItem;

class EpgItem extends BaseItem
{
    /** @class upnp */
    public $class = "object.item.epgItem";

    /**
     * @class upnp
     */
    public $channelName;

    public $duration;

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
    public $producer;

    /**
     * @class upnp
     */
    public $publisher;

    /**
     * @class dc
     */
    public $relation;

    /** @var upnp */
    public $extendedGenre;

    /** @var upnp */
    public $icon;


    public function getStartTime()
    {
        return new \DateTime($this->scheduledStartTime);
    }

    public function getEndTime()
    {
        return new \DateTime($this->scheduledEndTime);
    }

    public function getDuration()
    {
        return $this->duration > 0
            ? \DateInterval:: createFromDateString($this->duration." minutes")
            : $this->getEndTime()->diff($this->getStartTime());
    }

    public function isUpToDate(\DateTime $now = null)
    {
        $now = $now ?: new \DateTime();
        return $now < $this->getEndTime();
    }

    public function isPlaying(\DateTime $now = null)
    {
        $now = $now ?: new \DateTime();
        return (($now > $this->getStartTime()) && ($now < $this->getEndTime()));
    }

    public function getProgress(\DateTime $now = null)
    {
        $now = $now ?: new \DateTime();
        if ($this->isPlaying($now)) {
            $duration = $this->getDuration();
            $elapsed = $this->getStartTime()->diff($now);
            $elapsedMin = $elapsed->h * 60 + $elapsed->i;
            $durationMin = $duration->h * 60 + $duration->i;
            return round($elapsedMin / $durationMin * 100);
        }
        return 0;
    }

}

// upnp:genre
// upnp:longDescription
// upnp:producer
// upnp:rating
// upnp:actor
// upnp:director
// dc:description
// dc:publisher
// dc:language
// dc:relation
// upnp:storageMedium
// upnp:DVDRegionCode
// upnp:channelName
// upnp:scheduledStartTime
// upnp:scheduledEndTime

// upnp:channelGroupName
// upnp:channelGroupName@id
// upnp:epgProviderName
// upnp:serviceProvider
// upnp:channelName
// upnp:channelNr
// upnp:programTitle
// upnp:seriesTitle
// upnp:programID
// upnp:programID@type
// upnp:seriesID
// upnp:seriesID@type
// upnp:channelID
// upnp:channelID@type
// upnp:channelID
// @distriNetworkName
// upnp:channelID
// @distriNetworkID
// upnp:episodeType
// upnp:episodeCount
// upnp:episodeNumber
// upnp:episodeSeason
// upnp:programCode
// upnp:programCode@type
// upnp:rating
// upnp:rating@type
// upnp:rating@advice
// upnp:rating@equivalentAge
// upnp:recommendationID
// upnp:recommendationID@type
// upnp:genre
// upnp:genre@id
// upnp:genre@extended
// upnp:artist
// upnp:artist@role
// upnp:actor
// upnp:actor@role
// upnp:author
// upnp:author@role
// upnp:producer
// upnp:director
// dc:publisher
