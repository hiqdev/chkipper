<?php

namespace hiqdev\chkipper\history;

class Link
{
    protected $_link;
    protected $_href;

    public function __construct($link, $href)
    {
        $this->_link = $link;
        $this->_href = $href;
    }

    public function getLink()
    {
        return $this->_link;
    }

    public function getHref()
    {
        return $this->_href;
    }
}
