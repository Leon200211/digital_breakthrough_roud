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
        print_r($data);
        
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
