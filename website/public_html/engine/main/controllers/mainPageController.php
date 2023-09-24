<?php 


namespace engine\main\controllers;


use engine\base\exceptions\RouteException;
use engine\base\settings\Settings;
use engine\base\controllers\BaseController;
use engine\main\models\MainModel;


class mainPageController extends BaseController
{
    public $markers;
    public $dates;


    public $chart_main = [];

    public function index() : void 
    {
        // получаем данные из БД
        if(!$this->model) $this->model = MainModel::getInstance();
        $this->markers = $this->model->read('defects', [
            'fileds' => ['type', 'marker_coords_x', 'marker_coords_y', 'note', 'date_id'],
            'join' => [
                [
                'table' => 'dates',
                'fields' => ['id as dates_id', 'date'],
                'type' => 'inner',
                'on' => ['date_id', 'id']
                ]
            ],
        ]);

        $this->dates = $this->model->read('dates', [
            'fileds' => ['id', 'date']
        ]);


        foreach($this->dates as $data){
            $chart_main_day_data[$data['date']] = [
                'type_1' => 0,
                'type_2' => 0,
                'type_3' => 0,
                'type_4' => 0,
            ];
        }

        // chart main
        foreach($this->dates as $data){
            $chart_data = $this->model->read('defects', [
                'fileds' => ['id', 'type'],
                'where' => ['date_id' => $data['id']]
            ]);
            foreach($chart_data as $value) {
                switch($value['type'])
                {
                    case 'type_1':
                        $chart_main_day_data[$data['date']]['type_1'] += 1;
                        break;
                    case 'type_2':
                        $chart_main_day_data[$data['date']]['type_2'] += 1;
                        break;
                    case 'type_3':
                        $chart_main_day_data[$data['date']]['type_3'] += 1;
                        break;
                    case 'type_4':
                        $chart_main_day_data[$data['date']]['type_4'] += 1;
                        break;            
                }
            }
        }


        $this->chart_main = $chart_main_day_data;
        

    }

    public function uploadVideo()
    {

        echo "<pre>";
        print_r($_POST);
        echo "<pre>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<pre>";
        print_r($_FILES);
        echo "<pre>";

        exit();
    }

    public function saveData()
    {
        // запись в БД
        $types = [
            'pothole' => [
                'db_type' => 'type_1',
                'note' => 'Выбоина'
            ],
            'alligator_cracking' => [
                'db_type' => 'type_2',
                'note' => 'Аллигаторная трещина'
            ],
            'lateral_cracking' => [
                'db_type' => 'type_3',
                'note' => 'Поперечная трещина'
            ],
            'longitudinal_cracking' => [
                'db_type' => 'type_4',
                'note' => 'Продольная трещина'
            ],
        ];

        $data = !empty($_POST) ? $_POST : file_get_contents("php://input");
        $data = json_decode($data, true);

        $buffer = [];

        foreach($data['markers'] as $key => $value) {
            if (in_array($value['marker_coords_x'], $buffer)) {
                unset($data['markers'][$key]);
            } else {
                $buffer[] = $value['marker_coords_x'];
            }

        }




        if(!$this->model) $this->model = MainModel::getInstance();
        $date_id = $this->model->add('dates', [
            'fields' => [
                'date' => date("Y-m-d H:i:s")
            ],
            'return_id' => true,
        ]);

        foreach($data['markers'] as $marker) {
            $this->model->add('defects', [
                'fields' => [
                    'type' => $types[$marker['type']]['db_type'],
                    'marker_coords_x' => $marker['marker_coords_x'],
                    'marker_coords_y' => $marker['marker_coords_y'],
                    'note' => $types[$marker['type']]['note'],
                    'date_id' => $date_id
                ]
            ]);
        }

        exit;
    }

    public function outputData()
    {
        return $this->render($_SERVER['DOCUMENT_ROOT'] . '/templates/default/index');
    }


}
