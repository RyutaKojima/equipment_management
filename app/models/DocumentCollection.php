<?php

namespace Model;


class DocumentCollection
{
    private $documents = [];

    /**
     * 資料オブジェクトの配列をロードする
     * 
     * @param array $filterParams
     *
     * @return DocumentCollection
     */
    public static function factory(array $filterParams = [])
    {
        $wheres = [];
        $bindParams = [];

        // 「種別」の絞り込み用 WHERE句を作成
        $typeIds = Arr::get($filterParams, 'type_id', []);
        if ($typeIds) {
            $typeIds = array_map(function($v){ return (int)$v; }, $typeIds);
            $wheres[] = 'type_id IN (' . implode(',', $typeIds) . ')';
        }

        // SQL文を作成
        $sql = 'SELECT * FROM documents';
        if ($wheres) {
            $sql .= ' WHERE ' . implode(' AND ', $wheres);
        }
        $sql .= ' ORDER BY document_id;';

        // SQLを実行して、結果の配列を取得
        $records = \Model\Db::factory()->exec($sql, $bindParams)->as_array();

        // DBのレコード配列を使ってインスタンス化
        return new static($records);
    }

    /**
     * コンストラクタ
     *
     * @param array $records
     */
    private function __construct(array $records=[])
    {
        $this->documents = [];
        
        foreach ($records as $record)
        {
            $this->documents[] = \Model\Document::factoryByRecord($record);
        }
    }

    /**
     * 資料オブジェクトの配列を取得
     * 
     * @return Document[]
     */
    public function asArray()
    {
        return $this->documents;
    }
}
