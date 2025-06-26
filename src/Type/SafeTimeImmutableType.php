<?php

declare(strict_types=1);

namespace DobryProgramator\DoctrineSafeTypes\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Exception\InvalidFormat;
use Doctrine\DBAL\Types\TimeImmutableType;
use Safe\DateTimeImmutable as SafeDateTimeImmutable;
use Safe\Exceptions\DatetimeException;

class SafeTimeImmutableType extends TimeImmutableType
{
    public function getName(): string
    {
        return Types::SAFE_TIME_IMMUTABLE;
    }

    /**
     * @param mixed $value
     *
     * @throws InvalidFormat
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?SafeDateTimeImmutable
    {
        if ($value === null || $value instanceof SafeDateTimeImmutable) {
            return $value;
        }

        try {
            $dateTime = SafeDateTimeImmutable::createFromFormat('!' . $platform->getTimeFormatString(), $value);
        } catch (DatetimeException $e) {
            throw new InvalidFormat(
                $value,
                $this->getName(),
                $platform->getTimeFormatString()
            );
        }

        return $dateTime;
    }
}
