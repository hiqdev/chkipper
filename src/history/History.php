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
 * History class.
 * Holds history of commits.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class History
{
    public $lastTag = 'Under development';

    public $initTag = 'Development started';

    protected $_headers = [];
    protected $_hashes  = [];
    protected $_links   = [];
    protected $_tags    = [];

    public function addHeader($str)
    {
        $this->_headers[$str] = $str;
    }

    public function addHeaders(array $value)
    {
        foreach ($value as $header) {
            $this->addHeader($header);
        }
    }

    public function setHeaders(array $value)
    {
        $this->_headers = [];
        $this->addHeaders($value);
    }

    public function getHeaders()
    {
        return $this->_headers;
    }

    public function addLink($link, $href)
    {
        $this->_links[$link] = $href;
    }

    public function setLinks($value)
    {
        $this->_links = $value;
    }

    public function getLinks()
    {
        return $this->_links;
    }

    public function getFirstTag()
    {
        return reset($this->_tags);
    }

    public function getTags()
    {
        return $this->_tags;
    }

    public function setTags(array $value)
    {
        $this->_tags = $value;
    }

    /**
     * Returns tag by name.
     * Creates if not exists.
     * Returns first tag when given empty name.
     * @param string $tag name
     * @return Tag
     */
    public function findTag($tag)
    {
        if (!$tag) {
            $tag = key($this->_tags) ?: $this->lastTag;
        }
        if (!isset($this->_tags[$tag])) {
            $this->_tags[$tag] = new Tag($tag);
        }

        return $this->_tags[$tag];
    }

    public function hasTag($tag)
    {
        return array_key_exists($tag, $this->_tags);
    }

    public function addTag($tag, $date = null)
    {
        $this->findTag($tag)->setDate($date);
    }

    public function addNote($tag, $note)
    {
        $this->findTag($tag)->findNote($note);
    }

    public function hasHash($hash)
    {
        return array_key_exists((string) $hash, $this->_hashes);
    }

    public function addHash($hash, $label)
    {
        $this->_hashes[(string) $hash] = $label;
    }

    public function addCommit($tag, $note, $hash, $label = null)
    {
        $this->addHash($hash, $label);
        $this->findTag($tag)->findNote($note)->findCommit($hash)->setLabel($label);
    }

    public function addComment($tag, $note, $hash, $text = null)
    {
        $this->findTag($tag)->findNote($note)->findCommit($hash)->addComment($text);
    }

    public function addHistory($commit, $front = false)
    {
        $tag    = $commit['tag'];
        $note   = $commit['note'];
        $hash   = $commit['hash'];
        $render = static::renderCommit($commit);
        $hashes = &$this->_tags[$tag][$note];
        $hashes = (array) $hashes;
        if ($front) {
            $hashes = [$hash => [$render]] + $hashes;
        } else {
            $hashes[$hash][] = $render;
        }
    }

    public function addGitLog()
    {
        foreach (array_reverse(static::getVcs()->commits, true) as $hash => $commit) {
            if ($this->hasCommit($hash)) {
                continue;
            }
            $this->addHistory($commit, true);
        }
        if (!$this->hasHistory(static::getVcs()->initTag)) {
            $this->addHistory(['tag' => static::getVcs()->initTag]);
        }
    }

    public static function skipCommit($commit)
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

}
