<?php

declare(strict_types=1);

namespace DobryProgramator\DoctrineSafeTypes\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateTimeTzImmutableType;
use Doctrine\DBAL\Types\Exception\InvalidFormat;
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
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?SafeDateTimeImmutable
    {
        if ($value === null || $value instanceof SafeDateTimeImmutable) {
            return $value;
        }

        assert(is_string($value), 'Expected value to be a string or null, got ' . get_debug_type($value));

        try {
            $dateTime = SafeDateTimeImmutable::createFromFormat($platform->getDateTimeTzFormatString(), $value);
        } catch (DatetimeException $e) {
            throw InvalidFormat::new($value, $this->getName(), $platform->getDateTimeTzFormatString());
        }

        return $dateTime;
    }
}
