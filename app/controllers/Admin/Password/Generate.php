<?php

namespace Controller\Admin\Password;

/**
 * DBに設定するパスワード文字列を作成する為の画面です
 *
 * @package Controller\Admin\Password
 */
class Generate extends \Controller\Admin\AuthedBase
{
    protected $pageTitle = 'パスワードの作成';

    public function get($input = null, $passwordHash = '')
    {
        if ($input) {
            $input = array_merge($_GET, $input);
        } else {
            $input = $_GET;
        }

        $data = [
            'password' => \Model\Arr::get($input, 'password', ''),
            'generatedHash' => $passwordHash,
        ];

        return \Model\View::import('admin/password/generate', $data);
    }

    public function post()
    {
        $input = $_POST;

        $rawPassword = \Model\Arr::get($input, 'password', '');
        $passwordHash = $rawPassword ? \Model\Password::generate($rawPassword) : '';

        return $this->get($input, $passwordHash);
    }
}