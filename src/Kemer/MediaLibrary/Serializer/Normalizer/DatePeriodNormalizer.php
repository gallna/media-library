<?php
namespace Kemer\MediaLibrary\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class DatePeriodNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws InvalidArgumentException
     */
    public function normalize($object, $format = null, array $context = array())
    {
        if (!$object instanceof \DatePeriod) {
            throw new \InvalidArgumentException('The object must be a "\DatePeriod".');
        }
        $interval = $object->getDateInterval() ?: $object->getEndDate()->diff($object->getStartDate());
        return $iso = sprintf("R%s/%s/%s",
            iterator_count($object),
            $object->getStartDate()->format('Y-m-d\TH:i:s\Z'),
            $interval->format('PT%hH%iM%sS')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof \DatePeriod;
    }

    /**
     * {@inheritdoc}
     *
     * @throws UnexpectedValueException
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        try {
            return new \DatePeriod($data);
        } catch (\Exception $e) {
            throw new \UnexpectedValueException(
                "Only ISO 8601 specification supported for DatePeriod", null, $e
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        $supportedTypes = array(
            \DatePeriod::class => true,
        );

        return isset($supportedTypes[$type]);
    }
}
