<?php

namespace Controller\Admin;

use Controller\Controller;

abstract class AuthedBase extends Controller
{
    protected $loggedInUser;

    public function before()
    {
        $this->loggedInUser = \Model\Auth::factoryLoggedInUser();

        if ( ! $this->loggedInUser->isLoggedIn()) {
            // ログイン画面にリダイレクト
            \Model\Uri::redirect('/admin/signin');
        }
    }
}