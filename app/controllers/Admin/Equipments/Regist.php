<?php

namespace Controller\Admin\Equipments;


use Model\Arr;
use Model\FactorySelectList;
use Model\Session;
use Model\Equipment;

class Regist extends \Controller\Admin\AuthedBase
{
    protected $pageTitle = '機材登録';

    public function get($input=null, $errors=[])
    {
        if ($input) {
            $input = array_merge($_GET, $input);
        } else {
            $input = $_GET;
        }

        $selectList = [
            // 設定ファイルから、機材の「種別」リストを読み込む
            //  app/config/config.php の 'equipments'で定義しています
            'type' => Equipment::getId2TypeAsArray(),

            // DBから「区分け」の選択リストを読み込む
            'classification' => FactorySelectList::tableAsArray('classification'),
            // DBから「OS」の選択リストを読み込む
            'os' => FactorySelectList::tableAsArray('os'),
            // DBから「メーカー」の選択リストを読み込む
            'manufacturer' => FactorySelectList::tableAsArray('manufacturer'),
            // DBから「CPU」の選択リストを読み込む
            'cpu' => FactorySelectList::tableAsArray('cpu'),
            // DBから「HDD」の選択リストを読み込む
            'hdd' => FactorySelectList::tableAsArray('hdd'),
            // DBから「グラフィック」の選択リストを読み込む
            'graphics' => FactorySelectList::tableAsArray('graphics'),
            // DBから「メモリ」の選択リストを読み込む
            'memory' => FactorySelectList::tableAsArray('memory'),
            // DBから「保証」の選択リストを読み込む
            'insure' => FactorySelectList::tableAsArray('insure'),
            // DBから「登録者」の選択リストを読み込む
            'registered_user' => FactorySelectList::tableAsArray('registered_user'),
        ];

        $data = [
            'errors' => $errors,
            'input' => $input,
            'select_list' => $selectList,
        ];

        return \Model\View::import('admin/equipments/regist', $data);
    }
    
    public function post()
    {
        $input = $_POST;

        $equipment = Equipment::factoryNew();

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

        $equipment->save($this->loggedInUser);
        if ($equipment->get('equipment_id')) {
            // 成功したときの処理
            return \Model\View::import('admin/equipments/regist_complete', []);
        }

        return $this->get($input, ['データの登録に失敗しました']);
    }
}