<?php 


namespace engine\main\controllers;


use engine\base\exceptions\RouteException;
use engine\base\settings\Settings;
use engine\base\controllers\BaseController;


class mainPageController extends BaseController
{
    public $test;

    public function index() : void 
    {
        $this->test = 121233;

        // получаем данные из БД
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
        return $this->render($_SERVER['DOCUMENT_ROOT'] . '/engine/main/views/mainPage');
    }


}
