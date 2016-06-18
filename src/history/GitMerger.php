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
        foreach ($log as $hash => $data) {
            if (!$this->getHistory()->hasHash($hash)) {
                $this->getHistory()->findTag($data['tag'], true)->findNote(null, true)
                    ->findCommit($hash)->setDate(
            }
        }
    }

    public function fetchGitLog($reverse = false)
    {
        $reverse = $reverse ? '--reverse' : '';
        exec("git log $reverse --date=short --pretty='format:%h %ad %ae %s |%d'", $logs);
        $res = [];
        foreach ($logs as $log) {
            if (!preg_match('/^(\w+) ([0-9-]+) (\S+) (.*?)\s+\| ?\(?(.*?)\)?$/', $log, $m)) {
                throw new UnexpectedValueException('failed parse git log');
            }
            $res[$m[1]] = [
                'hash'    => $m[1],
                'date'    => $m[2],
                'email'   => $m[3],
                'subject' => $m[4],
                'tag'     => isset($m[5]) ? $this->matchTag($m[5]) : null,
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
