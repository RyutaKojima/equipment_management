<?php

namespace Model;


class Auth
{
    /**
     * ログインユーザーのオブジェクトを生成して返す
     * 
     * @return User
     */
    public static function factoryLoggedInUser()
    {
        $isLoggedIn = \Model\Session::get('isLoggedIn');
        if ( ! $isLoggedIn) {
             return \Model\User::factoryNullObject();
        }

        $userId = \Model\Session::get('loginUserId');
        return \Model\User::factoryById($userId);
    }

    /**
     * ログイン処理
     * ログイン状態をセッションに保存します
     * 
     * @param $userId
     */
    public static function saveLogIn($userId)
    {
        // セッションに保存するパラメータを定義
        $sessionParams = [
            'isLoggedIn' => true,
            'loginUserId' => $userId,
            'loginTime' => date('Y-m-d H:i:s'),
        ];

        // セッションに保存
        \Model\Session::set($sessionParams);
    }

    /**
     * ログアウト処理
     * ログイン状態をセッションから削除します
     */
    public static function saveLogOut()
    {
        \Model\Session::clear();
    }
}