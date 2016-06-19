<?php

/*
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\tests\unit\history;

use hiqdev\chkipper\history\MarkdownParser;
use hiqdev\chkipper\history\History;
use hiqdev\chkipper\history\Tag;
use hiqdev\chkipper\history\Note;
use hiqdev\chkipper\history\Commit;

ini_set('xdebug.var_display_max_depth', 15);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

/**
 * Markdown history parser test case.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class MarkdownParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MarkdownParser
     */
    protected $object;

    protected $note     = 'Added basics';
    protected $hash     = 'b22f8ac';
    protected $date     = '2016-06-11';
    protected $subject  = 'inited';
    protected $author   = '@hiqsol';
    protected $email    = 'sol@hiqdev.com';
    protected $label;
    protected $comment  = '        - longer description for initial commit';

    protected function setUp()
    {
        $this->label  = $this->date . ' ' . $this->subject . ' [' . $this->author . ']';
        $this->object = new MarkdownParser();
    }

    protected function tearDown()
    {
    }

    public function testParsePath()
    {
        $this->object->parsePath(__DIR__ . '/minimal.md');
        $history = new History();
        $history->setHeaders([
            'hiqdev/chkipper commits history',
            '-------------------------------',
        ]);
        $history->setTags([
            $this->object->getLastTag() => new Tag(
                $this->object->getLastTag(),
                null,
                [
                    $this->note => new Note($this->note, [
                        $this->hash => new Commit($this->hash, $this->label, [$this->comment]),
                    ]),
                ]
            ),
            $this->object->getInitTag() => new Tag($this->object->getInitTag(), $this->date),
        ]);
        $history->addHash($this->hash);
        $history->setLinks([
            'Under development'   => 'https://github.com/hiqdev/chkipper/releases',
            'Development started' => 'https://github.com/hiqdev/chkipper/releases',
            'sol@hiqdev.com'      => 'https://github.com/hiqsol',
            '@hiqsol'             => 'https://github.com/hiqsol',
            'b22f8ac'             => 'https://github.com/hiqdev/chkipper/commit/b22f8ac',
        ]);
        $this->assertEquals($history, $this->object->getHistory());
    }
}
