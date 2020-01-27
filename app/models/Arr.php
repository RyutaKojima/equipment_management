<?php

namespace Model;

class Arr
{
    /**
     * 配列から、ドット区切りで指定したキーの値を返します。
     * 指定したキーが存在しない場合、デフォルト値を返します。
     *
     * @param   array   $array    探す配列
     * @param   string  $key      ドット区切りのキー
     * @param   string  $default  見つからなかったときに返すデフォルト値
     * @return  mixed
     */
    public static function get($array, $key, $default = null)
    {
        // 配列型以外を指定した場合はデフォルト値を返します。
        if ( ! is_array($array) and ! $array instanceof \ArrayAccess) {
            return $default;
        }
        
        // 配列のキーに文字列、数値以外を指定した場合は配列をそのまま返します。
        if ( ! is_string($key) && ! is_numeric($key)) {
            return $array;
        }

        // 配列のキーを探し見つかった場合の値を返します。
        if (array_key_exists($key, $array)) {
            return $array[ $key ];
        }

        // ドット区切りでキーを分解し、多次元配列に存在するかを再帰的に探します。
        foreach (explode('.', $key) as $key_part) {
            // 配列キーが見つからず、配列型でもない場合その値を返します
            if (($array instanceof \ArrayAccess and isset($array[ $key_part ])) === false) {
                if ( ! is_array($array) or ! array_key_exists($key_part, $array)) {
                    return $default;
                }
            }
            $array = $array[ $key_part ];
        }

        return $array;
    }
}