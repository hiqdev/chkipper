<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\history;

/**
 * Abstract history renderer.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
abstract class AbstractRenderer
{
    /**
     * @var ConfigInterface config object
     */
    protected $_config;

    public $normalizeOptions = [];

    public function __construct(ConfigInterface $config)
    {
        $this->_config = $config;
    }

    public function setHistory($value)
    {
        $this->_history = $value;
        $this->_history->normalize($this->normalizeOptions);
    }

    public function getHistory()
    {
        return $this->_history;
    }

    /**
     * Renders history to string.
     * @param History $history
     * @return string
     */
    abstract public function render(History $history);
}
