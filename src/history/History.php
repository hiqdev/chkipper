<?php

namespace hiqdev\chkipper\history;

use Yii;

/**
 * History class.
 * Holds history of commits.
 */
class History
{
    protected $_tags = [];
    protected $_headers = [];
    protected $_commits = [];

    public function hasTag($tag)
    {
        return array_key_exists($tag, $this->_tags);
    }

    public function hasCommit($hash)
    {
        return array_key_exists((string) $hash, $this->_commits);
    }

    public function addHeader($str)
    {
        $this->_headers[$str] = $str;
    }

    public function findTag($tag)
    {
        if (!isset($this->_tags[$tag])) {
            $this->_tags[$tag] = new Tag($tag);
        }

        return $this->_tags[$tag];
    }

    public function addTag($tag, $label = null)
    {
        $this->findTag($tag)->setLabel($label);
    }

    public function addNote($tag, $note, $label = null)
    {
        $this->findTag($tag)->findNote($note)->setLabel($label);
    }

    public function addHash($tag, $note, $hash, $label = null)
    {
        $this->_commits[(string) $hash] = $label;
        $this->findTag($tag)->findNote($note)->findHash($hash)->setLabel($label);
    }

    public function addText($tag, $note, $hash, $text = null)
    {
        $this->findTag($tag)->findNote($note)->findHash($hash)->addText($text);
    }

    public function addHistory($commit, $front = false)
    {
        $tag    = $commit['tag'];
        $note   = $commit['note'];
        $hash   = $commit['hash'];
        $render = static::renderCommit($commit);
        $hashes = &$this->_tags[$tag][$note];
        $hashes = (array) $hashes;
        if ($front) {
            $hashes = [$hash => [$render]] + $hashes;
        } else {
            $hashes[$hash][] = $render;
        }
    }

    public function addGitLog()
    {
        foreach (array_reverse(static::getVcs()->commits, true) as $hash => $commit) {
            if ($this->hasCommit($hash)) {
                continue;
            }
            $this->addHistory($commit, true);
        }
        if (!$this->hasHistory(static::getVcs()->initTag)) {
            $this->addHistory(['tag' => static::getVcs()->initTag]);
        }
    }

    public function render($data)
    {
        $res = static::renderHeader('commits history');

        foreach ($this->_tags as $tag => $notes) {
            $prev = $res;
            $tag  = static::arrayPop($notes, 'tag') ?: $tag;
            $new  = static::arrayPop($notes, '') ?: [];
            $res .= static::renderTag($tag);
            $save = $res;
            foreach ($new as $hash => $lines) {
                $res .= static::renderLines($lines);
            }
            foreach ($notes as $note => $cs) {
                $note = static::arrayPop($cs, 'note');
                $res .= static::renderNote($note);
                foreach ($cs as $hash => $lines) {
                    $res .= static::renderLines($lines);
                }
            }
            if ($save === $res && stripos($tag, static::getVcs()->lastTag) !== false) {
                $res = $prev;
                unset($this->_tags[$tag]);
            }
        }

        return $res;
    }

    public static function arrayPop(&$array, $key)
    {
        $res = $array[$key];
        unset($array[$key]);

        return $res;
    }

    public static function renderNote($note)
    {
        return "- $note\n";
    }

    public static function renderLines(array $lines)
    {
        $res = implode("\n", array_filter($lines));

        return $res ? $res . "\n" : '';
    }

    public static function renderCommit($commit)
    {
        return static::skipCommit($commit) ? '' : "    - $commit[hash] $commit[date] $commit[comment] ($commit[email])";
    }

    public static function skipCommit($commit)
    {
        $comment = $commit['comment'];

        static $equals = [
            ''      => 1,
            'minor' => 1,
        ];
        if ($equals[$comment]) {
            return true;
        }

        static $starts = [
            'version bump',
            'bumped version',
            "merge branch 'master'",
        ];
        foreach ($starts as $start) {
            if (strtolower(substr($comment, 0, strlen($start))) === $start) {
                return true;
            }
        }

        return false;
    }

    public static function renderTag($tag)
    {
        if (strpos($tag, ' ') === false || $tag === static::getVcs()->initTag) {
            $tag .= static::renderDate(static::getVcs()->tags[$tag]);
        }

        return "\n## $tag\n\n";
    }

    public static function renderDate($date)
    {
        return $date ? date(' Y-m-d', strtotime($date)) : '';
    }

    public static function renderHeader($string)
    {
        $res = '';
        foreach ($this->_headers as $str) {
            $res .= $str . "\n";
        }
        return $res;
    }

    public static function getVcs()
    {
        return Yii::$app->get('config')->getVcs();
    }
}
