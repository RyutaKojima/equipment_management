<?php

namespace Controller\Admin;

use Model\User;
use Model\Arr;

class Signin extends \Controller\Controller
{
    protected $pageTitle = 'ログイン';

    public function before()
    {
        $loggedInUser = \Model\Auth::factoryLoggedInUser();

        if ($loggedInUser->isLoggedIn()) {
            // ログイン中のホームへリダイレクト
            $this->redirectToAdminHome();
        }
    }

    public function get(array $input=[])
    {
        $input = array_merge($input, $_GET);

        $account = Arr::get($input, 'account', '');
        $errors = Arr::get($input, 'errors', []);

        $data = [
            'account' => $account,
            'errors' => $errors,
        ];

        return \Model\View::import('admin/signin', $data);
    }

    public function post()
    {
        $input = $_POST;

        $account = Arr::get($input, 'account', '');
        $password = Arr::get($input, 'password', '');

        $user = User::factoryByAccount($account);
        if ($user->auth($password)) {
            // Session にログイン情報を保存
            \Model\Auth::saveLogIn($user->userId());

            // ログイン中のホームへリダイレクト
            $this->redirectToAdminHome();
        } else {
            $input['errors'] = ['IDまたはパスワードが間違っています'];
            return $this->get($input);
        }
    }
    
    private function redirectToAdminHome()
    {
        \Model\Uri::redirect('/admin/menu');
    }
}