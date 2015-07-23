<?php
namespace Kemer\MediaLibrary\Filters;

class MusicFilter extends InstanceFilter
{
    public function __construct(\Iterator $iterator)
    {
        parent::__construct($iterator);
        $this->setAcceptedInstance("Kemer\MediaLibrary\Item\Audio\AudioItemInterface");
    }

}
