<?php
namespace Kemer\MediaLibrary;

class Container extends Object implements ContainerInterface
{
    // refId
    // childContainerCount
    // childCount
    // totalDeletedChildCount
    // searchable
    // neverPlayable

    /**
     * @class upnp
     */
    public $objectUpdateID;

    /**
     * @class upnp
     */
    public $containerUpdateId;

    /**
     * @class upnp
     */
    public $createClass;

    /**
     * @class upnp
     */
    public $searchClass;
}
