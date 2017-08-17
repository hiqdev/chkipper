<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\lib\changelog;

use hiqdev\chkipper\lib\Note;
use hiqdev\chkipper\lib\Tag;

/**
 * Keep a Changelog renderer.
 *
 * [Keep a Changelog](http://keepachangelog.com/)
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class KeepAChangelogRenderer extends MarkdownRenderer
{
    public $defaultAction = 'changed';

    protected $normalization = Normalization::class;

    protected $actions;

    public function renderTag(Tag $tag)
    {
        $this->actions = [];

        return
            $this->renderTagHead($tag) .
            $this->renderObjects('scanNote', $tag->getNotes()) .
            $this->renderObjects('renderAction', $this->actions, false);
    }

    public function renderAction($notes, $action)
    {
        return
            $this->renderActionHead($action) .
            $this->renderObjects('renderNote', $notes, true) . "\n";
    }

    public function renderActionHead($action)
    {
        return '### ' . ucfirst($action) . "\n";
    }

    public function scanNote(Note $note)
    {
        $str = $this->renderNoteHead($note);
        if (!$str) {
            return;
        }

        $action = $this->detectAction($note);
        $this->actions[$action][] = $note;

        return null;
    }

    protected $words = [
        'removed'   => 'removed',
        'deleted'   => 'removed',
        'changed'   => 'changed',
        'added'     => 'added',
        'fixed'     => 'fixed',

        'remove'    => 'removed',
        'delete'    => 'removed',
        'change'    => 'changed',
        'add'       => 'added',
        'fix'       => 'fixed',

        'update'    => 'changed',
        'fixes'     => 'fixed',
    ];

    public function detectAction(Note $note)
    {
        $str = $note->getNote();

        $first = preg_split('/[^a-zA-Z]+/', $str, 2)[0];
        foreach ($this->words as $word) {
            if ($word === strtolower($first)) {
                return $word;
            }
        }

        foreach ($this->words as $word) {
            if (preg_match("/\b$word\b/", $str)) {
                return $word;
            }
        }

        return $this->defaultAction;
    }
}
