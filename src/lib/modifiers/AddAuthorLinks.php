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
 * Modifier that adds links for authors given in config.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class AddAuthorLinks extends AbstractModifier
{
    /**
     * {@inheritdoc}
     */
    public function run(History $history)
    {
        foreach (array_reverse($history->getConfig()->getAuthors()) as $nick => $data) {
            if (strncmp($nick, '@', 1)) {
                $nick = '@' . $nick;
            }
            $href = !empty($data['github']) ? $data['github'] :
                (!empty($data['homepage']) ? $data['homepage'] : null);
            if ($history->hasLink($nick) || empty($href)) {
                continue;
            }

            if (!empty($data['email'])) {
                $history->unshiftLink($data['email'], $href);
            }
            $history->unshiftLink($nick, $href);
        }
    }
}
