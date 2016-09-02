<?php
namespace Kemer\MediaLibrary\Generator;

use Kemer\MediaLibrary\ObjectInterface;

class ScheduleGenerator
{
    protected $objects = [];

    /**
     * Schedule generator constructor. Creates schedule sequence for selected objects
     *
     * @param array|Traversable $objects
     */
    public function __construct($objects = [])
    {
        if (!is_array($objects) && !($objects instanceof \Traversable)) {
            throw new \InvalidArgumentException(
                sprintf("Expects an array or Traversable object, '%s' has given", getType($object))
            );
        }
        foreach ($objects as $object) {
            $this->add($object);
        }
    }

    /**
     * Add object to sequence
     *
     * @param ObjectInterface $object
     */
    public function add(ObjectInterface $object)
    {
        if (!is_integer($object->getScheduledDuration())) {
            throw new \DomainException(
                sprintf(
                    "Missing scheduled duration in '%s' Can't accept object without duration",
                    get_class($object)
                )
            );
        }
        $this->objects[] = $object;
    }

    /**
     * Generate schedule for selected objects
     *
     * @param \DateTime|null $scheduledStartTime
     * @return Generator
     */
    public function generate(\DateTime $startTime = null)
    {
        if (!$startTime) {
            $startTime = new \DateTimeImmutable();
            $startTime = $startTime->setTime(
                $startTime->format("H"),
                ceil($startTime->format("i") / 5) * 5
            );
        }
        if (!$startTime instanceof \DateTimeImmutable) {
            $startTime = \DateTimeImmutable::createFromMutable($startTime);
        }

        foreach ($this->objects as $object) {
            $duration = \DateInterval:: createFromDateString(
                (ceil($object->getScheduledDuration() / 5) * 5)." minutes"
            );
            $endTime = $startTime->add($duration);
            $object->setSheduledStartTime($startTime->format(\DateTime::RFC3339));
            $object->setSheduledEndTime($endTime->format(\DateTime::RFC3339));
            $object->scheduledStartTime = $startTime->format(\DateTime::RFC3339);
            $object->scheduledEndTime = $endTime->format(\DateTime::RFC3339);
            // var_dump([$startTime->format('m-d H:i'), (ceil($object->getScheduledDuration() / 5) * 5)." minutes", $endTime->format('m-d H:i')]);
            $startTime = $endTime;
        }
    }
}
