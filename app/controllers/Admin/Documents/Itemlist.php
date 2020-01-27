<?php

namespace Controller\Admin\Documents;

use Model\Arr;
use Model\Document;

/**
 * 資料一覧ページ
 * このページはログインしなくても見ることができる
 *
 * @package Controller\Admin\Documents
 */
class Itemlist extends \Controller\Controller
{
    protected $pageTitle = '資料一覧';

    public function get()
    {
        $filterTypeIds = [];
        $filterTypes = Arr::get($_GET, 'filterTypes', []);
        foreach ($filterTypes as $type) {
            $filterTypeIds[] = (int) $type;
        }

        $documentsParams = [];
        foreach (Document::getId2TypeAsArray() as $id => $label) {
            $id = (int)$id;

            $documentsParams[$id] = [
                'id' => $id,
                'label' => $label,
                'checked' => in_array($id, $filterTypeIds),
            ];
        }

        $filterParams = [
            'type_id' => $filterTypeIds,
        ];
        $collection = \Model\DocumentCollection::factory($filterParams);

        $data = [
            'user' => \Model\Auth::factoryLoggedInUser(),
            'collection' => $collection,
            'documentsParams' => $documentsParams,
        ];

        return \Model\View::import('admin/documents/itemlist', $data);
    }
}