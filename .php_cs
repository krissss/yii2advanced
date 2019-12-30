<?php
/** @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.12/README.rst */

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/config',
        __DIR__ . '/environments',
    ]);

return PhpCsFixer\Config::create()
    ->setCacheFile(__DIR__ . '/runtime/php_cs.cache')
    ->setRules([
        '@Symfony' => false,
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
        'combine_consecutive_issets' => true, // 合并多个 isset
        'combine_consecutive_unsets' => true, // 合并多个 unset
        'short_scalar_cast' => true, // 将 (boolean) 这种转为 (bool)
        'no_multiline_whitespace_around_double_arrow' => true, // => 不换行
        'single_blank_line_before_namespace' => true, // namespace 前只有一个空行
        'no_trailing_comma_in_singleline_array' => true, // 单行数组最后没有逗号
        //'trailing_comma_in_multiline_array' => true, // 多行数组之后有逗号
        'trim_array_spaces' => true, // 去除数组中无用的空格
        'whitespace_after_comma_in_array' => true, // 数据逗号之后必须有一个空格
        // views 不需要有空行
        //'blank_line_after_opening_tag' => true, // 在 <?php 开头的后面增加一个空行
        'ordered_imports' => true, // use 排序
        'no_unused_imports' => true, // 删除无用的 use
        'lowercase_static_reference' => true, // self,static,parent 必须小写
        'native_function_casing' => true, // 调用php函数使用正确的大小写
        'new_with_braces' => true, // new 出来的对象必须加括号
        'no_singleline_whitespace_before_semicolons' => true, // 分号前没有空行
        'standardize_not_equals' => true, // <> 改为 !=
        'no_empty_comment' => true, // 去除无用的注释
        'no_empty_phpdoc' => true, // 去除无用的注释
        'no_empty_statement' => true, // 去除无用的语句
        'cast_spaces' => ['space' => 'none'], // 强制转换之间不能有空格
        'ternary_operator_spaces' => true, // 三元运算符之间空格
        'space_after_semicolon' => true, // 分号后面的必须有个空格
        'object_operator_without_whitespace' => true, // -> 前后不能有空格
        'concat_space' => ['spacing' => 'one'], // 字符串拼接前后必须空格
        'no_unneeded_control_parentheses' => true, // 去除多余的无用小括号
        'binary_operator_spaces' => ['default' => 'single_space'], // 操作符前后必须是一个空格
    ])
    ->setLineEnding(PHP_EOL) // 使用该方式设置 line_ending 来适应 windows 和 linux
    ->setFinder($finder);
