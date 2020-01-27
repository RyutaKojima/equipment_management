<?php

namespace Controller\Admin\Equipments;


use Model\Arr;
use Model\Equipment;

class Detail extends \Controller\Admin\AuthedBase
{
    protected $pageTitle = '機材詳細';

    public function get()
    {
        $id = Arr::get($_GET, 'id');
        $equipment = Equipment::factoryById($id);
        
        if ( ! $equipment->exists()) {
            return \Model\View::import('error/404');
        }

        $data = [
            'equipment' => $equipment,
        ];

        return \Model\View::import('admin/equipments/detail', $data);
    }
}