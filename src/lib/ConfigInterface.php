<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\lib;

/**
 * Config interface.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
interface ConfigInterface
{
    /**
     * Get package name.
     * @return string full package name e.g. hiqdev/chkipper
     */
    public function getName();

    /**
     * Get authors array.
     * @return array authors array e.g. [
     *  'hiqsol => [
     *      'name' => 'Andrii Vasyliev',
     *      'email' => 'sol@hiqdev.com',
     *      'github' => 'https://github.com/hiqsol',
     *  ],
     * ]
     */
    public function getAuthors();
}
