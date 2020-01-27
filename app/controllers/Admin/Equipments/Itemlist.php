<?php

namespace Controller\Admin\Equipments;


use Model\Arr;
use Model\Config;
use Model\Equipment;

class Itemlist extends \Controller\Admin\AuthedBase
{
    protected $pageTitle = '機材一覧';

    public function get()
    {
        $filterTypeIds = [];
        $filterTypes = Arr::get($_GET, 'filterTypes', []);
        foreach ($filterTypes as $type) {
            $filterTypeIds[] = (int) $type;
        }
        
        $EQUIPMENTS_ID_2_TYPE = Equipment::getId2TypeAsArray();
        $equipmentsParams = [];
        foreach ($EQUIPMENTS_ID_2_TYPE as $id => $label) {
            $id = (int)$id;

            $equipmentsParams[$id] = [
                'id' => $id,
                'label' => $label,
                'checked' => in_array($id, $filterTypeIds),
            ];
        }

        $filterParams = [
            'type_id' => $filterTypeIds,
        ];
        $collection = \Model\EquipmentCollection::factory($filterParams);

        $data = [
            'collection' => $collection,
            'equipmentsParams' => $equipmentsParams,
        ];

        return \Model\View::import('admin/equipments/itemlist', $data);
    }
}