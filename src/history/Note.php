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
 * Note class.
 * Holds note and list of commits.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class Note
{
    protected $_note;
    protected $_commits = [];

    public function __construct($note, $commits = [])
    {
        $this->_note    = $note;
        $this->_commits = $commits;
    }

    public function findCommit($hash)
    {
        if (!isset($this->_commits[$hash])) {
            $this->_commits[$hash] = new Commit($hash);
        }

        return $this->_commits[$hash];
    }

    public function getCommits()
    {
        return $this->_commits;
    }

    public function setNote($value)
    {
        $this->_note = $value;
    }

    public function getNote()
    {
        return $this->_note;
    }
}
