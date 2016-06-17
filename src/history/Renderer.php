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
 * Renderer class.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class Renderer
{
    public $indent = '    ';

    public function setHistory($value)
    {
        $this->_history = $value;
    }

    public function getHistory()
    {
        return $this->_history;
    }

    public function render(History $history)
    {
        $this->setHistory($history);

        return $this->renderText([
            $this->renderHeaders(),
            $this->renderTags(),
            $this->renderLinks(),
        ]);
    }

    public function renderHeaders()
    {
        return $this->renderText($this->getHistory()->getHeaders());
    }

    public function renderTags()
    {
        return $this->renderObjects('renderTag', $this->getHistory()->getTags());
    }

    public function renderLinks()
    {
        return $this->renderObjects('renderLink', $this->getHistory()->getLinks());
    }

    public function renderObjects($method, $objects)
    {
        $res = [];
        foreach ($objects as $key => $value) {
            $res[$key] = call_user_func([$this, $method], $value, $key);
        }

        return $this->renderText($res);
    }

    public function renderText(array $lines)
    {
        $res = rtrim(implode("\n", $lines));

        return $res ? $res . "\n" : '';
    }

    public function renderLink($href, $link)
    {
        return "[$link]: $href";
    }

    public function renderHeader($header)
    {
        return $header;
    }

    public function renderTag(Tag $tag)
    {
        return $this->renderText([
            $this->renderTagHead($tag),
            $this->renderObjects('renderNote', $tag->getNotes()),
        ]);
    }

    public function renderTagHead(Tag $tag)
    {
        $res = '## [' . $tag->getTag() . ']';
        if ($tag->getDate()) {
            $res .= ' - ' . $tag->getDate();
        }

        return $res . "\n";
    }

    public function renderNote(Note $note)
    {
        return $this->renderText([
            $this->renderNoteHead($note),
            $this->renderObjects('renderCommit', $note->getCommits()),
        ]);
    }

    public function renderNoteHead(Note $note)
    {
        return '- ' . $note->getNote();
    }

    public function renderCommit(Commit $commit)
    {
        return $this->renderText([
            $this->renderCommitHead($commit),
            $this->renderText($commit->getComments()),
        ]);
    }

    public function renderCommitHead(Commit $commit)
    {
        return $this->indent . '- [' . $commit->getHash() . '] ' . $commit->getLabel();
    }
}
