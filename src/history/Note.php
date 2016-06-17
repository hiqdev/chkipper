<?php

namespace hiqdev\chkipper\history;

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
}
