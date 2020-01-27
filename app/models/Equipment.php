<?php

namespace Model;

use Composer\Factory;

class Equipment
{
    /** @var string プライマリキーのカラム名 */
    const PRIMARY_KEY = 'equipment_id';

    /** @var array */
    private $record = [];

    /**
     * 新規の機材オブジェクトを作成する
     *
     * @return Document
     */
    public static function factoryNew()
    {
        return new static();
    }

    /**
     * 既存の機材データをロードしてオブジェクトを作成する
     *
     * @param $id
     *
     * @return Equipment
     */
    public static function factoryById($id)
    {
        $bindParams = [
            ':equipment_id' => $id,
        ];
        $sql = 'SELECT * FROM equipments WHERE equipment_id = :equipment_id;';

        $record = \Model\Db::factory()->exec($sql, $bindParams)->as_current();

        if ($record === false) {
            $record = [];
        }

        return new static($record);
    }

    /**
     * 機材データレコードからオブジェクトを生成する
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
    private function __construct($record = [])
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
        return Config::get('equipments');
    }

    /**
     * この機材オブジェクトがDBに永続化されていればtrueを返す
     *
     * @return bool
     */
    public function exists()
    {
        return $this->get(self::PRIMARY_KEY) > 0;
    }

    /**
     * 「種別」の表記ラベル名を返す
     *
     * @return string
     */
    public function typeLabel()
    {
        // id => ラベル名 形式の連想配列を取得
        $list = self::getId2TypeAsArray();

        // 種別IDを取得
        $id = $this->get('type_id');

        // 種別のラベルを返す
        return Arr::get($list, $id, '');
    }

    /**
     * 「区分け」の表記ラベル名を返す
     *
     * @return string
     */
    public function classificationLabel()
    {
        // id => ラベル名 形式の連想配列を取得
        $list = FactorySelectList::tableAsArray('classification', false);

        // 区分けIDを取得
        $id = $this->get('classification_id');

        // 区分けのラベルを返す
        return Arr::get($list, $id, '');
    }


    /**
     * 「OS」の表記ラベル名を返す
     *
     * @return string
     */
    public function osLabel()
    {
        // id => ラベル名 形式の連想配列を取得
        $list = FactorySelectList::tableAsArray('os', false);

        // 「OS」IDを取得
        $id = $this->get('os_id');

        // 「OS」のラベルを返す
        return Arr::get($list, $id, '');
    }

    /**
     * 「メーカー」の表記ラベル名を返す
     *
     * @return string
     */
    public function manufacturerLabel()
    {
        // id => ラベル名 形式の連想配列を取得
        $list = FactorySelectList::tableAsArray('manufacturer', false);

        // 「メーカー」IDを取得
        $id = $this->get('manufacturer_id');

        // 「メーカー」のラベルを返す
        return Arr::get($list, $id, '');
    }

    /**
     * 「CPU」の表記ラベル名を返す
     *
     * @return string
     */
    public function cpuLabel()
    {
        // id => ラベル名 形式の連想配列を取得
        $list = FactorySelectList::tableAsArray('cpu', false);

        // 「CPU」IDを取得
        $id = $this->get('cpu_id');

        // 「CPU」のラベルを返す
        return Arr::get($list, $id, '');
    }

    /**
     * 「HDD1」の表記ラベル名を返す
     *
     * @return string
     */
    public function hdd1Label()
    {
        // id => ラベル名 形式の連想配列を取得
        $list = FactorySelectList::tableAsArray('hdd', false);

        // 「HDD1」IDを取得
        $id = $this->get('hdd_1_id');

        // 「HDD1」のラベルを返す
        return Arr::get($list, $id, '');
    }

    /**
     * 「HDD2」の表記ラベル名を返す
     *
     * @return string
     */
    public function hdd2Label()
    {
        // id => ラベル名 形式の連想配列を取得
        $list = FactorySelectList::tableAsArray('hdd', false);

        // 「HDD2」IDを取得
        $id = $this->get('hdd_2_id');

        // 「HDD2」のラベルを返す
        return Arr::get($list, $id, '');
    }

    /**
     * 「グラフィクス」の表記ラベル名を返す
     *
     * @return string
     */
    public function graphicsLabel()
    {
        // id => ラベル名 形式の連想配列を取得
        $list = FactorySelectList::tableAsArray('graphics', false);

        // 「グラフィクス」IDを取得
        $id = $this->get('graphics_id');

        // 「グラフィクス」のラベルを返す
        return Arr::get($list, $id, '');
    }

    /**
     * 「メモリ」の表記ラベル名を返す
     *
     * @return string
     */
    public function memoryLabel()
    {
        // id => ラベル名 形式の連想配列を取得
        $list = FactorySelectList::tableAsArray('memory', false);

        // 「メモリ」IDを取得
        $id = $this->get('memory_id');

        // 「メモリ」のラベルを返す
        return Arr::get($list, $id, '');
    }

    /**
     * 「保証」の表記ラベル名を返す
     *
     * @return string
     */
    public function insureLabel()
    {
        // id => ラベル名 形式の連想配列を取得
        $list = FactorySelectList::tableAsArray('insure', false);

        // 「保証」IDを取得
        $id = $this->get('insure_id');

        // 「保証」のラベルを返す
        return Arr::get($list, $id, '');
    }

    /**
     * 「登録者」の表記ラベル名を返す
     *
     * @return string
     */
    public function registeredUserLabel()
    {
        // id => ラベル名 形式の連想配列を取得
        $list = FactorySelectList::tableAsArray('registered_user', false);

        // 「登録者」IDを取得
        $id = $this->get('registered_by_id');

        // 「登録者」のラベルを返す
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
            INSERT INTO equipments 
            (
              type_id, 
              classification_id, 
              os_id, 
              manufacturer_id, 
              title, 
              cpu_id, 
              ssd, 
              hdd_1_id, 
              hdd_2_id, 
              graphics_id, 
              memory_id, 
              has_drive, 
              insure_id, 
              serial, 
              login_name, 
              login_password, 
              purchased_at, 
              user_in_use, 
              registered_by_id, 
              remarks,
              created_at,
              updated_at
            ) VALUES (
              :type_id, 
              :classification_id, 
              :os_id, 
              :manufacturer_id, 
              :title, 
              :cpu_id, 
              :ssd, 
              :hdd_1_id, 
              :hdd_2_id, 
              :graphics_id, 
              :memory_id, 
              :has_drive, 
              :insure_id, 
              :serial, 
              :login_name, 
              :login_password, 
              :purchased_at, 
              :user_in_use, 
              :registered_by_id, 
              :remarks,
              :created_at,
              :updated_at
            );
__EOD__;
        $bindParams = [
            ':type_id' => Arr::get($this->record, 'type_id'),
            ':classification_id' => Arr::get($this->record, 'classification_id'),
            ':os_id' => Arr::get($this->record, 'os_id'),
            ':manufacturer_id' => Arr::get($this->record, 'manufacturer_id'),
            ':title' => Arr::get($this->record, 'title'),
            ':cpu_id' => Arr::get($this->record, 'cpu_id'),
            ':ssd' => Arr::get($this->record, 'ssd'),
            ':hdd_1_id' => Arr::get($this->record, 'hdd_1_id'),
            ':hdd_2_id' => Arr::get($this->record, 'hdd_2_id'),
            ':graphics_id' => Arr::get($this->record, 'graphics_id'),
            ':memory_id' => Arr::get($this->record, 'memory_id'),
            ':has_drive' => Arr::get($this->record, 'has_drive'),
            ':insure_id' => Arr::get($this->record, 'insure_id'),
            ':serial' => Arr::get($this->record, 'serial'),
            ':login_name' => Arr::get($this->record, 'login_name'),
            ':login_password' => Arr::get($this->record, 'login_password'),
            ':purchased_at' => Arr::get($this->record, 'purchased_at'),
            ':user_in_use' => Arr::get($this->record, 'user_in_use'),
            ':registered_by_id' => Arr::get($this->record, 'registered_by_id'),
            ':remarks' => Arr::get($this->record, 'remarks'),
            ':created_at' => date('Y-m-d H:i:s'),
            ':updated_at' => date('Y-m-d H:i:s'),
        ];

        $db = \Model\Db::factory();
        $db->exec($sql, $bindParams);
        $successful = $db->lastResult;
        if ($successful) {
            $id = $db->lastInsertId('equipment_id');
            if ($id) {
                $this->set('equipment_id', $id);
            }
        }
        else {
            Log::error($db->lastError);
        }

        return $this;
    }
}