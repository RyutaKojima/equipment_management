<?php

namespace Controller\Admin;

use Model\Session;
use Model\User;

class Menu extends AuthedBase
{
    protected $pageTitle = '管理者メニュー';

    public function get()
    {
        $data = [
            'user' => $this->loggedInUser,
        ];

        return \Model\View::import('admin/menu', $data);
    }
}