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

/**
 * Abstract history renderer.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
abstract class AbstractRenderer
{
    public function setHistory($value)
    {
        $this->_history = $value;
        $this->prepareLinks();
    }

    public function getHistory()
    {
        return $this->_history;
    }

    /**
     * Renders history to string.
     * @param History $history
     * @return text
     */
    abstract public function render(History $history);

    public static function skipCommit(Commit $commit)
    {
        $comment = $commit['comment'];

        static $equals = [
            ''      => 1,
            'minor' => 1,
        ];
        if ($equals[$comment]) {
            return true;
        }

        static $starts = [
            'version bump',
            'bumped version',
            "merge branch 'master'",
        ];
        foreach ($starts as $start) {
            if (strtolower(substr($comment, 0, strlen($start))) === $start) {
                return true;
            }
        }

        return false;
    }

    public function prepareLinks()
    {
        $history = $this->getHistory();
        foreach ($history->getHashes() as $hash) {
            if (!$history->hasLink($hash)) {
                $history->addLink($hash, $this->generateHashHref($hash));
            }
        }
    }

    public function generateHashHref($hash)
    {
        return 'https://github.com/hiqdev/chkipper/commit/' . $hash;
    }
}
