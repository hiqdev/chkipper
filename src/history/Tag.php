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
 * History tag.
 * Represents a version with notes.
 *
 * @property string $name
 * @property string $name
 * @property array  $notes: note => note object
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

    /**
     * Appends note along with commmits.
     * @param Note $note
     */
    public function addNote(Note $note)
    {
        $this->findNote($note->getNote())->addCommits($note->getCommits());
    }

    /**
     * Appends notes along with commits.
     * @param Note[] $notes array of notes
     */
    public function addNotes(array $notes)
    {
        foreach ($notes as $note) {
            $this->addNote($note);
        }
    }

    /**
     * Set notes.
     * @param Note[] $notes array of notes
     */
    public function setNotes(array $notes)
    {
        $this->_notes = $notes;
    }

    /**
     * Sets date.
     * Checks if it is date and later then current.
     * @param mixed $value date
     * @return Tag this
     */
    public function setDate($value)
    {
        $timestamp = strtotime($value);
        if ($timestamp !== false && $timestamp > $this->_date) {
            $this->_date = $timestamp;
        }

        return $this;
    }

    /**
     * Unsets date.
     */
    public function unsetDate()
    {
        $this->_date = null;

        return $this;
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
    /**
     * Finds date of the tag which is the date of the latest commit.
     * @return string|null date or null if no commits
     */
    public function findDate()
    {
        $max = '';
        foreach ($this->getNotes() as $note) {
            foreach ($note->getCommits() as $commit) {
                $date = $commit->getDate();
                if (strcmp($date, $max) > 0) {
                    $max = $date;
                }
            }
        }

        return $max ?: null;
    }
}
