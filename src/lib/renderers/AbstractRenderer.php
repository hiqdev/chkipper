<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\lib\renderers;

use hiqdev\chkipper\lib\ConfigInterface;
use hiqdev\chkipper\lib\History;
use hiqdev\chkipper\lib\modifiers\Normalization;

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

    protected $normalization = Normalization::class;

    public function __construct(ConfigInterface $config)
    {
        $this->_config = $config;
    }

    public function getConfig()
    {
        return $this->_config;
    }

    public function setHistory(History $history)
    {
        if (!empty($this->normalization)) {
            Normalization::create($this->normalization)->run($history);
        }
        $this->_history = $history;
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
