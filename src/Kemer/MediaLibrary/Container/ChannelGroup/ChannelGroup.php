<?php
namespace Kemer\MediaLibrary\Container\ChannelGroup;

use Kemer\MediaLibrary\Container;
use Kemer\MediaLibrary\UpnpElement;

class ChannelGroup extends Container implements ChannelGroupInterface
{
    /**
     * ChannelGroup constructor
     *
     * @param string $id
     * @param string $title
     * @param string $upnpClass
     */
    public function __construct($id, $title, $upnpClass = "object.container.channelGroup")
    {
        parent::__construct($id, $title, $upnpClass);
    }

    /**
     * {@inheritDoc}
     */
    public function setServiceProvider($serviceProvider)
    {
        $this->serviceProvider = $serviceProvider;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceProvider()
    {
        return $this->serviceProvider;
    }

    /**
     * {@inheritDoc}
     */
    public function setEpgProviderName($epgProviderName)
    {
        $this->epgProviderName = $epgProviderName;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getEpgProviderName()
    {
        return $this->epgProviderName;
    }
}
