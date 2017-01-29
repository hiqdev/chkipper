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

    protected $_authors = [];

    public $configFile = 'chkipper.json';

    public $historyFile = 'history.md';

    protected $_changelog = [
        'file'   => 'CHANGELOG',
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

    public function getChangelog()
    {
        return $this->_changelog;
    }

    public function setAuthors(array $authors)
    {
        $this->_authors = $authors;
    }

    public function getAuthors()
    {
        return $this->_authors;
    }

    protected $_changelogRenderers = [
        'markdown' => \hiqdev\chkipper\lib\changelog\MarkdownRenderer::class,
        'keepachangelog' => \hiqdev\chkipper\lib\changelog\KeepAChangelogRenderer::class,
    ];

    public function createChangelogRenderer()
    {
        $format = strtolower($this->changelog['format']);
        if (empty($this->_changelogRenderers[$format])) {
            throw new InvalidConfigException("wrong changelog format '$format'");
        }

        return Yii::createObject($this->_changelogRenderers[$format]);
    }

    public function getChangelogFile()
    {
        return $this->_changelog['file'];
    }
}
