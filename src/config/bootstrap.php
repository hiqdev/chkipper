<?php

if (!defined('VENDOR_DIR')) {
    foreach ([dirname(dirname(__DIR__)) . '/vendor', dirname(dirname(dirname(dirname(__DIR__))))] as $dir) {
        if (file_exists($dir . '/autoload.php')) {
            define('VENDOR_DIR', $dir);
            break;
        }
    }

    if (!defined('VENDOR_DIR')) {
        fwrite(STDERR, "Run composer to set up chkipper dependencies!\n");
        exit(1);
    }

    require VENDOR_DIR . '/autoload.php';
    require VENDOR_DIR . '/yiisoft/yii2/Yii.php';

    Yii::setAlias('@hiqdev/chkipper', dirname(__DIR__));
}
