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
 * Holds history of commits with additional information:
 * - list of headers
 * - list of hashes
 * - list of links
 * - list of tags.
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

    public function addHeaders(array $headers)
    {
        foreach ($headers as $header) {
            $this->addHeader($header);
        }
    }

    public function setHeaders(array $headers)
    {
        $this->_headers = [];
        $this->addHeaders($headers);
    }

    public function getHeaders()
    {
        return $this->_headers;
    }

    public function addLink($link, $href)
    {
        $this->_links[$link] = $href;
    }

    public function setLinks(array $links)
    {
        $this->_links = $links;
    }

    public function getLinks()
    {
        return $this->_links;
    }

    public function hasHash($hash)
    {
        return isset($this->_hashes[(string) $hash]);
    }

    public function addHash($hash)
    {
        $this->_hashes[(string) $hash] = $hash;
    }

    public function addHashes(array $hashes)
    {
        foreach ($hashes as $hash) {
            $this->addHash($hash);
        }
    }

    public function setHashes(array $hashes)
    {
        $this->_hashes = [];
        $this->addHashes($hashes);
    }

    public function getHashes()
    {
        return $this->_hashes;
    }

    public function getFirstTag()
    {
        return reset($this->_tags);
    }

    public function countTags()
    {
        return count($this->_tags);
    }

    public function initTags()
    {
        if (!$this->countTags()) {
            $this->addTag($this->lastTag);
        }
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
     * @param string|Tag $tag tag or tag name
     * @return Tag
     */
    public function findTag($tag, $pre = false)
    {
        if (!$tag) {
            $tag = reset($this->_tags) ?: $this->lastTag;
        }
        $name = $tag instanceof Tag ? $tag->getName() : $tag;
        if (!$this->hasTag($name)) {
            $this->_tags[$name] = new Tag($name);
        }

        return $this->_tags[$name];
    }

    public function hasTag($tag)
    {
        return isset($this->_tags[$tag]);
    }

    public function addTag($tag, $date = null)
    {
        $this->findTag($tag)->setDate($date);
    }

    public function findNote($tag, $note)
    {
        $this->findTag($tag)->findNote($note);
    }

    public function findCommit($tag, $note, $hash, $pre = false)
    {
        $this->addHash($hash);

        return $this->findTag($tag, $pre)->findNote($note, $pre)->findCommit($hash, $pre);
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
}
