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
 *
 * @property array $headers: header => header
 * @property array $hashes:  hash => hash
 * @property array $links:   link => href
 * @property array $tags:    tag name => tag object
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

    public function hasLink($link)
    {
        return isset($this->_links[$link]);
    }

    public function addLink($link, $href)
    {
        $this->_links[$link] = $href;
    }

    public function addLinks(array $links)
    {
        foreach ($links as $link => $href) {
            $this->addLink($link, $href);
        }
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
            $this->addTag(new Tag($this->lastTag));
        }
    }

    public function getTags()
    {
        return $this->_tags;
    }

    public function addTags(array $tags)
    {
        foreach ($tags as $name => $tag) {
            $this->addTag($tag);
        }
    }

    public function setTags(array $tags)
    {
        $this->_tags = [];
        $this->addTags($tags);
    }

    /**
     * Returns tag by name.
     * Creates if not exists.
     * Returns first tag when given empty name.
     * @param string|Tag $tag tag or tag name
     * @return Tag
     */
    public function findTag($tag)
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

    public function addTag(Tag $tag)
    {
        return $this->findTag($tag->getName())->setDate($tag->getDate())->addNotes($tag->getNotes());
    }

    /**
     * Merges given history into the current.
     * @param History $history
     */
    public function merge(History $history)
    {
        $this->addLinks($history->getLinks());
        $this->addHashes($history->getHashes());
        $this->mergeTags($history->getTags());
    }

    /**
     * Merge given tags into the current history.
     * @param Tag[] $tags
     */
    public function mergeTags(array $tags)
    {
        $olds = $this->getTags();
        $this->_tags = $tags;
        foreach ($olds as $tag) {
            $this->addTag($tag);
        }
    }
}
