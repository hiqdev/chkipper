<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\lib\parsers;

use hiqdev\chkipper\lib\Builder;

/**
 * Abstract history parser.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
abstract class AbstractParser extends Builder
{
    public function parsePath($path)
    {
        $lines = is_file($path) ? file($path) : [];

        return $this->parseLines($lines);
    }

    abstract public function parseLines(array $lines);
}
