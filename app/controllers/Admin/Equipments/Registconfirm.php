<?php

namespace Controller\Admin\Equipments;


use Model\Arr;
use Model\FactorySelectList;
use Model\Session;
use Model\Equipment;

class Registconfirm extends \Controller\Admin\AuthedBase
{
    protected $pageTitle = '機材登録-内容確認';

    public function get($input=null, $errors=[])
    {
        return \Model\View::import('error/404', []);
    }
    
    public function post()
    {
        $input = $_POST;

        $equipment = Equipment::factoryNew();

        $doRegister = Arr::get($input, 'doRegister', false);

        $equipment->set('type_id', Arr::get($input, 'type_id', 0));
        $equipment->set('classification_id', Arr::get($input, 'classification_id', 0));
        $equipment->set('os_id', Arr::get($input, 'os_id', 0));
        $equipment->set('manufacturer_id', Arr::get($input, 'manufacturer_id', 0));
        $equipment->set('title', Arr::get($input, 'title', ''));
        $equipment->set('cpu_id', Arr::get($input, 'cpu_id', 0));
        $equipment->set('ssd', Arr::get($input, 'ssd', ''));
        $equipment->set('hdd_1_id', Arr::get($input, 'hdd_1_id', 0));
        $equipment->set('hdd_2_id', Arr::get($input, 'hdd_2_id', 0));
        $equipment->set('graphics_id', Arr::get($input, 'graphics_id', 0));
        $equipment->set('memory_id', Arr::get($input, 'memory_id', 0));
        $equipment->set('has_drive', Arr::get($input, 'has_drive', 0));
        $equipment->set('insure_id', Arr::get($input, 'insure_id', 0));
        $equipment->set('serial', Arr::get($input, 'serial', ''));
        $equipment->set('login_name', Arr::get($input, 'login_name', ''));
        $equipment->set('login_password', Arr::get($input, 'login_password', ''));
        $equipment->set('purchased_at', Arr::get($input, 'purchased_at'));
        $equipment->set('user_in_use', Arr::get($input, 'user_in_use', ''));
        $equipment->set('registered_by_id', Arr::get($input, 'registered_by_id', 0));
        $equipment->set('remarks', Arr::get($input, 'remarks'));

        $errors = [];
        if ($doRegister) {
            $equipment->save($this->loggedInUser);
            if ($equipment->get('equipment_id')) {
                // 成功したときの処理
                return \Model\View::import('admin/equipments/regist_complete', []);
            }

            $errors[] = 'データの登録に失敗しました';
        }

        $data = [
            'errors' => $errors,
            'equipment' => $equipment,
        ];
        return \Model\View::import('admin/equipments/regist_confirm', $data);
    }
}