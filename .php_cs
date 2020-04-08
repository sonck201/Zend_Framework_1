<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__);

return PhpCsFixer\Config::create()
    ->setRules([
        //'@PhpCsFixer' => true,
        '@PSR2' => true,
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
        'array_indentation' => true,
        'braces' => true,
        'concat_space' => ['spacing' => 'one'],
        'increment_style' => true,
        'no_superfluous_phpdoc_tags' => false,
        'no_trailing_whitespace_in_comment' => true,
        'phpdoc_add_missing_param_annotation' => true,
        'phpdoc_align' => ['align' => 'left', 'tags' => ['param', 'property', 'property-read', 'property-write', 'return', 'throws', 'type', 'var', 'method']],
        'phpdoc_annotation_without_dot' => false,
        'phpdoc_indent' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_var_annotation_correct_order' => true,
        'ordered_imports' => ['sortAlgorithm' => 'alpha'],
        'yoda_style' => false,
    ])
    ->setFinder($finder);
