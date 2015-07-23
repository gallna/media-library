<?php
namespace Kemer\MediaLibrary\Filters;

class VideoFilter extends InstanceFilter
{
    public function __construct(\Iterator $iterator)
    {
        parent::__construct($iterator);
        $this->setAcceptedInstance("Kemer\MediaLibrary\Item\Video\VideoItemInterface");
    }

}
