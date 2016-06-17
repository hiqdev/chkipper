<?php

namespace hiqdev\chkipper\history;

/**
 * Tag class.
 * Holds tag, it's date and list of notes.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
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

    public function getTag()
    {
        return $this->_tag;
    }

    public function setDate($value)
    {
        $timestamp = strtotime($value);
        if ($timestamp !== FALSE) {
            $this->_date = $timestamp;
        }
    }

    public function getDate()
    {
        return $this->_date ? date('Y-m-d', $this->_date) : null;
    }

    public function findNote($note)
    {
        if (!isset($this->_notes[$note])) {
            $this->_notes[$note] = new Note($note);
        }

        return $this->_notes[$note];
    }

    public function getNotes()
    {
        return $this->_notes;
    }
}
