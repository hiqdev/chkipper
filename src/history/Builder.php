<?php

namespace hiqdev\chkipper\history;

class Builder
{
    public $lastTag = 'Under development';

    public $initTag = 'Development started';

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

    public function getHistory()
    {
        if ($this->_history === null) {
            $this->_history = new History;
        }

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
        $this->_hash = (string) $hash;
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
        $this->getHistory()->addTag($tag, $date);
    }

    public function addNote($note)
    {
        $this->setNote($note);
        $this->getHistory()->addNote($this->getTag(), $note, $label);
    }

    public function addCommit($hash, $label)
    {
        $this->setHash($hash);
        $this->getHistory()->addCommit($this->getTag(), $this->getNote(), $hash, $label);
    }

    public function addComment($comment)
    {
        $this->getHistory()->addComment($this->getTag(), $this->getNote(), $this->getHash(), $comment);
    }

    public function addLink($link, $href)
    {
        $this->getHistory()->addLink($link, $href);
    }

    public function getLastTag()
    {
        return $this->lastTag;
    }

    public function getInitTag()
    {
        return $this->initTag;
    }

}
