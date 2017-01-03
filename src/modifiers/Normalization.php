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

/**
 * Standard normalization - collection of standard modifiers.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class Normalization extends CompositeModifier
{
    public $modifiers = [
        'RemoveEmptyFirstTag' => [],
        'AddInitTag'          => [],
        'SetTagDates'         => [],
        'AddCommitLinks'      => [],
        'AddTagLinks'         => [],
        'RemoveCommitLinks'   => [],
        'PrettifyUserLinks'   => [],
    ];
}
