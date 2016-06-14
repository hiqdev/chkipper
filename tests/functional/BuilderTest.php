<?php

namespace hiqdev\chkipper\tests\functional;

use hiqdev\chkipper\history\Builder;

ini_set('xdebug.var_display_max_depth', 15);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

class InitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Builder
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new Builder();
    }

    protected function tearDown()
    {
        $this->tester = null;
    }

    public function testMinimal()
    {
        $this->object->parsePath(__DIR__ . '/minimal.md');
        var_dump($this->object->getHistory());
    }
}
