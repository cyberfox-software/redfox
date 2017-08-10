<?php

return PhpCsFixer\Config::create()
  ->setFinder(
    PhpCsFixer\Finder::create()
      ->in(__DIR__ . '/packages')
      ->in(__DIR__ . '/tests/unit')
  )
  ->setRiskyAllowed(true)
  ->setRules([
    '@PSR1' => true,
    '@PSR2' => true,
    '@Symfony' => true,
    'psr4' => true,
    'array_syntax' => ['syntax' => 'short'],
    'combine_consecutive_unsets' => true,
    'no_useless_else' => true,
    'no_useless_return' => true,
    'ordered_imports' => ['sortAlgorithm' => 'length'],
    'phpdoc_indent' => false,
    'phpdoc_annotation_without_dot' => false,
    'phpdoc_no_empty_return' => false,
    'concat_space' => [
      'spacing' => 'one',
    ],
  ]);
