<?php
/**
 * Created by PhpStorm.
 * User: tesina
 * Date: 14/08/2018
 * Time: 19:11
 */

namespace App\Controller;


use Cake\ORM\TableRegistry;

class ReportsController extends AppController
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->viewBuilder()->setLayout('bootstrap');
    }

    public function index() {
        $returns = TableRegistry::get('ItemReturns')->find('all')
            ->contain(['Phones'])
            ->orderDesc("created")->limit(10);

        $repairs = TableRegistry::get('Repairs')->find('all')
            ->contain(['Phones'])
            ->orderDesc("created")->limit(10);

        $repairsStatusCount = TableRegistry::get('Repairs')->find('all', [
            'fields' => [
                'chart_label' => 'status',
                'y' => 'COUNT(id)'
            ],
            'group' => ['status']
        ]);
        $repairsStatusCountArray = $this->getBarChartFormatArray($repairsStatusCount, 'Repairs Total for every status');

        $repairsReasonCount = TableRegistry::get('Repairs')->find('all', [
            'fields' => [
                'chart_label' => 'reason',
                'y' => 'COUNT(id)'
            ],
            'group' => ['reason']
        ]);
        $repairsReasonCountArray = $this->getBarChartFormatArray($repairsReasonCount, 'Repairs Total for every reason');

        $supplierOrders = TableRegistry::get('SupplierOrders')->find('all')
            ->contain(['Suppliers'])->orderDesc("created")->limit(10);

        $recentlyModifiedPhones = TableRegistry::get('Phones')->find('all')
            ->orderDesc("modified")->limit(5);

        $recentlyAddedPhones = TableRegistry::get('Phones')->find('all')
            ->orderDesc("created")->limit(5);

        $phonesTested = TableRegistry::get('Phones')->find('all', [
            'fields' => [
                't' => 'DATE(created)',
                'y' => 'COUNT(id)'
            ],
            'conditions' => 'imiei != serial_number',
            'group' => ['DATE(created)']
        ])->orderAsc("created");

        $phonesAdded = TableRegistry::get('Phones')->find('all', [
            'fields' => [
                't' => 'DATE(created)',
                'y' => 'COUNT(id)'
            ],
            'group' => ['DATE(created)']
        ])->orderAsc("created");

        $phonesAddedByModel = TableRegistry::get('Phones')->find('all', [
            'fields' => [
                't' => 'DATE(Phones.created)',
                'y' => 'COUNT(Phones.id)',
                'Phones.model_id'
            ],
            'group' => ['DATE(Phones.created)', 'Phones.model_id']
        ])->enableAutoFields(true)->contain(['Models'])->orderAsc("Phones.created");


        $phonesSold = TableRegistry::get('Transactions')->find('all', [
            'fields' => [
                't' => 'DATE(Transactions.date)',
                'y' => 'COUNT(id)'
            ],
            'group' => ['DATE(Transactions.date)']
        ])->orderAsc("Transactions.date");

        $phonesSoldByModel = TableRegistry::get('Transactions')->find('all', [
            'fields' => [
                't' => 'DATE(Transactions.date)',
                'y' => 'COUNT(Transactions.id)',
                'Phones.model_id'
            ],
            'group' => ['DATE(Transactions.date)', 'Phones.model_id']
        ])
            ->innerJoinWith('Phones')
            ->select(['Phones.model_id'])
            ->enableAutoFields(true)
            ->contain(['Phones' => ['Models']])->orderAsc("Transactions.date");

        $phonesTestedArray = $this->getTimeChartFormatArray($phonesTested, 'Total Phones tested');
        $phonesAddedArray = $this->getTimeChartFormatArray($phonesAdded, 'Total Phones Added');
        $phonesSoldArray = $this->getTimeChartFormatArray($phonesSold, 'Total Phones Sold');
        $phonesSoldArrayByModel = $this->getTimeChartStackedFormatArray($phonesSoldByModel, function($entity) {
            if ($entity->phone->model)
                return $entity->phone->model->name;
            else
                return "Not tested";
        });
        $phonesAddedArrayByModel = $this->getTimeChartStackedFormatArray($phonesAddedByModel, function($entity) {
            if ($entity->model)
                return $entity->model->name;
            else
                return "Not tested";
        });

        $this->set(compact('returns', 'repairs', 'supplierOrders',
                           'recentlyModifiedPhones', 'recentlyAddedPhones', 'phonesTestedArray',
                           'phonesAddedArray', 'phonesSoldArray', 'repairsStatusCountArray',
                            'repairsReasonCountArray', 'phonesSoldArrayByModel', 'phonesAddedArrayByModel'));
    }

    protected function getTimeChartFormatArray($entities, $legend = '') {
        $chartFriendlyArray = [];
        $sum = 0;
        foreach($entities as $entity) {
            $chartFriendlyArray[] = [
                'y' => $entity->y,
                't' => $entity->t
            ];
            $sum += $entity->y;
        }

        return [
            "label" => $legend. ' (' .$sum.')',
            "data" => $chartFriendlyArray
        ];
    }

    protected function getTimeChartStackedFormatArray($entities, $callback) {
        $preChartFriendlyArray = [];
        $chartFriendlyArray = [];

        foreach($entities as $entity) {

            $preChartFriendlyArray[$callback($entity)]["data"][] = [
                'y' => $entity->y,
                't' => $entity->t,

            ];

        }

        foreach ($preChartFriendlyArray as $key => $item) {
            $chartFriendlyArray[] = [
                "label" => $key. ' (' .array_sum(array_column($item["data"], 'y')).')',
                "data" => $item["data"]
            ];
        }

        return $chartFriendlyArray;
    }

    protected function getBarChartFormatArray($entities, $legend = '') {
        $chartFriendlyArray = [];
        $labels = [];
        $sum = 0;
        foreach($entities as $entity) {
            $chartFriendlyArray[] = $entity->y;
            $sum += $entity->y;
            $labels[] = $entity->chart_label;
        }

        return [
            "labels" => $labels,
            "datasets"=>
            [
                "label" => $legend . ' (' .$sum.')',
                "data" => $chartFriendlyArray
            ]
        ];
    }
}