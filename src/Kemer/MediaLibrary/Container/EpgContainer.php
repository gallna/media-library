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
    public $channelID;

    /** @var upnp */
    public $radioCallSign;

    /** @var upnp */
    public $radioStationID;

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

}
