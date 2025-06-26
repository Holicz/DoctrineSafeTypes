<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths([__DIR__ . '/src'])
    ->withPreparedSets(
        common: true,
        symplify: true,
        strict: true,
        cleanCode: true,
    )
    ->withSkip(
        [
            NoSuperfluousPhpdocTagsFixer::class => null,
        ]
    )
;
