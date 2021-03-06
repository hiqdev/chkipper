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
 * Modifier that adds links for commits without link.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class AddCommitLinks extends AbstractModifier
{
    /**
     * {@inheritdoc}
     */
    public function run(History $history)
    {
        foreach ($history->getHashes() as $hash) {
            if (!$history->hasLink($hash)) {
                $history->addLink($hash, static::generateCommitHref($history, $hash));
            }
        }
    }

    /**
     * Generates href to a commit.
     * @param History $history history object
     * @param string $hash commit hash
     * @return string
     */
    public static function generateCommitHref(History $history, $hash)
    {
        $project = $history->getProject();
        $rmsSite = $history->getConfig()->rmsSite;

        return "https://$rmsSite/$project/commit/$hash";
    }
}
