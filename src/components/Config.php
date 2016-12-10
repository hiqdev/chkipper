<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\components;

use yii\base\BootstrapInterface;
use yii\base\Component;

/**
 * Config class.
 * Loads and holds configuration.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class Config extends Component implements BootstrapInterface
{
    public $historyFile = 'history.md';

    public $changelogFile = 'CHANGELOG.md';

    public function bootstrap($app)
    {
    }
}
