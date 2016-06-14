<?php

namespace hiqdev\chkipper\history;

class Tag
{
    protected $_tag;
    protected $_label;
    protected $_notes = [];

    public function __construct($tag, $label = null)
    {
        $this->_tag   = $tag;
        $this->_label = $label ?: $tag;
    }

    public function setLabel($label, $tag = null)
    {
        $this->_label = $label ?: $this->_label ?: $tag;
    }

    public function findNote($note)
    {
        if (!isset($this->_notes[$note])) {
            $this->_notes[$note] = new Note($note);
        }

        return $this->_notes[$note];
    }
}
