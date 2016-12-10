<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\history;

/**
 * Markdown history renderer.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class MarkdownRenderer extends AbstractRenderer
{
    public $indent = '    ';

    /**
     * {@inheritdoc}
     */
    public function render(History $history)
    {
        $this->setHistory($history);

        return $this->renderSparse([
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
        return $this->renderObjects('renderTag', $this->getHistory()->getTags(), true);
    }

    public function renderLinks()
    {
        return $this->renderObjects('renderLink', $this->getHistory()->getLinks());
    }

    public function renderObjects($method, $objects, $sparse = false)
    {
        $res = [];
        foreach ($objects as $key => $value) {
            $res[$key] = call_user_func([$this, $method], $value, $key);
        }

        return $this->renderText($res, $sparse);
    }

    public function renderSparse(array $lines)
    {
        $res = rtrim(implode("\n", $lines));

        return $res ? $res . "\n" : '';
    }

    public function renderText(array $lines, $sparse = false)
    {
        if (!$sparse) {
            foreach ($lines as &$line) {
                $line = rtrim($line);
            }
            $lines = array_filter($lines);
        }

        return $this->renderSparse($lines);
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
        return $this->renderSparse([
            $this->renderTagHead($tag),
            $this->renderObjects('renderNote', $tag->getNotes()),
        ]);
    }

    public function renderTagHead(Tag $tag)
    {
        $res = '## [' . $tag->getName() . ']';
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
        return $note->getNote() ? '- ' . $note->getNote() : '';
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
