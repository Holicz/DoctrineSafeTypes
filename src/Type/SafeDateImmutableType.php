<?php

declare(strict_types=1);

namespace DobryProgramator\DoctrineSafeTypes\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateImmutableType;
use Doctrine\DBAL\Types\Exception\InvalidFormat;
use Safe\DateTimeImmutable as SafeDateTimeImmutable;
use Safe\Exceptions\DatetimeException;

class SafeDateImmutableType extends DateImmutableType
{
    public function getName(): string
    {
        return Types::SAFE_DATE_IMMUTABLE;
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
            $dateTime = SafeDateTimeImmutable::createFromFormat('!' . $platform->getDateFormatString(), $value);
        } catch (DatetimeException $e) {
            throw InvalidFormat::new($value, $this->getName(), $platform->getDateFormatString());
        }

        return $dateTime;
    }
}
