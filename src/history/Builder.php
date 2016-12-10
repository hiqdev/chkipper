<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\history;

/**
 * History builder class.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class Builder
{
    /**
     * @var string current tag
     */
    protected $_tag = '';

    /**
     * @var string current note
     */
    protected $_note = '';

    /**
     * @var string current commit's hash
     */
    protected $_hash = '';

    /**
     * @var History history object
     */
    protected $_history;

    public function __construct(History $history = null)
    {
        $this->setHistory($history);
    }

    public function setHistory(History $history = null)
    {
        $this->_history = is_null($history) ? new History() : $history;
    }

    public function getHistory()
    {
        return $this->_history;
    }

    public function setTag($tag)
    {
        $this->_tag  = $tag;
        $this->setNote('');
    }

    public function setNote($note)
    {
        $this->_note = $note;
        $this->setHash('');
    }

    public function setHash($hash)
    {
        if ($hash) {
            $this->_hash = (string) $hash;
            $this->getHistory()->addHash($hash);
        }
    }

    public function getTag()
    {
        return $this->_tag;
    }

    public function getNote()
    {
        return $this->_note;
    }

    public function getHash()
    {
        return $this->_hash;
    }

    public function addHeader($header)
    {
        $this->getHistory()->addHeader($header);
    }

    public function addTag($tag, $date = null)
    {
        $this->setTag($tag);

        return $this->getHistory()->addTag(new Tag($tag, $date));
    }

    public function addNote($note)
    {
        $this->setNote($note);
        $this->getHistory()->findTag($this->getTag())->findNote($note);
    }

    public function addCommit($hash, $label)
    {
        $commit = new Commit($hash, $label);
        if (!$this->skipCommit($commit)) {
            $this->setHash($hash);
            $this->getHistory()->findTag($this->getTag())->findNote($this->getNote())->findCommit($hash)->setLabel($label);
        }
    }

    public function addComment($comment)
    {
        $this->getHistory()->findTag($this->getTag())->findNote($this->getNote())->findCommit($this->getHash())->addComment($comment);
    }

    public function addLink($link, $href)
    {
        $this->getHistory()->addLink($link, $href);
    }

    public function getLastTag()
    {
        return $this->getHistory()->lastTag;
    }

    public function getInitTag()
    {
        return $this->getHistory()->initTag;
    }

    public static function skipCommit(Commit $commit)
    {
        $subject = $commit->getSubject();

        static $equals = [
            ''       => 1,
            'bump'   => 1,
            'minor'  => 1,
            'bumped' => 1,
        ];
        if (isset($equals[$subject])) {
            return true;
        }

        static $starts = [
            'version bump',
            'bumped version',
            "merge branch 'master'",
        ];
        foreach ($starts as $start) {
            if (strtolower(substr($subject, 0, strlen($start))) === $start) {
                return true;
            }
        }

        return false;
    }
}
