<?php
namespace Kemer\MediaLibrary\Container\ChannelGroup;

use Kemer\MediaLibrary\ContainerInterface;

/**
 * A channelGroup container groups together a set of items that correspond to individual but
 * related broadcast channels. For example, all preset channels for a particular tuner can be
 * grouped together in a channelGroup container. A device that has multiple tuners can provide
 * multiple channelGroup containers, one for each tuner. Alternatively, the device can choose to
 * expose all tuners using just a single channelGroup container. This is especially useful when
 * the tuners have equivalent capabilities. Moreover, a device with a single tuner can provide
 * multiple channelGroup containers, each exposing only a subset of the available channels (for
 * example, a set-top-box that contains a single tuner but supports three different input
 * connections: terrestrial, cable, and satellite). For UI purposes, control points have the
 * freedom to expose channelGroup containers separately, or blend the contents of multiple
 * channelGroup containers together in a single view. A channelGroup container can only
 * contain objects of class "object.item.videoItem.videoBroadcast"
 * or "object.item.videoItem.audioBroadcast".
 */
interface ChannelGroupInterface extends ContainerInterface
{

    # upnp:channelGroupName
    # upnp:channelGroupName@id
    # upnp:epgProviderName
    # upnp:serviceProvider
    # upnp:icon
    # upnp:region

    /**
     * The upnp:serviceProvider property contains the friendly name of the service
     * provider of this content. This is typically used for live content or recorded
     * content. Note that one service provider can provide multiple channel groups.
     *
     * @param string $serviceProvider
     */
    public function setServiceProvider($serviceProvider);

    /**
     * Get a service provider
     *
     * @return string
     */
    public function getServiceProvider();

    /**
     * The upnp:epgProviderName property indicates the name of the Electronic
     * Program Guide service provider
     *
     * @param string $epgProviderName
     * @return $this
     */
    public function setEpgProviderName($epgProviderName);

    /**
     * Get a epg provider name
     *
     * @return string
     */
    public function getEpgProviderName();
}
