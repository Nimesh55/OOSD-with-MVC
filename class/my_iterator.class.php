<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
class My_Iterator implements Iterator {

    private $arr = array();

    public function __construct($array) {
        $this->arr = $array;
    }

    public function rewind() {
        reset($this->arr);
    }

    public function current() {
        return current($this->arr);
    }

    public function valid() {
        return $this->current() !== false;
    }

    public function next() {
        return next($this->arr);
    }

    public function key() {
        return key($this->arr);
    }
}