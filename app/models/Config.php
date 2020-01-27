<?php

namespace Model;

class Config
{
    private static $config = null;

    public static function get($key = null)
    {
        // 設定ファイルの中身を読み込み、変数に保存します
        if (self::$config === null) {
            self::$config = include(APPPATH . 'config/config.php');
        }

        // 設定配列から、指定のキーの値を返します
        return Arr::get(self::$config, $key);
    }
}