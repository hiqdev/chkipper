<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\lib\changelog;

use hiqdev\chkipper\lib\History;

/**
 * Release Notes renderer.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class NotesRenderer extends MarkdownRenderer
{
    /**
     * {@inheritdoc}
     */
    public function render(History $history)
    {
        $this->setHistory($history);

        $links = $history->getLinks();
        $hrefs = [];
        $result = $this->renderObjects('renderNote', $history->getFirstTag()->getNotes());

        $result = preg_replace_callback('/\[(\S*?)\]/', function ($matches) use ($links, &$hrefs) {
            if (isset($links[$matches[1]])) {
                $hrefs[$matches[1]] = $links[$matches[1]];
            }

            return $matches[0];
        }, $result);

        if ($hrefs) {
            $result .= PHP_EOL . $this->renderLinks($hrefs);
        }

        return $result;
    }
}
