<?php
namespace Kemer\MediaLibrary\Traits;

trait GenreTrait
{
    /**
     * A genre description
     * (dc:description)
     *
     * @var string
     */
    private $description;

    /**
     * A genre long description
     * (upnp:longDescription)
     *
     * @var string
     */
    private $longDescription;

    /**
     * Set a genre long description
     *
     * @param string $longDescription
     * @return self FluidInterface
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;
        return $this;
    }

    /**
     * Get a genre long description
     * dc:description)
     *
     * @return string
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }

    /**
     * Set a genre description
     *
     * @param string $description
     * @return self FluidInterface
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get a genre description
     * (upnp:longDescription)
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
