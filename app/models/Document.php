<?php

namespace Model;


class Document
{
    /** @var string プライマリキーのカラム名 */
    const PRIMARY_KEY = 'document_id';

    /** @var array */
    private $record = [];

    /**
     * 新規の資料オブジェクトを作成する
     *
     * @return Document
     */
    public static function factoryNew()
    {
        return new static();
    }

    /**
     * 既存の資料データをロードしてオブジェクトを作成する
     *
     * @param $id
     *
     * @return Document
     */
    public static function factoryById($id)
    {
        // 資料データをDBから読み込む
        $sql = 'SELECT * FROM documents WHERE document_id = :document_id;';
        $bindParams = [
            ':document_id' => $id,
        ];
        $record = \Model\Db::factory()->exec($sql, $bindParams)->as_current();

        if ($record === false) {
            $record = [];
        }

        // 読み込んだデータから資料オブジェクトを生成して返す
        return new static($record);
    }

    /**
     * 資料データレコードからオブジェクトを生成する
     *
     * @param $record
     *
     * @return Document
     */
    public static function factoryByRecord($record)
    {
        return new static($record);
    }

    /**
     * コンストラクタ
     *
     * @param array $record
     */
    private function __construct(array $record = [])
    {
        $this->record = $record;
    }

    /**
     * 「種別」id => 表記ラベル名 の形の連想配列を返す
     *
     * @return string[]
     */
    public static function getId2TypeAsArray()
    {
        // app/config/config.php に定義されています
        return Config::get('documents');
    }

    /**
     * この資料オブジェクトがDBに永続化されていればtrueを返す
     *
     * @return bool
     */
    public function exists()
    {
        return $this->get(self::PRIMARY_KEY) > 0;
    }

    /**
     * 種別の表記ラベル名を返す
     *
     * @return string
     */
    public function typeLabel()
    {
        // id => ラベル名 形式の連想配列を取得
        $list = self::getId2TypeAsArray();

        // 種別IDを取得
        $id = $this->get('type_id');

        // 種別IDのラベルを返す
        return Arr::get($list, $id, '');
    }

    /**
     * 「ハード」の表記ラベル名を返す
     *
     * @return string
     */
    public function hardLabel()
    {
        // id => ラベル名 形式の連想配列を取得
        $list = FactorySelectList::tableAsArray('hard', false);

        // ハードIDを取得
        $id = $this->get('hard_id');

        // ハードIDのラベルを返す
        return Arr::get($list, $id, '');
    }

    /**
     * 登録者の表記ラベル名を返す
     *
     * @return mixed
     */
    public function registeredUserLabel()
    {
        // 登録者のリストを ID => ラベル名 の連想配列で取得
        $list = FactorySelectList::tableAsArray('registered_user', false);

        // 登録者のIDを取得
        $id = $this->get('registered_by_id');

        return Arr::get($list, $id, '');
    }

    /**
     * 日付型を任意のフォーマットで返す
     *
     * @param $key
     * @param $format
     *
     * @return string
     */
    public function getDateFormat($key, $format)
    {
        try {
            // 日付型に変換
            $date = new \DateTime(self::get($key));
            // 日付の形式を指定して返す
            return $date->format($format);
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * カラムデータを取得する
     *
     * @param $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return Arr::get($this->record, $key, null);
    }

    /**
     * カラムデータを更新する
     *
     * @param string $key カラム名
     * @param mixed  $val 設定する値
     *
     * @return $this
     */
    public function set($key, $val)
    {
        $this->record[ $key ] = $val;

        return $this;
    }

    /**
     * パラメータ全ての <input type="hidden">HTMLタグを返す
     */
    public function htmlHidden()
    {
        $html = '';
        foreach ($this->record as $key => $value) {
            $html .= sprintf('<input type="hidden" name="%s" value="%s" >', $key, $value);
        }

        return $html;
    }

    /**
     * データをDBに永続化する
     *
     * @param User $loggedInUser
     *
     * @return $this
     */
    public function save(\Model\User $loggedInUser)
    {
        $sql = <<<__EOD__
INSERT INTO documents (
    type_id,
    title,
    hard_id,
    manufacturer,
    isbn,
    asin,
    issued_at,
    purchased_at,
    registered_by_id,
    remarks,
    created_at,
    updated_at
) VALUES (
    :type_id,
    :title,
    :hard_id,
    :manufacturer,
    :isbn,
    :asin,
    :issued_at,
    :purchased_at,
    :registered_by_id,
    :remarks,
    :created_at,
    :updated_at
); 
__EOD__;
        $bindParams = [
            ':type_id' => Arr::get($this->record, 'type_id'),
            ':title' => Arr::get($this->record, 'title'),
            ':hard_id' => Arr::get($this->record, 'hard_id'),
            ':manufacturer' => Arr::get($this->record, 'manufacturer'),
            ':isbn' => Arr::get($this->record, 'isbn'),
            ':asin' => Arr::get($this->record, 'asin'),
            ':issued_at' => Arr::get($this->record, 'issued_at'),
            ':purchased_at' => Arr::get($this->record, 'purchased_at'),
            ':registered_by_id' => Arr::get($this->record, 'registered_by_id'),
            ':remarks' => Arr::get($this->record, 'remarks'),

            ':created_at' => date('Y-m-d H:i:s'),
            ':updated_at' => date('Y-m-d H:i:s'),
        ];

        $db = \Model\Db::factory();
        $db->exec($sql, $bindParams);
        $successful = $db->lastResult;
        if ($successful) {
            $id = $db->lastInsertId('document_id');
            if ($id) {
                $this->set('document_id', $id);
            }
        }
        else {
            \Model\Log::error($db->lastError);
        }

        return $this;
    }
}