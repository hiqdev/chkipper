<?php

namespace hiqdev\chkipper\tests\functional;

use hiqdev\chkipper\history\Parser;
use hiqdev\chkipper\history\History;
use hiqdev\chkipper\history\Tag;
use hiqdev\chkipper\history\Note;
use hiqdev\chkipper\history\Commit;

ini_set('xdebug.var_display_max_depth', 15);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

class ParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Parser
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
        $this->object = new Parser();
    }

    protected function tearDown()
    {
    }

    public function testMinimal()
    {
        $this->object->parsePath(__DIR__ . '/minimal.md');
        $history = new History();
        $history->setHeaders([
            'hiqdev/chkipper commits history' => 'hiqdev/chkipper commits history',
            '-------------------------------' => '-------------------------------',
        ]);
        $history->setTags([
            $this->object->getLastTag() => new Tag(
                $this->object->getLastTag(),
                null,
                [
                    $this->note => new Note($this->note, [
                        $this->hash => new Commit($this->hash, $this->label, [
                            $this->comment => $this->comment,
                        ]),
                    ]),
                ]
            ),
            $this->object->getInitTag() => new Tag($this->object->getInitTag(), $this->date),
        ]);
        $history->addHash($this->hash, $this->label);
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
