<?php

namespace Model;

class User
{
    private $record = [];

    /**
     * ダミーオブジェクトを返す
     * 
     * @return User
     */
    public static function factoryNullObject()
    {
        return new static([]);
    }

    /**
     * ユーザーIDからオブジェクトを生成して返す
     * 
     * @param $userId
     *
     * @return User
     */
    public static function factoryById($userId)
    {
        $sql = 'SELECT * FROM users WHERE user_id = :user_id;';
        $bindParams = [
            ':user_id' => $userId,
        ];

        $record = \Model\Db::factory()->exec($sql, $bindParams)->as_current();
        if ($record === false) {
            $record = [];
        }

        return new static($record);
    }

    /**
     * ログインアカウント名からオブジェクトを生成して返す
     * 
     * @param $accountName
     *
     * @return User
     */
    public static function factoryByAccount($accountName)
    {
        $sql = 'SELECT * FROM users WHERE account_name = :account_name;';
        $bindParams = [
            ':account_name' => $accountName,
        ];

        $record = \Model\Db::factory()->exec($sql, $bindParams)->as_current();
        if ($record === false) {
            $record = [];
        }

        return new static($record);
    }

    /**
     * コンストラクタ
     *
     * @param array $record
     */
    private function __construct(array $record)
    {
        $this->record = $record;
    }

    /**
     * パスワードが正しいか検証する
     * 
     * @param $password
     *
     * @return bool
     */
    public function auth($password)
    {
        $hashedPassword = Arr::get($this->record, 'password', '');
        return Password::verify($password, $hashedPassword);
    }

    /**
     * ログインしている状態なら真を返す
     * 
     * @return bool
     */
    public function isLoggedIn()
    {
        return is_numeric($this->userId()) && $this->userId() > 0;
    }

    /**
     * ユーザーIDを返す
     * 
     * @return int
     */
    public function userId()
    {
        return Arr::get($this->record, 'user_id', 0);
    }

    /**
     * ユーザー名を返す
     * 
     * @return string
     */
    public function userName()
    {
        return Arr::get($this->record, 'label', '');
    }

    /**
     * @return string
     */
    public function __toString()
    {   
        return (string) print_r($this->record, true);
    }
}