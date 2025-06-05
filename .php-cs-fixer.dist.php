<?php

declare(strict_types=1);

require_once __DIR__ . '/./vendor/autoload.php';

use Ergebnis\PhpCsFixer\Config;

$ruleSet = Config\RuleSet\Php83::create()->withRules(Config\Rules::fromArray([
    'binary_operator_spaces' => [
        'operators' => [
            '=>' => 'align_single_space_minimal',
            '='  => 'align_single_space_minimal',
        ],
    ],
    'phpdoc_to_property_type' => false,
    'multiline_string_to_heredoc' => false,
    'echo_tag_syntax'             => [
        'format' => 'short',
    ],
    'full_opening_tag' => true,
    'strict_comparison' => true,
    'strict_param' => true,
    'single_quote' => [
        'strings_containing_single_quote_chars' => false,
    ],
    'single_trait_insert_per_statement' => true,
    'final_class'                 => false,
    'blank_line_before_statement' => [
        'statements' => [
            'break',
            'case',
            'continue',
            'declare',
            'default',
            'do',
            'for',
            'foreach',
            'goto',
            'if',
            'include',
            'include_once',
            'phpdoc',
            'return',
            'switch',
            'throw',
            'try',
            'while',
            'yield',
            'yield_from',
        ],
    ],
]));
$config = Config\Factory::fromRuleSet($ruleSet);

$config->getFinder()->in(['app', 'config', 'database', 'lang', 'routes', 'tests']);
$config->setCacheFile(__DIR__ . '/./.build/php-cs-fixer/.php-cs-fixer.cache');

return $config;
