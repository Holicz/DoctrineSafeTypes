<?php

declare(strict_types=1);

namespace DobryProgramator\DoctrineSafeTypes\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\DateTimeTzImmutableType;
use Safe\DateTimeImmutable as SafeDateTimeImmutable;
use Safe\Exceptions\DatetimeException;

class SafeDateTimeTzImmutableType extends DateTimeTzImmutableType
{
    public function getName(): string
    {
        return Types::SAFE_DATETIMETZ_IMMUTABLE;
    }

    /**
     * @param mixed $value
     *
     * @throws ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?SafeDateTimeImmutable
    {
        if ($value === null || $value instanceof SafeDateTimeImmutable) {
            return $value;
        }

        try {
            $dateTime = SafeDateTimeImmutable::createFromFormat($platform->getDateTimeTzFormatString(), $value);
        } catch (DatetimeException $e) {
            throw ConversionException::conversionFailedFormat(
                $value,
                $this->getName(),
                $platform->getDateTimeTzFormatString()
            );
        }

        return $dateTime;
    }
}
