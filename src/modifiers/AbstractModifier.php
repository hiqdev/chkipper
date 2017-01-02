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

/**
 * Abstract modifier class.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
abstract class AbstractModifier implements ModifierInterface
{
    abstract public function run(History $history);

    public static function create(array $config)
    {
        $class = isset($config['class']) ? $config['class'] : $name;
        unset($config['class']);

        if (!class_exists($class)) {
            $class = __NAMESPACE__ . '\\' . $class;
        }
        $modifier = new $class();
        foreach ($config as $key => $value) {
            $modifier->$key = $value;
        }

        return $modifier;
    }
}
