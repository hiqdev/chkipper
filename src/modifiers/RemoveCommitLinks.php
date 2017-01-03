<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\modifiers;

use hiqdev\chkipper\history\History;

/**
 * Modifier that removes commit links that are not present in the history.
 * Has option to remove all the commit links.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class RemoveCommitLinks extends AbstractModifier
{
    public $all = false;

    /**
     * @inheritdoc
     */
    public function run(History $history)
    {
        foreach ($history->getLinks() as $link => $href) {
            if (preg_match('/^[0-9a-f]{7}$/', $link)) {
                if ($this->all || !$history->hasHash($link)) {
                    $history->removeLink($link);
                }
            }
        }
    }
}
