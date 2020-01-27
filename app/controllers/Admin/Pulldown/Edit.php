<?php

namespace Controller\Admin\Pulldown;


use Model\Arr;
use Model\Equipment;

class Edit extends \Controller\Admin\AuthedBase
{
    protected $pageTitle = 'プルダウン項目の管理';

    public function get($input = null, $isSaveComplete = false)
    {
        if (empty($input)) {
            $input = $_GET;
        }

        $editTableName = Arr::get($input, 'edit_table_name', '');

        $idLabel = [];
        if ($editTableName) {
            // DBからレコードの配列を取得
            $idLabel = \Model\FactorySelectList::tableAsArray($editTableName);
        }

        $data = [
            'is_save_complete' => $isSaveComplete,
            'edit_table_name' => $editTableName,
            'pulldown' => $idLabel,
        ];

        return \Model\View::import('admin/pulldown/edit', $data);
    }

    public function post()
    {
        $input = $_POST;

        // 編集対象のテーブル名
        $editTableName = Arr::get($input, 'edit_table_name', '');
        
        // 保存処理を実行するか否かのフラグ
        $isSave = ($editTableName) && Arr::get($input, 'is_save');

        // 保存処理が成功したか否かのフラグ
        $isSaveComplete = false;
        if ( ! $isSave) {
            return $this->get($input, $isSaveComplete);
        }

        // プライマリキーの配列(すでに存在するデータは1以上が、新規追加は0が入る
        $ids = Arr::get($input, 'ids');
        // 表示用ラベルの配列
        $labels = Arr::get($input, 'labels');

        // DBへの保存処理
        $sort_order = 1;
        $alive_ids = [];
        foreach ($ids as $key => $id) {
            $label = $labels[ $key ] ?: null;

            // $id が1以上なら、DBに存在するデータなのでアップデート処理
            if ($id) {
                $alive_ids[] = $id;

                $sql = "UPDATE {$editTableName} SET label = :label, sort_order = :sort_order WHERE id = :id;";
                $bindParams = [
                    ':id' => $id,
                    ':label' => $label,
                    ':sort_order' => $sort_order,
                ];
                \Model\Log::debug($sql);
                \Model\Log::debug($bindParams);
                $db = \Model\Db::factory();
                $db->exec($sql, $bindParams);
                if ($db->lastResult) {
                }
                else {
                    \Model\Log::error($db->lastError);
                }
            }
            // $id が0なら、DBに存在しないのでINSERT処理
            else {
                // ラベルが同じで、削除状態のデータがあれば復活させる。
                // ラベルデータがなければINSERTで新規追加する。

                // 削除状態で、ラベル名が同じデータがあるか検索する
                $sql = "SELECT * FROM {$editTableName} WHERE label = :label AND deleted_at > :deleted_at;";
                $bindParams = [
                    ':label' => $label,
                    ':deleted_at' => '1000-01-01 00:00:00',
                ];
                $records = \Model\Db::factory()->exec($sql, $bindParams)->as_array();

                // 同名のラベルが見つからない場合、新規で追加
                if (empty($records)) {
                    // 新規登録
                    $sql = "INSERT INTO {$editTableName} (label, sort_order) VALUES (:label, :sort_order);";
                    $bindParams = [
                        ':label' => $label,
                        ':sort_order' => $sort_order,
                    ];
                    \Model\Log::debug($sql);
                    \Model\Log::debug($bindParams);
                    $db = \Model\Db::factory();
                    $db->exec($sql, $bindParams);
                    if ($db->lastResult) {
                        $id = $db->lastInsertId('id');
                        if ($id) {
                            $alive_ids[] = $id;
                        }
                    }
                    else {
                        \Model\Log::error($db->lastError);
                    }
                }
                else {
                    // 同名のラベルが見つかった場合、削除状態から復活させる
                    $record = $records[0];
                    $revival_id = $record['id'];

                    $sql = "UPDATE {$editTableName} SET label = :label, sort_order = :sort_order, deleted_at = :deleted_at WHERE id = :id;";
                    $bindParams = [
                        ':id' => $revival_id,
                        ':label' => $label,
                        ':sort_order' => $sort_order,
                        ':deleted_at' => '1000-01-01 00:00:00',
                    ];
                    \Model\Log::debug($sql);
                    \Model\Log::debug($bindParams);

                    // SQL実行
                    $db = \Model\Db::factory();
                    $db->exec($sql, $bindParams);

                    // $db->lastResult がtrueならDB更新成功
                    if ($db->lastResult) {
                        $alive_ids[] = $revival_id;
                    }
                    else {
                        \Model\Log::error($db->lastError);
                    }
                }
            }

            $sort_order++;
        }

        // 指示されなかったアイテムを削除する
        $str_alive_ids = implode(', ', $alive_ids);
        $sql = "UPDATE {$editTableName} SET deleted_at = :set_deleted_at WHERE deleted_at = :find_deleted_at AND id NOT IN ({$str_alive_ids})";
        $bindParams = [
            ':set_deleted_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            ':find_deleted_at' => '1000-01-01 00:00:00',
        ];
        \Model\Log::debug($sql);
        \Model\Log::debug($bindParams);
        $db = \Model\Db::factory();
        $db->exec($sql, $bindParams);
        if ($db->lastResult) {
            $isSaveComplete = true;
        }
        else {
            \Model\Log::error($db->lastError);
        }

        return $this->get($input, $isSaveComplete);
    }
}
