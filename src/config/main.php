<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

return [
    'id'                    => 'chkipper',
    'name'                  => 'Chkipper',
    'basePath'              => dirname(__DIR__),
    'vendorPath'            => VENDOR_DIR,
    'runtimePath'           => substr(__DIR__, 0, 7) === 'phar://' ? dirname($_SERVER['SCRIPT_NAME']) : dirname(VENDOR_DIR) . '/runtime',
    'enableCoreCommands'    => false,
    'controllerNamespace'   => 'hiqdev\\chkipper\\console',
    'defaultRoute'          => 'bump',
    'bootstrap'             => ['log', 'config'],
    'components'            => [
        'log' => [
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning', 'info'],
                ],
            ],
        ],
        'config' => [
            'class' => \hiqdev\chkipper\components\Config::class,
        ],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'view' => [
            'class' => \yii\base\View::class,
        ],
    ],
    'container' => [
        'singletons' => [
            \hiqdev\chkipper\lib\ConfigInterface::class => function () {
                return Yii::$app->config;
            },
        ],
    ],
];
