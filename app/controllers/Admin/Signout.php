<?php

namespace Controller\Admin;

class Signout extends \Controller\Controller
{
    public function get(array $input=[])
    {
        \Model\Auth::saveLogOut();

        \Model\Uri::redirect('/home');
    }

    public function post()
    {
        return $this->get();
    }
}