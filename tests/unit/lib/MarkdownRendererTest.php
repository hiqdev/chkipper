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

use hiqdev\chkipper\lib\parsers\MarkdownParser;
use hiqdev\chkipper\lib\renderers\MarkdownRenderer;

/**
 * Markdown history renderer test case.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class MarkdownRendererTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var MarkdownRenderer
     */
    protected $object;

    protected function setUp()
    {
        $config = new Config();
        $this->object = new MarkdownRenderer($config);
    }

    protected function tearDown()
    {
    }

    public function testRender()
    {
        $path = __DIR__ . '/minimal.md';
        $parser = new MarkdownParser($this->object->getConfig());
        $history = $parser->parsePath($path);
        $text = $this->object->render($history);
        $this->assertEquals(file_get_contents($path), $text);
    }
}
