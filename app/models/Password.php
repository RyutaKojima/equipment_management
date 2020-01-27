<?php

namespace Model;

/**
 * パスワードの管理をするためのクラス
 *
 * @package Model
 */
class Password
{
    /**
     * パスワード保存用ハッシュ値の作成
     * 
     * @param string $rawPassword パスワードの文字列
     *
     * @return bool|string
     */
    public static function generate($rawPassword)
    {
        // パスワードハッシュの作成は標準関数を使う
        return password_hash($rawPassword, PASSWORD_DEFAULT );
    }

    /**
     * パスワードの検証
     * 
     * @param string $rawPassword      パスワード文字列
     * @param string $hashedPassword   保存しているパスワードハッシュ
     *
     * @return bool
     */
    public static function verify($rawPassword, $hashedPassword)
    {
        // パスワードが空なら認証NG
        if (empty($rawPassword)) {
            return false;
        }

        // パスワードハッシュが空なら認証NG
        if (empty($hashedPassword)) {
            return false;
        }

        // パスワードのチェックは標準関数を使う
        return password_verify($rawPassword, $hashedPassword);
    }
}