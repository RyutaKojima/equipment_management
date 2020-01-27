<?php

namespace Controller\Admin\Documents;


use Model\Arr;
use Model\Document;

class Registconfirm extends \Controller\Admin\AuthedBase
{
    protected $pageTitle = '資料登録-内容確認';

    public function get()
    {
        return \Model\View::import('error/404', []);
    }

    public function post()
    {
        $input = $_POST;

        $document = Document::factoryNew();

        $doRegister = Arr::get($input, 'doRegister', false);
        
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

        $errors = [];
        if ($doRegister) {
            $document->save($this->loggedInUser);
            if ($document->get('document_id')) {
                // 成功したときの処理
                return \Model\View::import('admin/documents/regist_complete', []);
            }

            $errors[] = 'データの登録に失敗しました';
        }

        $data = [
            'errors' => $errors,
            'document' => $document,
        ];
        return \Model\View::import('admin/documents/regist_confirm', $data);
    }
}