<?php
namespace Kemer\MediaLibrary\Container;

use Kemer\MediaLibrary\Container;

class EpgContainer extends Container
{
    /** @class upnp */
    public $class = "object.container.epgContainer";

    /** @var upnp */
    public $channelGroupName;

    /** @var upnp */
    public $epgProviderName;

    /** @var upnp */
    public $serviceProvider;

    /** @var upnp */
    public $channelName;

    /** @var upnp */
    public $channelNr;

    /** @var upnp */
    public $channelId;

    /** @var upnp */
    public $radioCallSign;

    /** @var upnp */
    public $radioStationId;

    /** @var upnp */
    public $radioBand;

    /** @var upnp */
    public $callSign;

    /** @var upnp */
    public $networkAffiliation;

    /** @var upnp */
    public $price;

    /** @var upnp */
    public $payPerView;

    /** @var upnp */
    public $icon;

    /** @var upnp */
    public $region;

    /** @var dc */
    public $language;

    /** @var dc */
    public $relation;

    /** @var upnp */
    public $dateTimeRange;

    public function timeRange(\DateTimeInterface $start, \DateTimeInterface $end)
    {
        $this->dateTimeRange = new \DatePeriod($start, $end->diff($start), $end);
        return $this;
    }

    public function getDateTimeRange()
    {
        if (!$this->dateTimeRange || $this->dateTimeRange->getEndDate()) {
            return $this->dateTimeRange;
        }
        $dates = iterator_to_array($this->dateTimeRange);
        $datePeriod = new \DatePeriod(
            $this->dateTimeRange->getStartDate(),
            $this->dateTimeRange->getDateInterval(),
            end($dates)
        );
        return $datePeriod;
    }
}
