<?php

namespace Model;


class Session
{
    /**
     * Sessionに保存した値を取得する
     * 
     * @param null $key
     * @param null $default
     *
     * @return mixed
     */
    public static function get($key=null, $default=null)
    {
        session_start();
        $val = Arr::get($_SESSION, $key, $default);
        session_write_close();
        
        return $val;
    }

    /**
     * Sessionに値を保存する
     * 
     * @param array $val
     */
    public static function set(array $val)
    {
        session_start();
        $_SESSION = $val;
        session_write_close();
    }

    /**
     * このセッションの値をすべて消す
     */
    public static function clear()
    {
        session_start();
        session_unset();
        session_write_close();
    }
}
