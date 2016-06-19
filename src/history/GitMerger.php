<?php

/*
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\history;

use UnexpectedValueException;

/**
 * Git merger.
 * Merges git log into History.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class GitMerger extends Builder
{
    public function mergeTo($history)
    {
        $this->setHistory($history);
        $this->mergeGitLog();
    }

    public function mergeGitLog()
    {
        $log = $this->fetchGitLog();
        var_dump($log);
        die();
        foreach ($log as $hash => $data) {
            $this->getHistory()->addCommit($data['tag'], null, $data['commit'], true);
        }
    }

    public function fetchGitLog($reverse = false)
    {
        exec("git log --date=short --pretty='format:%h %ad %s [%ae] %d'", $logs);
        $res = [];
        $tag = '';
        foreach ($logs as $log) {
            if (!preg_match('/^(\w+) ([0-9-]+ .*? \[.*?\]) *\(?(.*?)\)?$/', $log, $m)) {
                throw new UnexpectedValueException('failed parse git log');
            }
            $tag = $this->matchTag($m[3]) ?: $tag;
            $res[$m[1]] = [
                'tag'    => isset($m[3]) ? $this->matchTag($m[3]) : null,
                'commit' => new Commit($m[1], $m[2]),
            ];
        }

        return $res;
    }

    /**
     * Finds first tag in given refs string.
     * @param string $str 
     * @return string
     */
    public function matchTag($str)
    {
        $refs = explode(', ', $str);
        foreach ($refs as $ref) {
            if (preg_match('/^tag: (.*)$/', $ref, $m)) {
                return $m[1];
            }
        }

        return null;
    }
}
