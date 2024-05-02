<?php

declare(strict_types=1);

namespace DobryProgramator\DoctrineSafeTypes\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\Exception\InvalidFormat;
use Safe\DateTime as SafeDateTime;
use Safe\Exceptions\DatetimeException;

class SafeDateTimeType extends DateTimeType
{
    public function getName(): string
    {
        return Types::SAFE_DATETIME_MUTABLE;
    }

    /**
     * @param mixed $value
     *
     * @throws InvalidFormat
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?SafeDateTime
    {
        if ($value === null || $value instanceof SafeDateTime) {
            return $value;
        }

        try {
            $dateTime = SafeDateTime::createFromFormat($platform->getDateTimeFormatString(), $value);
        } catch (DatetimeException $e) {
            throw new InvalidFormat(
                $value,
                $this->getName(),
                $platform->getDateTimeFormatString()
            );
        }

        return $dateTime;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
