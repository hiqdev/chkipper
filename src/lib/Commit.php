<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\lib;

/**
 * Commit class.
 *
 * @property string $hash
 * @property string $label
 * @property array  $comments: comment => comment
 * @property string $date
 * @property string $author
 * @property string $hash
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class Commit
{
    /**
     * @var string 7 characters commit hash
     */
    protected $_hash;

    /**
     * @var string string representation of commit
     */
    protected $_label;
    protected $_comments = [];

    protected $_date;
    protected $_author;
    protected $_subject;

    public function __construct($hash, $label = null, array $comments = [])
    {
        $this->setHash($hash);
        $this->setLabel($label);
        $this->setComments($comments);
    }

    public function set(Commit $commit)
    {
        $this->setHash($commit->hashHash());
        $this->setLabel($commit->getLabel());
        $this->setComments($commit->getComments());
    }

    public function setHash($hash)
    {
        $this->_hash = $hash;
    }

    public function getHash()
    {
        return $this->_hash;
    }

    public function setLabel($label)
    {
        if ($label) {
            $this->_label = $label;
            if (preg_match('/^(\d{4}-\d{2}-\d{2})\s*(.*?)\s*\[(\S*?)\]$/', $label, $m) ||
                preg_match('/^(\d{4}-\d{2}-\d{2})\s*(.*?)\s*\((\S*?)\)$/', $label, $m)) {
                $this->setDate($m[1]);
                $this->setSubject($m[2]);
                $this->setAuthor($m[3]);
            }
        }
    }

    public function getLabel()
    {
        return $this->_subject || $this->_date || $this->_author
            ? $this->getDate() . ' ' . $this->getSubject() . ' [' . $this->getAuthor() . ']'
            : $this->_label;
    }

    public function addComment($comment)
    {
        $this->_comments[$comment] = $comment;
    }

    public function addComments(array $comments)
    {
        foreach ($comments as $comment) {
            $this->addComment($comment);
        }
    }

    public function setComments($comments)
    {
        $this->_comments = [];
        $this->addComments($comments);
    }

    public function getComments()
    {
        return $this->_comments;
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
