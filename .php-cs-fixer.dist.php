<?php
$finder = PhpCsFixer\Finder::create()
    ->in([
    __DIR__ . '/src',
    __DIR__ . '/tests',
    ])
;

$config = new PhpCsFixer\Config();
return $config->setRules([
            '@PSR12' => true,
            'strict_param' => true,
            'array_syntax' => ['syntax' => 'short'],
            'no_alternative_syntax' => true,
            'strict_comparison' => true,
            'declare_strict_types' => true,
            'yoda_style' => false,
            'fully_qualified_strict_types' => true,
            'ordered_imports' => ['sort_algorithm' => 'length'],
        ])
        ->setRiskyAllowed(true)
        ->setFinder($finder)
;
