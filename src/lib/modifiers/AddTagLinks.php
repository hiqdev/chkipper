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
 * Modifier that adds links for tags.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class AddTagLinks extends AbstractModifier
{
    /**
     * {@inheritdoc}
     */
    public function run(History $history)
    {
        $prev = null;
        foreach ($history->getTags() as $tag) {
            $tag = $tag->getName();
            if ($prev && ($history->isLastTag($prev) || !$history->hasLink($prev))) {
                $history->addLink($prev, static::generateTagHref($history, $prev, $tag));
            }
            $prev = $tag;
        }
    }

    /**
     * Generate href to a version tag.
     * @param History $history history object
     * @param string $prev previous tag
     * @param string $curr current tag
     * @return string
     */
    public function generateTagHref(History $history, $prev, $curr)
    {
        $project = $history->getProject();
        if ($history->isInitTag($curr)) {
            if ($history->isLastTag($prev)) {
                return "https://github.com/$project/releases";
            }

            return "https://github.com/$project/releases/tag/$prev";
        }
        if ($history->isLastTag($prev)) {
            $prev = 'HEAD';
        }

        return "https://github.com/$project/compare/$curr...$prev";
    }
}
