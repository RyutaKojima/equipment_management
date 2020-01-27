<?php

namespace Model;


class Log
{
    /**
     * ログの保存先ディレクトリがなければ作成し、ログファイルの保存先パスを返す
     *
     * @return string
     * @throws \Exception
     */
    private static function logFile()
    {
        // 現在日時取得用のオブジェクトを生成
        $date = new \DateTime();

        // ログファイルパスを生成（年/月 ディレクトリの中に、日にち.log）
        $logFile = APPPATH . '/logs/' . $date->format('Y/m/d') . '.log';

        // ログ保存先ディレクトリを取得
        $dir = dirname($logFile);

        // ディレクトリがなければ作る
        if ( ! file_exists($dir)) {
            if ( ! mkdir($dir, 0777, true) && ! is_dir($dir)) {
                throw new Exception('Failed create directory');
            }
        }

        return $logFile;
    }

    /**
     * エラーログ出力
     *
     * @param $message
     */
    public static function error($message)
    {
        try {
            $mask = umask();

            if ( ! is_string($message)) {
                ob_start();
                var_dump($message);
                $message = ob_get_clean();
            }

            $backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1)[0];
            $callerInfo = sprintf('%s %s-line', $backtrace['file'], $backtrace['line']);

            $out = '[' . date('Y-m-d H:i:s') . '] ' . $callerInfo . ' :' . $message . PHP_EOL;

            file_put_contents(static::logFile(), $out, FILE_APPEND);
            umask($mask);
        }
        catch (\Exception $e) {
            // 何もしない
        }
    }

    /**
     * デバッグログ出力
     *
     * @param $message
     */
    public static function debug($message)
    {
        if (Config::get('env') !== 'debug') {
            return;
        }

        try {
            $mask = umask();

            if ( ! is_string($message)) {
                ob_start();
                var_dump($message);
                $message = ob_get_clean();
            }

            $backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1)[0];
            $callerInfo = sprintf('%s %s-line', $backtrace['file'], $backtrace['line']);

            $out = '[' . date('Y-m-d H:i:s') . '] ' . $callerInfo . ' :' . $message . PHP_EOL;

            file_put_contents(static::logFile(), $out, FILE_APPEND);
            umask($mask);
        }
        catch (\Exception $e) {
            // 何もしない
        }
    }
}