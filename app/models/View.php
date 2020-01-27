<?php

namespace Model;


class View
{
    /**
     * app/views/ 以下にあるテンプレートファイルを展開して内容を返す
     * 
     * @param null $file
     * @param null $data
     *
     * @return false|string
     */
    public static function import($file = null, $data = null)
    {
        if (empty($file) || ! is_string($file)) {
            return '';
        }

        // 出力を内部バッファに保存
        ob_start();

        try {
            include APPPATH . 'views/' . $file . '.php';
        }
        catch (\Exception $e) {
            ob_end_clean();
            Log::error($e);
        }

        // 内部バッファの内容を返してから消去
        return ob_get_clean();
    }
}