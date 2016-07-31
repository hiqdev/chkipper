<?php

/*
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\changelog;

use hiqdev\chkipper\history\History;

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

        return $this->renderObjects('renderNote', $history->getFirstTag()->getNotes());
    }
}
