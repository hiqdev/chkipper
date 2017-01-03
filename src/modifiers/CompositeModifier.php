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
use Yii;

/**
 * CompositeModifier class.
 * Runs multiple modifiers.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class CompositeModifier extends AbstractModifier
{
    /**
     * @var array list of modifiers to run
     */
    public $modifiers = [];

    /**
     * Add modifiers.
     * @param array $modifiers
     * @return self for chaining
     */
    public function addModifiers(array $modifiers)
    {
        $this->modifiers = array_merge($this->modifiers, $modifiers);

        return $this;
    }

    /**
     * Removes first tag if it is empty: has no notes and no commits.
     */
    public function run(History $history)
    {
        foreach ($this->modifiers as $name => $config) {
            if (is_null($config)) {
                continue;
            }

            if (empty($config['class'])) {
                $config['class'] = $name;
            }
            static::create($config)->run($history);
        }
    }

}
