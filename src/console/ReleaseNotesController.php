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

use hiqdev\chkipper\history\MarkdownParser;
use hiqdev\chkipper\changelog\NotesRenderer;
use Yii;

/**
 * Relese Notes Controller.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class ReleaseNotesController extends \yii\console\Controller
{
    public function actionIndex()
    {
        $parser = new MarkdownParser();
        $history = $parser->parsePath(Yii::$app->config->historyFile);
        $renderer = new NotesRenderer();
        echo $renderer->render($history);
    }
}
