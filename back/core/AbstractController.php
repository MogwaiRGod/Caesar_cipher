<?php

namespace core;

abstract class AbstractController {
    protected $content = [];

    public function set($data) : void {
        $this->content = array_merge($this->content, $data);
    }

    public function render($fileName) : void {
        extract($this->content);

        require(ROOT . 'front/' . $fileName . '.html');
    }
}