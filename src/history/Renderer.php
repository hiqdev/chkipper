<?php

namespace hiqdev\chkipper\history;

/**
 * Renderer class.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class Renderer
{
    public function setHistory($value)
    {
        $this->_history = $value;
    }

    public function getHistory()
    {
        return $this->_history;
    }

    public function render()
    {
        return static::renderText([
            $this->renderHeaders(),
            $this->renderTags(),
            $this->renderLinks(),
        ]);
    }

    public function renderHeaders()
    {
        return static::renderText($this->getHistory()->getHeaders());
    }

    public function renderTags()
    {
        return $this->renderObjects('renderTag', $this->getHistory()->getTags());
    }

    public function renderLinks()
    {
        return $this->renderObjects('renderLink', $this->getHistory()->getLinks());
    }

    public function renderObjects($method, $objects)
    {
        return static::renderText(array_map([static::class, $method], $objects));
    }

    public static function renderText(array $lines)
    {
        $res = implode("\n", $lines);

        return $res ? $res . "\n" : '';
    }

    public static function renderLink($link)
    {
        return '';
    }

    public static function renderHeader($header)
    {
        return $header;
    }

    public static function renderTag($tag)
    {
        var_dump($tag);
        die();
        return $header;
    }
}
