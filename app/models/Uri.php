<?php

namespace Model;


class Uri
{
    /**
     * アプリケーションで利用するURLの形式を作成する
     * 
     * @param       $path
     * @param array $args
     *
     * @return string
     */
    public static function make($path, array $args = [])
    {
        $REQUEST_URI = $_SERVER['REQUEST_URI'];
        if (preg_match('/^(.*index.php)/', $REQUEST_URI, $matches)) {
            $base_uri = $matches[1];
        } else {
            $base_uri = $REQUEST_URI . 'index.php';
        }

        // 先頭がスラッシュの場合外す
        if (strpos($path, '/') === 0) {
            $path = substr($path, 1);
        }
        array_walk($args, function(&$v, $k) { $v = sprintf('%s=%s', $k, $v); });
        $queryString = implode('&', $args);
        if ($queryString) {
            return $base_uri . '/' . $path . '?' . $queryString;
        }

        return $base_uri . '/' . $path;
    }

    /**
     * アプリケーション内の別画面へリダイレクトする
     * 
     * @param       $path
     * @param array $args
     */
    public static function redirect($path, array $args = [])
    {
        header('Location: ' . static::make($path, $args));
        exit;
    }
}