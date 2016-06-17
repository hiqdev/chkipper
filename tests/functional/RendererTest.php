<?php

namespace hiqdev\chkipper\tests\functional;

use hiqdev\chkipper\history\Parser;
use hiqdev\chkipper\history\Renderer;

class RendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Renderer
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new Renderer();
    }

    protected function tearDown()
    {
    }

    public function testMinimal()
    {
        $path = __DIR__ . '/minimal.md';
        $parser = new Parser();
        $history = $parser->parsePath($path);
        $text = $this->object->render($history);
        print "\n" . $text . "-----\n";
        $this->assertEquals(file_get_contents($path), $text);
    }
}
