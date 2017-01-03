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

    /**
     * Creates modifier from given config.
     *
     * @param string|array $config
     * @return AbstractModifier
     */
    public static function create($config = [])
    {
        if (is_string($config)) {
            $config = ['class' => $config];
        }
        $class = isset($config['class']) ? $config['class'] : get_called_class();
        unset($config['class']);

        if (!class_exists($class)) {
            $local = __NAMESPACE__ . '\\' . $class;
            if (class_exists($local)) {
                $class = $local;
            }
        }
        $modifier = new $class();
        foreach ($config as $key => $value) {
            $modifier->$key = $value;
        }

        return $modifier;
    }
}
