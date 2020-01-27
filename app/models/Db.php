<?php

namespace Model;

/**
 * データベースへのアクセス・更新のためのクラス
 *
 * @package Model
 */
class Db
{
    public $lastResult = true;
    public $lastError = [];
    private $pdo = null;
    private $lastStatement = null;

    /**
     * コンストラクタ
     *
     * @param $host
     * @param $dbname
     * @param $username
     * @param $password
     * @param $option
     */
    private function __construct($host, $port, $dbname, $username, $password, $option)
    {
        // DB接続用のパラメータを作成
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8', $host, $port, $dbname);

        try {
            // DBに接続
            $this->pdo = new \PDO($dsn, $username, $password, $option);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    /**
     * DBに接続して、DB操作用のインスタンスを返します
     * 
     * @return Db
     */
    public static function factory()
    {
        // 2つ以上同じ接続を作らないように、前回の接続があれば使いまわします
        static $staticSelf = null;
        if ($staticSelf) {
            return $staticSelf;
        }

        // 設定ファイルから、接続情報を読み込み
        $host = Config::get('db.host');
        $port = Config::get('db.port');
        $dbname = Config::get('db.dbname');
        $username = Config::get('db.username');
        $password = Config::get('db.password');    
        $option = [];

        // DBへ接続し、操作用のインスタンスをかえします
        $staticSelf = new static($host, $port, $dbname, $username, $password, $option);
        return $staticSelf;
    }

    /**
     * SQLを実行します
     * 
     * @param       $sql
     * @param array $bindParams
     *
     * @return $this
     */
    public function exec($sql, array $bindParams = [])
    {
        $this->lastStatement = null;

        if ($this->pdo) {
            $this->lastStatement = $this->pdo->prepare($sql);

            $this->lastResult = $this->lastStatement->execute($bindParams);

            // 実行結果の成否を確認
            if ($this->lastResult) {
                // 成功
                $this->lastError = [];
            } else {
                // 失敗
                $this->lastError = $this->lastStatement->errorInfo();

                // デバッグ用：実行したSQLの情報をログファイルに書き出します
                ob_start();
                $this->lastStatement->debugDumpParams();
                $message = ob_get_clean();
                Log::error($message);
            }
        }

        return $this;
    }

    /**
     * execで INSERT文を実行された後、追加された行のカラムの値を返します。
     * 
     * @param $columnName
     *
     * @return string
     */
    public function lastInsertId($columnName)
    {
        return $this->pdo->lastInsertId($columnName);
    }

    /**
     * 最後にexecで実行したSQLの結果を１件分取得
     * 
     * @return array
     */
    public function as_current()
    {
        if ($this->lastStatement === null) {
            return [];
        }

        return $this->lastStatement->fetch(\PDO::FETCH_ASSOC);
    }


    /**
     * 最後にexecで実行したSQLの結果をすべて取得
     *
     * @return array
     */
    public function as_array()
    {
        if ($this->lastStatement === null) {
            return [];
        }

        return $this->lastStatement->fetchAll(\PDO::FETCH_ASSOC);
    }
}