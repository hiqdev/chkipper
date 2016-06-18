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
 * Commit class.
 * Holds commit properties:
 * - hash
 * - date
 * - author
 * - subject
 * - list of comments.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
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

    public function getHash()
    {
        return $this->_hash;
    }

    public function getComments()
    {
        return $this->_comments;
    }

    public function setLabel($label)
    {
        $this->_label = $label;
        if (preg_match('/^(\d{4}-\d{2}-\d{2})\s*(.*?)\s*[\(\[](.*?)[\)\]]$/', $label, $m)) {
            $this->setDate($m[1]);
            $this->setSubject($m[2]);
            $this->setAuthor($m[3]);
        }
    }

    public function getLabel()
    {
        return $this->_subject || $this->_date || $this->_author
            ? $this->getDate() . ' ' . $this->getSubject() . ' [' . $this->getAuthor() . ']'
            : $this->_label
        ;
    }

    public function addComment($comment)
    {
        $this->_comments[$comment] = $comment;
    }

    public function setDate($value)
    {
        $timestamp = strtotime($value);
        if ($timestamp !== false) {
            $this->_date = $timestamp;
        }
        return $this;
    }

    public function getDate()
    {
        return $this->_date ? date('Y-m-d', $this->_date) : null;
    }

    public function setSubject($value)
    {
        $this->_subject = $value;
        return $this;
    }

    public function getSubject()
    {
        return $this->_subject;
    }

    public function setAuthor($value)
    {
        $this->_author = $value;
        return $this;
    }

    public function getAuthor()
    {
        return $this->_author;
    }
}
