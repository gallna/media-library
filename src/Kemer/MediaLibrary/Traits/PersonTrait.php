<?php
namespace Kemer\MediaLibrary\Traits;

use Kemer\MediaLibrary\DcElement;

trait PersonTrait
{
        /**
     * A language
     * (dc:language)
     *
     * @var string
     */
    private $language;

    /**
     * Set a person language
     *
     * @param string $language
     * @return self FluidInterface
     */
    public function setLanguage($language)
    {
        $this->language = new DcElement("language", $language);
        return $this;
    }

    /**
     * Get a person language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
