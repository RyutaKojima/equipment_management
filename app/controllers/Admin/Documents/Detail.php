<?php

namespace Controller\Admin\Documents;


use Model\Arr;
use Model\Document;

class Detail extends \Controller\Controller
{
    protected $pageTitle = '資料詳細';

    public function get()
    {
        $id = Arr::get($_GET, 'id');
        $document = Document::factoryById($id);
        
        if ( ! $document->exists()) {
            return \Model\View::import('error/404');
        }

        $data = [
            'document' => $document,
        ];

        return \Model\View::import('admin/documents/detail', $data);
    }
}