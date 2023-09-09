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
    }

    public function outputData()
    {
        return $this->render($_SERVER['DOCUMENT_ROOT'] . '/templates/default/index');
    }


}
