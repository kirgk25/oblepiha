<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__ . '/app')
    ->in(__DIR__ . '/database')
    ->in(__DIR__ . '/routes')
    ->in(__DIR__ . '/tests');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PER-CS' => true,
        '@PHP84Migration' => true,
    ])
    ->setFinder($finder);