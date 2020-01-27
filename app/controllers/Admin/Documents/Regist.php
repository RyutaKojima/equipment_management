<?php

namespace Controller\Admin\Documents;


use Model\Arr;
use Model\Document;
use Model\FactorySelectList;
use Model\Session;

class Regist extends \Controller\Admin\AuthedBase
{
    protected $pageTitle = '資料登録';

    public function get($input = null, $errors = [])
    {
        if ($input) {
            $input = array_merge($_GET, $input);
        } else {
            $input = $_GET;
        }

        $selectList = [
            // 設定ファイルから、機材の「種別」リストを読み込む
            //  app/config/config.php の 'documents'で定義しています
            'type' => Document::getId2TypeAsArray(),

            // DBから「ハード」の選択リストを読み込む
            'hard' => FactorySelectList::tableAsArray('hard'),
            // DBから「登録者」の選択リストを読み込む
            'registered_user' => FactorySelectList::tableAsArray('registered_user'),
        ];

        $data = [
            'errors' => $errors,
            'input' => $input,
            'select_list' => $selectList,
        ];

        return \Model\View::import('admin/documents/regist', $data);
    }

    public function post()
    {
        $input = $_POST;

        $document = Document::factoryNew();

        $document->set('type_id', Arr::get($input, 'type_id'));
        $document->set('title', Arr::get($input, 'title'));
        $document->set('hard_id', Arr::get($input, 'hard_id', 0));
        $document->set('manufacturer', Arr::get($input, 'manufacturer'));
        $document->set('isbn', Arr::get($input, 'isbn'));
        $document->set('asin', Arr::get($input, 'asin'));
        $document->set('issued_at', Arr::get($input, 'issued_at'));
        $document->set('purchased_at', Arr::get($input, 'purchased_at'));
        $document->set('registered_by_id', Arr::get($input, 'registered_by_id', 0));
        $document->set('remarks', Arr::get($input, 'remarks'));

        $document->save($this->loggedInUser);
        if ($document->get('document_id')) {
            // 成功したときの処理
            return \Model\View::import('admin/documents/regist_complete', []);
        }

        return $this->get($input, ['データの登録に失敗しました']);
    }
}