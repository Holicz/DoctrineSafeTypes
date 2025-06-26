<?php

declare(strict_types=1);

namespace DobryProgramator\DoctrineSafeTypes\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Exception\InvalidFormat;
use Doctrine\DBAL\Types\TimeType;
use Safe\DateTime as SafeDateTime;
use Safe\Exceptions\DatetimeException;

class SafeTimeType extends TimeType
{
    public function getName(): string
    {
        return Types::SAFE_TIME_MUTABLE;
    }

    /**
     * @param mixed $value
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?SafeDateTime
    {
        if ($value === null || $value instanceof SafeDateTime) {
            return $value;
        }

        assert(is_string($value), 'Expected value to be a string or null, got ' . get_debug_type($value));

        try {
            $dateTime = SafeDateTime::createFromFormat('!' . $platform->getTimeFormatString(), $value);
        } catch (DatetimeException $e) {
            throw InvalidFormat::new($value, $this->getName(), $platform->getTimeFormatString());
        }

        return $dateTime;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
