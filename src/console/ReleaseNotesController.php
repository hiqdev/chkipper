<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\console;

use hiqdev\chkipper\lib\changelog\ReleaseNotesRenderer;
use hiqdev\chkipper\lib\parsers\MarkdownParser;
use Yii;

/**
 * Release Notes Controller.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class ReleaseNotesController extends \yii\console\Controller
{
    public function actionIndex()
    {
        $parser = Yii::createObject(MarkdownParser::class);
        $history = $parser->parsePath(Yii::$app->config->historyFile);
        $renderer = Yii::createObject(ReleaseNotesRenderer::class);
        echo $renderer->render($history);
    }
}
