<?php

namespace hiqdev\chkipper\history;

class Commit
{
    protected $_hash;
    protected $_label;
    protected $_comments = [];

    protected $_date;
    protected $_author;
    protected $_subject;

    public function __construct($hash, $label = null, $comments = [])
    {
        $this->_hash = $hash;
        $this->_comments = $comments;
        if ($label) {
            $this->setLabel($label);
        }
    }

    public function setLabel($label)
    {
        $this->_label = $label;
        if (preg_match('/^(\d{4}-\d{2}-\d{2})\s(.*)[\(\[](.*?)[\)\]]$/', $label, $m)) {
            $this->_date    = $m[1];
            $this->_subject = $m[2];
            $this->_author  = $m[3];
        }
    }

    public function addComment($comment)
    {
        $this->_comments[$comment] = $comment;
    }
}
