<?php
namespace Kemer\MediaLibrary;

/**
 * This is the root class of the entire content directory class hierarchy.
 * It can not be instantiated, in the sense that no XML fragment returned
 * by a Browse() or Search() action can be of class object. The object class
 * defines properties that are common to both atomic media items, as well
 * as logical collections of these items.
 */
interface ObjectInterface
{
    // protected $upnpClass;
    // protected $id;
    // protected $parentId = 0;
    // protected $title;
    // protected $restricted = false;

    /**
     * Method with required properties used to create the root class
     * of the entire content directory class hierarchy.
     *
     * @param  string $id       An identifier for the object
     * @param  string $parentId Id property of object’s parent
     * @param  string $title    Name of the object
     * @param  string $class    UPnP class of the object.
     * @param  bool $restricted Restricted attribute
     *
     * @return ObjectInterface
     */
    //public function create($id, $parentId, $title, $class, $restricted);

    /**
     * An identifier for the object. The value of each object id property
     * must be unique with respect to the Content Directory.
     *
     * @return string
     */
    public function getId();

    /**
     * Id property of object’s parent. The parentID of the Content Directory ‘root’
     * container must be set to the reserved value of “-1”. No other parentID
     * attribute of any other Content Directory object may take this value.
     *
     * @return string
     */
    public function getParentID();

    /**
     * Name of the object
     *
     * @return string
     */
    public function getTitle();

    /**
     * Class of the object.
     *
     * @return string
     */
    public function getClass();

    /**
     * When true, ability to modify a given object is confined to the Content Directory
     * Service. Control point metadata write access is disabled.
     *
     * @return bool
     */
    public function getRestricted();
}
