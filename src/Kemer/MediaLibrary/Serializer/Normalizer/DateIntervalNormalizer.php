<?php
namespace Kemer\MediaLibrary\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class DateIntervalNormalizer implements NormalizerInterface, DenormalizerInterface
{
    const FORMAT_KEY = 'dateinterval_format';
    const SECONDS = DateIntervalEnhanced::SECONDS;
    const MINUTES = DateIntervalEnhanced::MINUTES;
    const HOURS = DateIntervalEnhanced::HOURS;
    const DAYS = DateIntervalEnhanced::DAYS;
    const MONTHS = DateIntervalEnhanced::MONTHS;
    const YEARS = DateIntervalEnhanced::YEARS;

    /**
     * @var string
     */
    private $format;

    /**
     * @param string $format
     */
    public function __construct($format = DateIntervalEnhanced::SECONDS)
    {
        $this->format = $format;
    }

    /**
     * {@inheritdoc}
     *
     * @throws InvalidArgumentException
     */
    public function normalize($object, $format = null, array $context = array())
    {
        if (!$object instanceof \DateInterval) {
            throw new \InvalidArgumentException('The object must be a "\DateInterval".');
        }

        $format = isset($context[self::FORMAT_KEY]) ? $context[self::FORMAT_KEY] : $this->format;
        if (!$object instanceof \DateIntervalEnhanced) {
            $enhanced = DateIntervalEnhanced::wrap($object);
            return $enhanced->toString($format);
        }
        return $object->toString($format);
        return $object->format($format);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof \DateInterval;
    }

    /**
     * {@inheritdoc}
     *
     * @throws UnexpectedValueException
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        try {
            return \DateIntervalEnhanced::createFromDateString($data);
        } catch (\Exception $e) {
            throw new \UnexpectedValueException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        $supportedTypes = array(
            \DateInterval::class => true,
        );

        return isset($supportedTypes[$type]);
    }
}
