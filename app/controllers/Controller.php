<?php

namespace Controller;

abstract class Controller
{
    protected $pageTitle = 'Untitled';

    public function pageTitle()
    {
        return $this->pageTitle;
    }

    public function before()
    {

    }

    public function get()
    {
        return '';
    }
    
    public function post()
    {
        return '';
    }
}