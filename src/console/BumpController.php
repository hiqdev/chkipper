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
use hiqdev\chkipper\changelog\MarkdownRenderer as ChangelogMarkdownRenderer;
use Exception;
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
        $historyFile = Yii::$app->config->historyFile;
        $changelogFile = Yii::$app->config->changelogFile;
        $parser = new MarkdownParser();
        $history = $parser->parsePath($historyFile);
        $gitlog = new GitLogParser();
        $gitlog->parseGitLog();
        $history->merge($gitlog->getHistory());
        $history->normalize();

        if ($version) {
            $history->setFirstTag($version);
        }

        $historyRenderer = new MarkdownRenderer();
        $changelogRenderer = new ChangelogMarkdownRenderer();
        file_put_contents($historyFile,  $historyRenderer->render($history));
        file_put_contents($changelogFile,  $changelogRenderer->render($history));
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
