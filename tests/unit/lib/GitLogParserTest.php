<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\tests\unit\lib;

use hiqdev\chkipper\lib\parsers\GitLogParser;
use hiqdev\chkipper\lib\renderers\MarkdownRenderer;

/**
 * Git log history parser test case.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class GitLogParserTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var GitLogParser
     */
    protected $object;

    protected function setUp()
    {
        $config = new Config();
        $this->object = new GitLogParser($config);
    }

    protected function tearDown()
    {
    }

    public function testParsePath()
    {
        $this->object->parsePath(__DIR__ . '/big-git-log.txt');
        $this->object->getHistory()->setProject('hiqdev/chkipper');
        $renderer = new MarkdownRenderer($this->object->getConfig());
        $text = $renderer->render($this->object->getHistory());
        $this->assertEquals(file_get_contents(__DIR__ . '/big-git-log.md'), $text);
    }
}
