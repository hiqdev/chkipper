<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\lib\parsers;

use UnexpectedValueException;

/**
 * Git log parser.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class GitLogParser extends AbstractParser
{
    public function parseGitLog()
    {
        exec("git log --date=short --pretty='format:%h %ad %s [%ae] %d'", $logs);

        return $this->parseLines($logs);
    }

    public function parseLines(array $lines)
    {
        $this->getHistory()->initTags();

        foreach ($lines as $line) {
            if (!preg_match('/^(\w+) (([0-9-]+) (.*?) \[.*?\]) *\(?(.*?)\)?$/', $line, $m)) {
                throw new UnexpectedValueException('failed parse git line');
            }
            $tag  = $this->matchTag($m[5]);
            $note = $this->matchNote($m[4]);
            if ($tag) {
                $this->addTag($tag, $m[3]);
            }
            if (false && $note) { /// disabled adding notes
                $this->addNote($note);
            }
            $this->addCommit($m[1], $m[2]);
        }

        return $this->getHistory();
    }

    /**
     * Finds first tag in given refs string.
     * @param string $str
     * @return string
     */
    public function matchTag($str)
    {
        $refs = explode(', ', $str);
        foreach ($refs as $ref) {
            if (preg_match('/^tag: (.*)$/', $ref, $m)) {
                return $m[1];
            }
        }

        return null;
    }

    public function matchNote($str)
    {
        return strpos($str, ' ') ? $str : null;
    }
}
