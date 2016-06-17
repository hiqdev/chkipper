<?php

namespace hiqdev\chkipper\history;

class Tag
{
    protected $_tag;
    protected $_date;
    protected $_notes = [];

    public function __construct($tag, $date = null, array $notes = [])
    {
        $this->_tag = $tag;
        $this->setDate($date);
        $this->_notes = $notes;
    }

    public function setDate($date)
    {
        $timestamp = strtotime($date);
        if ($timestamp !== FALSE) {
            $this->_date = $timestamp;
        }
    }

    public function getDate()
    {
        return $date ? date('Y-m-d', $this->_date) : null;
    }

    public function findNote($note)
    {
        if (!isset($this->_notes[$note])) {
            $this->_notes[$note] = new Note($note);
        }

        return $this->_notes[$note];
    }
}
