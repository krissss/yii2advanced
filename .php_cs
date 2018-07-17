<?php
/** @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.12/README.rst */

$finder = PhpCsFixer\Finder::create()
    ->exclude([
        'views' // views 下的注释和 header_comment 冲突，所以先跳过
    ])
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/config',
    ]);

return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony' => false,
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
        'combine_consecutive_issets' => true, // 合并多个 isset
        'combine_consecutive_unsets' => true, // 合并多个 unset
        // 顶部注释
        'header_comment' => [
            'comment_type' => 'PHPDoc',
            'header' => '', // 不添加则为空
            'location' => 'after_open',
            'separate' => 'none',
        ],
        'short_scalar_cast' => true, // 将 (boolean) 这种转为 (bool)
        'single_blank_line_before_namespace' => true, // namespace 前只有一个空行
        'no_trailing_comma_in_singleline_array' => true, // 单行数组最后没有逗号
        'trailing_comma_in_multiline_array' => true, // 多行数组之后有逗号
        'blank_line_after_opening_tag' => true, // 在 <?php 开头的后面增加一个空行
        'ordered_imports' => true, // use 排序
        'no_unused_imports' => true, // 删除无用的 use
    ])
    ->setFinder($finder);
