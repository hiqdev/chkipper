<?php

/*
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\changelog;

use hiqdev\chkipper\history\Note;

/**
 * Markdown changelog renderer.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class MarkdownRenderer extends \hiqdev\chkipper\history\MarkdownRenderer
{

    public function renderNote(Note $note)
    {
        return $this->renderNoteHead($note);
    }

    public function renderLink($href, $link)
    {
        return preg_match('/^[0-9a-f]{7}$/', $link) ? null : parent::renderLink($href, $link);
    }
}
