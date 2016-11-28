<?php

/*
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\helpers;

use yii\helpers\Console;

/**
 * File helper class.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class File
{
    public static function write($path, $content)
    {
        if (file_exists($path)) {
            $old = file_get_contents($path);
            if ($old === $content) {
                return;
            }
        }
        file_put_contents($path, $content);
        Console::stdout(Console::ansiFormat("written file: $path\n", [Console::FG_YELLOW]));
    }
}
