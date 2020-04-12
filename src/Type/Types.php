<?php

declare(strict_types=1);

namespace DobryProgramator\DoctrineSafeTypes\Type;

use Doctrine\DBAL\Types\Types as DoctrineTypes;

class Types
{
    public const SAFE_DATE_MUTABLE = self::SAFE . DoctrineTypes::DATE_MUTABLE;

    public const SAFE_DATE_IMMUTABLE = self::SAFE . DoctrineTypes::DATE_IMMUTABLE;

    public const SAFE_DATETIME_MUTABLE = self::SAFE . DoctrineTypes::DATETIME_MUTABLE;

    public const SAFE_DATETIME_IMMUTABLE = self::SAFE . DoctrineTypes::DATETIME_IMMUTABLE;

    public const SAFE_DATETIMETZ_MUTABLE = self::SAFE . DoctrineTypes::DATETIMETZ_MUTABLE;

    public const SAFE_DATETIMETZ_IMMUTABLE = self::SAFE . DoctrineTypes::DATETIMETZ_IMMUTABLE;

    public const SAFE_TIME_MUTABLE = self::SAFE . DoctrineTypes::TIME_MUTABLE;

    public const SAFE_TIME_IMMUTABLE = self::SAFE . DoctrineTypes::TIME_IMMUTABLE;

    private const SAFE = 'safe_';
}
