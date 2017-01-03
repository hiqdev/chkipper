<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\components;

use hiqdev\chkipper\lib\ConfigInterface;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\helpers\Json;

/**
 * Config class.
 * Loads and holds configuration.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class Config extends Component implements BootstrapInterface, ConfigInterface
{
    protected $_name;

    public $configFile = 'chkipper.json';

    public $historyFile = 'history.md';

    public $changelogFile = 'CHANGELOG.md';

    public function bootstrap($app)
    {
        if (is_file($this->configFile)) {
            $json = file_get_contents($this->configFile);
            $data = Json::decode($json);
            Yii::configure($this, $data);
        }
    }

    public function setName($name)
    {
        $this->_name = $name;
    }

    public function getName()
    {
        return $this->_name;
    }
}
