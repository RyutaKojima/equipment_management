<?php

namespace Model;

/**
 * プルダウンの選択リストを作成するクラス
 *
 * @package Model
 */
class FactorySelectList
{
    /**
     * SQLでDBからデータを取得し、[ID => 表示名] の形の連想配列を返す
     * 
     * @param string $sql
     * @param array $bindParams
     *
     * @return string[]
     */
    private static function fetchSqlAsIdLabelArray($sql, array $bindParams = [])
    {
        // DBからレコードの配列を取得
        $records = \Model\Db::factory()->exec($sql, $bindParams)->as_array();

        // キーがID, 値が表示名の形の連想配列に変換する
        $return = [];
        foreach ($records as $record) {
            $id = Arr::get($record, 'id', null);
            $label = Arr::get($record, 'label', '');

            if ($id) {
                // キーがID, 値が表示名の形
                $return[$id] = $label;
            }
        }

        return $return;
    }

    /**
     * 指定テーブルからデータを取得し、プルダウン用のリストを返す
     * 
     * @param string $tableName   テーブル名
     * @param bool   $isLiveOnly  有効な項目だけを取得するか
     *
     * @return array
     */
    public static function tableAsArray($tableName, $isLiveOnly=true)
    {
        static $cache = [];
        if ( ! isset($cache[$tableName])) {
            $bindParams = [];

            if ($isLiveOnly) {
                $whereParams[] = 'deleted_at = :deleted_at';
                $bindParams[':deleted_at'] = '1000-01-01 00:00:00';
            }

            if (empty($whereParams)) {
                $sql = "SELECT id, label FROM {$tableName} ORDER BY sort_order ASC;";
            } else {
                $where = implode(' AND ', $whereParams);
                $sql = "SELECT id, label FROM {$tableName} WHERE {$where} ORDER BY sort_order ASC;";
            }            
            $cache[$tableName] = self::fetchSqlAsIdLabelArray($sql, $bindParams);
        }
        return $cache[$tableName];
    }
}