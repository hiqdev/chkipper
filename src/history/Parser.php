<?php

namespace hiqdev\chkipper\history;

class Parser extends Builder
{
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

            /// headers
            } elseif ($no <= 2 || preg_match('/^# /', $str)) {
                $this->addHeader($str);

            /// links
            } elseif (preg_match('/^\[(.*?)\]:\s+(.*)$/', $str, $m)) {
                $this->addLink($m[1], $m[2]);

            /// tags
            } elseif (preg_match('/^##\s+\[(.+)\]\s*-?\s*(.*)$/', $str, $m)) {
                $this->addTag($m[1], $m[2]);

            /// notes
            } elseif (preg_match('/^-\s+(.*)$/', $str, $m)) {
                $this->addNote($m[1]);

            /// commits
            } elseif (preg_match('/^\s+-\s+\[?([0-9a-fA-F]{7})\]?\s*(.*)$/', $str, $m)) {
                $this->addCommit($m[1], $m[2]);

            /// comments
            } else {
                $this->addComment($str);
            }
        }

        return $this->getHistory();
    }

}
