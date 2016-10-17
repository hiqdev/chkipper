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

    protected $_project;
    protected $_headers = [];
    protected $_hashes  = [];
    protected $_links   = [];
    protected $_tags    = [];

    public function setProject($value)
    {
        $this->_project = $value;
    }

    public function getProject()
    {
        if ($this->_project === null) {
            $this->_project = $this->detectProject();
        }

        return $this->_project;
    }

    public function detectProject()
    {
        foreach ($this->getHeaders() as $line) {
            if (preg_match('/\b([a-z0-9._-]{2,}\/[a-z0-9._-]{2,})\b/i', $line, $m)) {
                return $m[1];
            }
        }
    }

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

    public function removeLink($link)
    {
        unset($this->_links[$link]);
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

    public function setFirstTag($name)
    {
        $this->getFirstTag()->setName($name);
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

    /**
     * Adds given tags to the history.
     * @param Tag[] $tags
     * @param boolean $prependNotes default is append
     */
    public function addTags(array $tags, $prependNotes = false)
    {
        foreach ($tags as $name => $tag) {
            $this->addTag($tag, $prependNotes);
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
     * @param string|Tag $tag tag name or tag object
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

    public function removeTag($name)
    {
        foreach ($this->_tags as $k => $tag) {
            if ($tag->getName() == $name) {
                unset($this->_tags[$k]);

                return;
            }
        }
    }

    /**
     * Adds tag.
     * @param Tag $tag
     * @param boolean $prependNotes default is append
     * @return Tag the added tag
     */
    public function addTag(Tag $tag, $prependNotes = false)
    {
        return $this->findTag($tag->getName())->setDate($tag->getDate())->addNotes($tag->getNotes(), $prependNotes);
    }

    /**
     * Merges given history into the current.
     * @param History $history
     * @param boolean $prependNotes default is append
     */
    public function merge(History $history, $prependNotes = false)
    {
        $this->mergeTags($history->getTags(), $prependNotes);
        $this->addLinks($history->getLinks());
        $this->addHashes($history->getHashes());
    }

    /**
     * Merge given tags into the current history.
     * @param Tag[] $tags
     * @param boolean $prependNotes default is append
     */
    public function mergeTags(array $tags, $prependNotes = false)
    {
        foreach ($tags as $tag) {
            foreach ($tag->getNotes() as $note) {
                $note->removeCommits($this->getHashes());
            }
        }
        $this->addTags($tags, $prependNotes);
        //$olds = $this->getTags();
        //$this->_tags = $tags;
        //$this->addTags($$olds);
    }

    /**
     * Normalizes the history.
     */
    public function normalize($options = [])
    {
        static $defaults = [
            'removeEmptyFirstTag' => [],
            'addInitTag'          => [],
            'setTagDates'         => [],
            'addCommitLinks'      => [],
            'removeCommitLinks'   => [],
        ];
        $options = array_merge($defaults, $options);
        foreach ($options as $func => $args) {
            if (is_array($args)) {
                call_user_func_array([$this, $func], $args);
            }
        }
    }

    /**
     * Removes first tag if it is empty: has no notes and no commits.
     */
    public function removeEmptyFirstTag()
    {
        $tag = $this->getFirstTag();
        $notes = $tag->getNotes();
        if (count($notes) > 1) {
            return;
        }
        if (count($notes) > 0) {
            $note = reset($notes);
            if ($note->getNote() || count($note->getCommits()) > 0) {
                return;
            }
        }
        $this->removeTag($tag->getName());
    }

    /**
     * Adds init tag with oldest commit date.
     */
    public function addInitTag()
    {
        if (!$this->hasTag($this->initTag)) {
            $min = '';
            foreach ($this->getTags() as $tag) {
                foreach ($tag->getNotes() as $note) {
                    foreach ($note->getCommits() as $commit) {
                        $date = $commit->getDate();
                        if (!$min || strcmp($date, $min) < 0) {
                            $min = $date;
                        }
                    }
                }
            }
            if ($min) {
                $this->addTag(new Tag($this->initTag, $min));
            }
        }
    }

    /**
     * Normalizes dates to all the tags.
     * Drops date for the last tag and sets for others.
     */
    public function setTagDates()
    {
        foreach ($this->getTags() as $tag) {
            if ($tag->getName() === $this->lastTag) {
                $tag->unsetDate();
            } elseif (!$tag->getDate()) {
                $tag->setDate($tag->findDate());
            }
        }
    }

    /**
     * Adds links for commits not having ones.
     */
    public function addCommitLinks()
    {
        foreach ($this->getHashes() as $hash) {
            if (!$this->hasLink($hash)) {
                $this->addLink($hash, $this->generateHashHref($hash));
            }
        }
    }

    public function generateHashHref($hash)
    {
        $project = $this->getProject();

        return "https://github.com/$project/commit/$hash";
    }

    /**
     * Removes commit links that are not present in the history.
     */
    public function removeCommitLinks($all = false)
    {
        foreach ($this->getLinks() as $link => $href) {
            if (preg_match('/^[0-9a-f]{7}$/', $link)) {
                if ($all || !$this->hasHash($link)) {
                    $this->removeLink($link);
                }
            }
        }
    }
}
