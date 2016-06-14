<?php

namespace hiqdev\chkipper\history;

class Builder
{
    public $lastTag = 'Under development';

    public $initTag = 'Development started';

    /**
     * @var string current tag
     */
    protected $_tag;

    /**
     * @var string current note
     */
    protected $_note;

    /**
     * @var string current commit's hash
     */
    protected $_hash;

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

    public function addTag($tag, $label = null)
    {
        $this->setTag($tag);
        $this->getHistory()->addTag($tag, $label);
    }

    public function addNote($note, $label = null)
    {
        $this->setNote($note);
        $this->getHistory()->addNote($this->getTag(), $note, $label);
    }

    public function addHash($hash, $label)
    {
        $this->setHash($hash);
        $this->getHistory()->addHash($this->getTag(), $this->getNote(), $hash, $label);
    }

    public function addText($text)
    {
        $this->getHistory()->addText($this->getTag(), $this->getNote(), $this->getHash(), $text);
    }

    public function getLastTag()
    {
        return $this->lastTag;
    }

    public function getInitTag()
    {
        return $this->lastTag;
    }

    public function getSpecialTags()
    {
        return [$this->lastTag, $this->initTag];
    }

    public function isSpecialTag($label)
    {
        foreach ($this->getSpecialTags() as $z) {
            if (stripos($label, $z) !== false) {
                return $z;
            }
        }

        return false;
    }

    public function parsePath($path, $minimal = null)
    {
        $this->addTag($this->getLastTag());

        $lines = is_file($path) ? file($path) : [];
        $no = 0;
        foreach ($lines as $str) {
            $str = rtrim($str);
            ++$no;

            /// skip empty lines
            if (!$str) {

            /// getting headers
            } elseif ($no <= 2 || preg_match('/^# /', $str)) {
                $this->addHeader($str);

            /// getting tags
            } elseif (preg_match('/^## ((\S+)\s*.*)$/', $str, $m)) {
                $label = $m[1];
                $this->addTag($this->isSpecialTag($label) ?: $m[2], $label);

            /// getting notes
            } elseif (preg_match('/^- (.*)$/', $str, $m)) {
                $this->addNote($m[1]);

            /// getting hashes
            } elseif (preg_match('/^\s+- ([0-9a-fA-F]{7})/', $str, $m)) {
                $this->addHash($m[1], $str);

            /// getting additional texts
            } else {
                $this->addText($str);
            }
        }
    }

}
