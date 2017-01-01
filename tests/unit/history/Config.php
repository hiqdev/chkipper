<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\tests\unit\history;

use hiqdev\chkipper\history\ConfigInterface;

/**
 * Simple config for tests.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class Config implements ConfigInterface
{
    public function getName() {
        return '';
    }
}
