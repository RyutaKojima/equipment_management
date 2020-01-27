<?php

namespace Model;


class EquipmentCollection
{
    /** @var Equipment[] */
    private $equipments;

    /**
     * 登録済みの機材データの集合を管理するクラスを返す
     * 
     * @param array $filterParams
     *
     * @return EquipmentCollection
     */
    public static function factory(array $filterParams = [])
    {
        $wheres = [];
        $bindParams = [];

        // `type_id`の絞り込み用WHERE句を定義
        $typeIds = Arr::get($filterParams, 'type_id', []);
        if ($typeIds) {
            // 文字列型が入ることがあるので、int型にキャストする
            foreach ($typeIds as $idx => $val) {
                $typeIds[$idx] = (int)$val;
            }

            // type_id IN (1, 2, 3) の形に変換する
            $wheres[] = 'type_id IN (' . implode(',', $typeIds) . ')';
        }

        // SQL文を作成する
        $sql = 'SELECT * FROM equipments';

        // WHERE句の定義があれば、WHERE句をSQLに追加
        if ($wheres) {
            $sql .= ' WHERE ' . implode(' AND ', $wheres);
        }
        $sql .= ' ORDER BY equipment_id;';

        $records = Db::factory()->exec($sql, $bindParams)->as_array();

        return new static($records);
    }

    /**
     * コンストラクタ
     *
     * @param array $records DBから読み込んだレコードの配列
     */
    private function __construct(array $records=[])
    {
        $equipments = [];
        foreach ($records as $record)
        {
            $equipments[] = Equipment::factoryByRecord($record);
        }

        $this->equipments = $equipments;
    }

    /**
     * @return Equipment[]
     */
    public function asArray()
    {
        return $this->equipments;
    }
}