<?php

/*
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\console;

use hiqdev\chkipper\history\GitMerger;
use hiqdev\chkipper\history\Parser;
use Yii;

/**
 * Bump Controller.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class BumpController extends \yii\console\Controller
{
    public function actionIndex()
    {
        $parser = new Parser();
        var_dump(Yii::$app->config->historyFile);
        $history = $parser->parsePath(Yii::$app->config->historyFile);
        $merger = new GitMerger();
        $merger->mergeTo($history);
    }
}
