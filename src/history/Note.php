<?php

namespace hiqdev\chkipper\history;

class Note
{
    protected $_note;
    protected $_label;
    protected $_hashes = [];

    public function __construct($note, $label = null)
    {
        $this->_note  = $note;
        $this->_label = $label ?: $note;
    }

    public function setLabel($label, $note = null)
    {
        $this->_label = $label ?: $this->_label ?: $note;
    }

    public function findHash($hash)
    {
        if (!isset($this->_hashes[$hash])) {
            $this->_hashes[$hash] = new Hash($hash);
        }

        return $this->_hashes[$hash];
    }
}
