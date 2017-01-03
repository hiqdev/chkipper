<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\lib\modifiers;

use hiqdev\chkipper\lib\History;

/**
 * Modifier that removes first tag if it is empty.
 * Empty tag has no notes and no commits.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class RemoveEmptyFirstTag extends AbstractModifier
{
    /**
     * {@inheritdoc}
     */
    public function run(History $history)
    {
        $tag = $history->getFirstTag();
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
        $history->removeTag($tag->getName());
    }
}
