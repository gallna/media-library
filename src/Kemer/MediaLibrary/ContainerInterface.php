<?php
namespace Kemer\MediaLibrary;

/**
 * This is a derived class of object used to represent “atomic” content objects,
 * i.e., object that don’t contain other objects, for example, a music track on
 * an audio CD. The XML expression of any instance of a class that is derived from
 * item is the <item> tag.
 */
interface ContainerInterface extends ObjectInterface
{
    const UPNP_CLASS = "object.container";

    /**
     * Set child count for the object.
     *
     * @param integer $childCount
     */
    //public function setChildCount($childCount);

    /**
     * Child count for the object. Applies to containers only.
     *
     * @return integer
     */
    //public function getChildCount();

    /**
     * Set create class of the associated container object.
     *
     * @param string $createClass
     */
    //public function setCreateClass($createClass);

    /**
     * Create class of the associated container object.
     *
     * @return string
     */
    //public function getCreateClass();

    /**
     * Set search class of the associated container object.
     *
     * @param string $searchClass
     */
    //public function setSearchClass($searchClass);

    /**
     * Search class of the associated container object.
     *
     * @return string
     */
    //public function getSearchClass();

    /**
     * Set searchable attribute
     *
     * @param bool $searchable
     */
    //public function setSearchable($searchable);

    /**
     * When true, the ability to perform a Search() action under a container is enabled,
     * otherwise a Search() under that container will return no results. The default
     * value of this attribute when it is absent on a container is false
     *
     * @return bool
     */
    //public function getSearchable();
}
