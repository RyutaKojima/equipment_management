<?php

namespace Controller;

class Home extends \Controller\Controller
{
    protected $pageTitle = 'ホーム';

    public function get()
    {
        $data = [
        ];

        return \Model\View::import('home', $data);
    }
}