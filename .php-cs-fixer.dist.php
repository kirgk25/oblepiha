<?php

declare(strict_types=1);

$finder = new PhpCsFixer\Finder()
    ->in(__DIR__ . '/app')
    ->in(__DIR__ . '/database')
    ->in(__DIR__ . '/routes')
    ->in(__DIR__ . '/tests');

return new PhpCsFixer\Config()
    ->setRiskyAllowed(true)
    ->setRules([
        '@PER-CS' => true,
        '@PHP84Migration' => true,
        'declare_strict_types' => true,
    ])
    ->setFinder($finder);
