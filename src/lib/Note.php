<?php
/**
 * Changelog keeper
 *
 * @link      https://github.com/hiqdev/chkipper
 * @package   chkipper
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\chkipper\lib;

/**
 * Note class.
 *
 * @property string $note
 * @property Commit[] $commits
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class Note
{
    /**
     * @var string note
     */
    protected $_note;

    /**
     * @var Commit[] array of commits
     */
    protected $_commits = [];

    public function __construct($note, $commits = [])
    {
        $this->_note    = $note;
        $this->_commits = $commits;
    }

    public function findCommit($hash)
    {
        if (!isset($this->_commits[$hash])) {
            $this->_commits[$hash] = new Commit($hash);
        }

        return $this->_commits[$hash];
    }

    public function removeCommit($hash)
    {
        unset($this->_commits[$hash]);
    }

    public function removeCommits($hashes)
    {
        foreach ($hashes as $hash) {
            $this->removeCommit($hash);
        }
    }

    /**
     * Appends commit along with comments.
     * @param Commit commit object
     */
    public function addCommit(Commit $commit)
    {
        $new = $this->findCommit($commit->getHash());
        $new->setLabel($commit->getLabel());
        $new->addComments($commit->getComments());
    }

    /**
     * Appends commits along with comments.
     * @param Commit[] array of commits
     */
    public function addCommits(array $commits)
    {
        foreach ($commits as $commit) {
            $this->addCommit($commit);
        }
    }

    /**
     * Returns commits.
     * @return Commit[]
     */
    public function getCommits()
    {
        return $this->_commits;
    }

    public function setNote($value)
    {
        $this->_note = $value;
    }

    public function getNote()
    {
        return $this->_note;
    }
}
