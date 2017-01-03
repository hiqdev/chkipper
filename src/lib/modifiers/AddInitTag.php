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
use hiqdev\chkipper\lib\Tag;

/**
 * Modifier that adds init tag with oldest commit date.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class AddInitTag extends AbstractModifier
{
    public function run(History $history)
    {
        if (!$history->hasTag($history->initTag)) {
            $min = '';
            foreach ($history->getTags() as $tag) {
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
                $history->addTag(new Tag($history->initTag, $min));
            }
        }
    }
}
