<?php

/*
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\history;

/**
 * Tag class.
 * Holds tag:
 * - name
 * - date
 * - list of notes.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class Tag
{
    protected $_name;
    protected $_date;
    protected $_notes = [];

    public function __construct($tag, $date = null, array $notes = [])
    {
        if ($tag instanceof self) {
            $this->set($tag);
        } else {
            $this->setName($tag);
            $this->setDate($date);
            $this->setNotes($notes);
        }
    }

    public function set(Tag $tag)
    {
        $this->setName($tag->getName());
        $this->setDate($tag->getDate());
        $this->setNotes($tag->getNotes());
    }

    public function setName($value)
    {
        if ($value) {
            $this->_name = $value;
        }
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setNotes(array $notes)
    {
        $this->_notes = $notes;
    }

    /**
     * Sets date.
     * Checks if it is date and later then current.
     * @param mixed $value date
     */
    public function setDate($value)
    {
        $timestamp = strtotime($value);
        if ($timestamp !== false && $timestamp > $this->_date) {
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
