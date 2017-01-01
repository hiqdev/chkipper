<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
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
        $str = $this->renderNoteHead($note);
        if (!$str) {
            return;
        }
        $authors = [];
        foreach ($note->getCommits() as $commit) {
            $authors[$commit->getAuthor()] = '[' . $commit->getAuthor() . ']';
        }
        if ($authors) {
            $str .= ' (' . implode(', ', $authors) . ')';
        }

        return $str;
    }

    public $normalizeOptions = [
        'addCommitLinks'    => null,
        'removeCommitLinks' => [true],
    ];
}
