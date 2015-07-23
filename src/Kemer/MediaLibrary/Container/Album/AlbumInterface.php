<?php
namespace Kemer\MediaLibrary\Container\Album;

use Kemer\MediaLibrary\ContainerInterface;

/**
 * An ‘album’ instance represents an ordered collection of ‘objects’. It may have a <res> element for
 * playback of the whole album, or not. In the first case, rendering the album has the semantics of rendering
 * each object in sequence. In the latter case, a control point needs to separately initiate rendering for each
 * child object.
 */
interface AlbumInterface extends ContainerInterface
{
    /**
     * Get storageMedium
     * (upnp:storageMedium)
     *
     * @return string
     */
    public function getStorageMedium();

    /**
     * Set storageMedium
     *
     * @param string $storageMedium
     */
    public function setStorageMedium($storageMedium);

    /**
     * Get longDescription
     * (dc:longDescription)
     *
     * @return string
     */
    public function getLongDescription();

    /**
     * Set longDescription
     *
     * @param string $storageMedium
     */
    public function sLongDescription($longDescription);

    /**
     * Get description
     * (dc:description)
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set description
     *
     * @param string $storageMedium
     */
    public function sDescription($description);

    /**
     * Get publisher
     * (dc:publisher)
     *
     * @return string
     */
    public function getPublisher();

    /**
     * Set publisher
     *
     * @param string $storageMedium
     */
    public function sPublisher($publisher);

    /**
     * Get contributor
     * (dc:contributor)
     *
     * @return string
     */
    public function getContributor();

    /**
     * Set contributor
     *
     * @param string $storageMedium
     */
    public function sContributor($contributor);

    /**
     * Get date
     * (dc:date)
     *
     * @return string
     */
    public function getDate();

    /**
     * Set date
     *
     * @param string $storageMedium
     */
    public function sDate($date);

    /**
     * Get relation
     * (dc:relation)
     *
     * @return string
     */
    public function getRelation();

    /**
     * Set relation
     *
     * @param string $storageMedium
     */
    public function sRelation($relation);

    /**
     * Get rights
     * (dc:rights)
     *
     * @return string
     */
    public function getRights();

    /**
     * Set rights
     *
     * @param string $storageMedium
     */
    public function sRights($rights);
}
