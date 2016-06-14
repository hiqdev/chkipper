<?php

namespace hiqdev\chkipper\history;

class Hash
{
    protected $_hash;
    protected $_label;
    protected $_texts = [];

    public function __construct($hash, $label = null)
    {
        $this->_hash  = $hash;
        $this->_label = $label ?: $hash;
    }

    public function setLabel($label, $hash = null)
    {
        $this->_label = $label ?: $this->_label ?: $hash;
    }

    public function addText($text)
    {
        $this->_texts[$text] = $text;
    }
}
