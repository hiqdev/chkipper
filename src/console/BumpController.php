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

use Exception;
use hiqdev\chkipper\helpers\File;
use hiqdev\chkipper\lib\changelog\MarkdownRenderer as ChangelogMarkdownRenderer;
use hiqdev\chkipper\lib\modifiers\Normalization;
use hiqdev\chkipper\lib\parsers\GitLogParser;
use hiqdev\chkipper\lib\parsers\MarkdownParser;
use hiqdev\chkipper\lib\renderers\MarkdownRenderer;
use Yii;

/**
 * Bump Controller.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class BumpController extends \yii\console\Controller
{
    public function actionIndex($version = null)
    {
        $config = Yii::$app->config;
        $historyFile = $config->historyFile;
        $changelogFile = $config->changelogFile;
        $parser = Yii::createObject(MarkdownParser::class);
        $history = $parser->parsePath($historyFile);
        $gitlog = Yii::createObject(GitLogParser::class);
        $gitlog->parseGitLog();
        $history->merge($gitlog->getHistory(), true);
        Normalization::create()->run($history);

        if ($version) {
            if ($version === 'dev') {
                $version = $history->lastTag;
            }
            $history->setFirstTag($version);
        }

        $historyRenderer = Yii::createObject(MarkdownRenderer::class);
        $changelogRenderer = Yii::createObject(ChangelogMarkdownRenderer::class);
        File::write($historyFile,  $historyRenderer->render($history));
        File::write($changelogFile,  $changelogRenderer->render($history));
    }

    public function actionParse($path)
    {
        if (!file_exists($path)) {
            throw new Exception('wrong path: ' . $path);
        }
        $parser = new MarkdownParser();
        $history = $parser->parsePath($path);
        var_dump($history->getTags());
    }
}
