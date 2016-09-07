<?php
namespace Kemer\MediaLibrary\Serializer\Normalizer;

class DateIntervalEnhanced extends \DateInterval
{
    public static function wrap(\DateInterval $interval)
    {
        $enhanced = new static("P2Y4DT6H8M");
        foreach ($interval as $k => $v) {
            $enhanced->$k = $v;
        }
        return $enhanced;
    }

    private function seconds()
    {
        return ($this->y * 365 * 24 * 60 * 60) +
               ($this->m * 30 * 24 * 60 * 60) +
               ($this->d * 24 * 60 * 60) +
               ($this->h * 60 * 60) +
               ($this->i * 60) +
               $this->s;
    }

    const SECONDS = "seconds";
    const MINUTES = "minutes";
    const HOURS = "hours";
    const DAYS = "days";
    const MONTHS = "months";
    const YEARS = "years";

    public function toString($format)
    {
        switch($format) {
            case static::SECONDS:
                return $this->toSeconds();
            case static::MINUTES:
                return $this->toMinutes();
            case static::HOURS:
                return $this->toHours();
            case static::DAYS:
                return $this->toDays();
            case static::MONTHS:
                return $this->toMonths();
            case static::YEARS:
                return $this->toYears();
        }
    }

    public function toSeconds()
    {
        return floor($this->seconds());
    }

    public function toMinutes()
    {
        return floor($this->seconds()/60);
    }

    public function toHours()
    {
        return floor($this->seconds()/60/60);
    }

    public function toDays()
    {
        return floor($this->seconds()/60/60/24);
    }

    public function toMonths()
    {
        return floor($this->seconds()/60/60/24/30);
    }

    public function toYears()
    {
        return floor($this->seconds()/60/60/24/365);
    }


    public function recalculate()
    {
        $seconds = $this->to_seconds();
        $this->y = floor($seconds/60/60/24/365);
        $seconds -= $this->y * 31536000;
        $this->m = floor($seconds/60/60/24/30);
        $seconds -= $this->m * 2592000;
        $this->d = floor($seconds/60/60/24);
        $seconds -= $this->d * 86400;
        $this->h = floor($seconds/60/60);
        $seconds -= $this->h * 3600;
        $this->i = floor($seconds/60);
        $seconds -= $this->i * 60;
        $this->s = $seconds;

    }

}
