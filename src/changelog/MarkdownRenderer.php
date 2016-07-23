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

    public $normalizeOptions = [
        'addCommitLinks'    => null,
        'removeCommitLinks' => [true],
    ];

}
