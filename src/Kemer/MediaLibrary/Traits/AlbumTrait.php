<?php
namespace Kemer\MediaLibrary\Traits;

trait AlbumTrait
{

    /**
     * Set storageMedium
     * (upnp:storageMedium)
     *
     * @param string $storageMedium
     */
    public function setStorageMedium($storageMedium)
    {
        $this->storageMedium = $storageMedium;
        return $this;
    }

    /**
     * Get storageMedium
     *
     * @return string
     */
    public function getStorageMedium()
    {
        return $this->storageMedium;
    }

    /**
     * Set longDescription
     * (dc:longDescription)
     *
     * @param string $longDescription
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;
        return $this;
    }

    /**
     * Get longDescription
     *
     * @return string
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }

    /**
     * Set description
     * (dc:description)
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set publisher
     * (dc:publisher)
     *
     * @param string $publisher
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
        return $this;
    }

    /**
     * Get publisher
     *
     * @return string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Set contributor
     * (dc:contributor)
     *
     * @param string $contributor
     */
    public function setContributor($contributor)
    {
        $this->contributor = $contributor;
        return $this;
    }

    /**
     * Get contributor
     *
     * @return string
     */
    public function getContributor()
    {
        return $this->contributor;
    }

    /**
     * Set date
     * (dc:date)
     *
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set relation
     * (dc:relation)
     *
     * @param string $relation
     */
    public function setRelation($relation)
    {
        $this->relation = $relation;
        return $this;
    }

    /**
     * Get relation
     *
     * @return string
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * Set rights
     * (dc:rights)
     *
     * @param string $rights
     */
    public function setRights($rights)
    {
        $this->rights = $rights;
        return $this;
    }

    /**
     * Get rights
     *
     * @return string
     */
    public function getRights()
    {
        return $this->rights;
    }
}
