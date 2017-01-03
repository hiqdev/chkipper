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
 * Modifier that normalizes dates in all the tags:
 * - drops date for the last tag
 * - sets dates for other tags.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class SetTagDates extends AbstractModifier
{
    /**
     * {@inheritdoc}
     */
    public function run(History $history)
    {
        foreach ($history->getTags() as $tag) {
            if ($tag->getName() === $history->lastTag) {
                $tag->unsetDate();
            } elseif (!$tag->getDate()) {
                $tag->setDate($tag->findDate());
            }
        }
    }
}
