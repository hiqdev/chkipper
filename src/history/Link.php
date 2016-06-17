<?php

/*
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\history;

/**
 * Link class.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class Link
{
    protected $_link;
    protected $_href;

    public function __construct($link, $href)
    {
        $this->_link = $link;
        $this->_href = $href;
    }

    public function getLink()
    {
        return $this->_link;
    }

    public function getHref()
    {
        return $this->_href;
    }
}
