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
 * Modifier interface.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
interface ModifierInterface
{
    public function run(History $history);
}
