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

use Exception;
use Yii;

/**
 * Convert Controller.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class ConvertController extends \yii\console\Controller
{
    public function actionIndex()
    {
        $commitsFile = '.hidev/commits.md';
        $historyFile = Yii::$app->config->historyFile;

        if (!file_exists($commitsFile)) {
            throw new Exception("no $commitsFile found");
        }

        $history = '';
        $commits = file($commitsFile);
        foreach ($commits as $line) {
            if (preg_match('/^## (\S+) (\S+)$/', $line, $m)) {
                $history .= "## [$m[1]] - $m[2]\n";

            # - ebeece6 2016-06-10 ommit message (sol@hiqdev.com)
            } elseif (preg_match('/^    - (\S{7}) (\S+) (.*?) \((\S+)\)$/', $line, $m)) {
                $history .= "    - [$m[1]] $m[2] $m[3] [$m[4]]\n";
            } else {
                $history .= $line;
            }
        }

        file_put_contents($historyFile,  $history);
    }
}
