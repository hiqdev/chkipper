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
        $this->normalizeHistory();
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

    public function normalizeHistory()
    {
        $this->getHistory()->normalize();
        $this->addCommitLinks();
        $this->removeCommitLinks();
    }

    public function addCommitLinks()
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
        $project = $this->getHistory()->getProject();

        return "https://github.com/$project/commit/$hash";
    }

    /**
     * Removes commit links that are not in the history.
     */
    public function removeCommitLinks()
    {
        $history = $this->getHistory();
        foreach ($history->getLinks() as $link => $href) {
            if (preg_match('/^[0-9a-f]{7}$/', $link) && !$history->hasHash($link)) {
                $history->removeLink($link);
            }
        }
    }
}
