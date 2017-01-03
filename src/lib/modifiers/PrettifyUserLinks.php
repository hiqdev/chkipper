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
 * Modifier that prepares better links to users (committers) when possible.
 *
 * Git provides emails of commiters.
 * If you provide link to committer's personal page this modifier will spread
 * it all over the history.
 *
 * E.g. git provides my email as sol@hiqdev.com for all my commits.
 * So my commits will look like this in history:
 * ```
 * - [0000000] 2017-01-01 commit comment [sol@hiqdev.com]
 * ```
 * I want my commits to link to my github page: https://github.com/hiqsol
 * So I add these lines in the links part of the history (at the end of file):
 * ```
 * [@hiqsol]: https://github.com/hiqsol
 * [sol@hiqdev.com]: https://github.com/hiqsol
 * ```
 * This modifier will change my commits to look like this:
 * ```
 * - [0000000] 2017-01-01 commit comment [@hiqsol]
 * ```
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class PrettifyUserLinks extends AbstractModifier
{
    /**
     * {@inheritdoc}
     */
    public function run(History $history)
    {
        $users = [];
        $subs = [];
        foreach ($history->getLinks() as $link => $href) {
            if ($link[0] === '@') {
                $users[$href] = $link;
            } elseif (isset($users[$href])) {
                $subs[$link] = $users[$href];
            }
        }
        if (!$subs) {
            return;
        }
        foreach ($history->getTags() as $tag) {
            foreach ($tag->getNotes() as $note) {
                foreach ($note->getCommits() as $commit) {
                    $author = $commit->getAuthor();
                    if (isset($subs[$author])) {
                        $commit->setAuthor($subs[$author]);
                    }
                }
            }
        }
    }
}
