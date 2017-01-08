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
 * Modifier that sorts links in configured order.
 * Default order is:
 * - other (user defined) links
 * - author links
 * - tags links
 * - commit links.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class OrderLinks extends AbstractModifier
{
    protected $defaultOrder = ['other', 'authors', 'tags', 'commits'];

    /**
     * {@inheritdoc}
     */
    public function run(History $history)
    {
    }
}
