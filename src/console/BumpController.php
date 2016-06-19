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

use hiqdev\chkipper\history\GitLogParser;
use hiqdev\chkipper\history\MarkdownParser;
use hiqdev\chkipper\history\MarkdownRenderer;
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
        $parser = new MarkdownParser();
        var_dump(Yii::$app->config->historyFile);
        $history = $parser->parsePath(Yii::$app->config->historyFile);
        $gitlog = new GitLogParser();
        $gitlog->parseGitLog();
        $renderer = new MarkdownRenderer();
        echo $renderer->render($gitlog->getHistory());
    }
}
