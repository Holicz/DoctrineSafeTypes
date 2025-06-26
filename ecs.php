<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::SETS, [
        SetList::CLEAN_CODE,
        SetList::COMMON,
        SetList::DEAD_CODE,
        SetList::PSR_12,
        SetList::PHP_70,
        SetList::PHP_71
    ]);
    $parameters->set(Option::PATHS, [__DIR__ . '/src']);
    $parameters->set(Option::SKIP, [
        PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer::class => null,
    ]);
};