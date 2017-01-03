<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\changelog;

use hiqdev\chkipper\modifiers\CompositeModifier;

/**
 * Changelog normalization - collection of modifiers for changelog.
 * Removes all commit links.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class Normalization extends CompositeModifier
{
    public $modifiers = [
        'AddCommitLinks'    => null,
        'RemoveCommitLinks' => [
            'all' => true,
        ],
    ];
}
