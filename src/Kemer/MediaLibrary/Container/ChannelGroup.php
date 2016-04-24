<?php
namespace Kemer\MediaLibrary\Container;

use Kemer\MediaLibrary\Container;
use Kemer\MediaLibrary\UpnpElement;

class ChannelGroup extends Container implements ChannelGroupInterface
{
    /** @class upnp */
    public $class = "object.container.channelGroup";

    /**
     * @class upnp
     */
    public $channelGroupName;

    /**
     * @class upnp
     */
    public $channelGroupId;

    /**
     * @class upnp
     */
    public $epgProviderName;

    /**
     * @class upnp
     */
    public $serviceProvider;

    /**
     * @class upnp
     */
    public $icon;

    /**
     * @class upnp
     */
    public $region;
}
