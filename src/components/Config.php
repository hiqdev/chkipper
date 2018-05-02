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
use yii\helpers\ArrayHelper;
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

    protected $_authors = [];

    public $configFile = 'chkipper.json';

    public $historyFile = 'history.md';

    public $rmsSite = 'github.com';

    protected $_changelog = [
        'file'   => 'CHANGELOG',
        'format' => 'markdown',
    ];

    protected $_history = [
        'file'   => 'history',
        'format' => 'markdown',
    ];

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

    public function setChangelog(array $options)
    {
        $this->_changelog = array_merge($this->_changelog, $options);
    }

    public function getChangelog($key = null)
    {
        if ($key === null) {
            return $this->_changelog;
        }

        return isset($this->_changelog[$key]) ? $this->_changelog[$key] : null;
    }

    public function getDest($dest = null, $key = null)
    {
        if ($dest === 'changelog') {
            return $this->getChangelog($key);
        }
        if ($dest === 'history') {
            return $this->getHistory($key);
        }
    }

    public function setAuthors(array $authors)
    {
        $this->_authors = $authors;
    }

    public function getAuthors()
    {
        return $this->_authors;
    }

    protected $_options = [
        'markdown' => [
            'extension' => 'md',
            'changelog' => [
                'rendererClass' => \hiqdev\chkipper\lib\changelog\MarkdownRenderer::class,
                'parserClass' => \hiqdev\chkipper\lib\changelog\MarkdownParser::class,
            ],
        ],
        'keepachangelog' => [
            'extension' => 'md',
            'changelog' => [
                'rendererClass' => \hiqdev\chkipper\lib\changelog\KeepAChangelogRenderer::class,
            ],
        ],
    ];

    public function setOptions(array $options)
    {
        $this->_options = ArrayHelper::merge($this->_options, $options);
    }

    public function getOptions()
    {
        return $this->_options;
    }

    public function getOption($key, $dest = null, $format = null)
    {
        if ($format === null) {
            $format = strtolower($this->getDest($dest, 'format'));
        }
        if (empty($this->_options[$format])) {
            throw new InvalidConfigException("wrong format '$format' for '$dest'");
        }
        $options = $this->_options[$format];

        if (isset($options[$dest][$key])) {
            return $options[$dest][$key];
        }
        if (!isset($options[$key])) {
            throw new InvalidConfigException("wrong option '$key' for '$dest'");
        }

        return $options[$key];
    }

    public function createChangelogRenderer()
    {
        $class = $this->getOption('rendererClass', 'changelog');

        return Yii::createObject($class);
    }

    public function getChangelogFile()
    {
        $file = $this->getChangelog('file');
        $extension = $this->getOption('extension', 'changelog');
        if ($extension) {
            $file .= '.' . $extension;
        }

        return $file;
    }
}
