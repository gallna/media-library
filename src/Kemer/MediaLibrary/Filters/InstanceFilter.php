<?php
namespace Kemer\MediaLibrary\Filters;

class InstanceFilter extends \FilterIterator
{
    private $accepted;

    public function setAcceptedInstance($accepted)
    {
        $this->accepted = $accepted;
    }

    public function accept()
    {
        $object = $this->getInnerIterator()->current();
        return $object instanceof $this->accepted;
    }
}
