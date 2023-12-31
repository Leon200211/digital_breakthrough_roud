<?php


namespace engine\base\settings;


use engine\base\controllers\Singleton;


/**
 * Class Settings класс настроек
 * @package engine\base\settings
 */
class Settings
{

    use Singleton;

    // геттер для получения данных
    static public function get($property){
        return self::getInstance()->$property;
    }


    // настройки пути
    private $routes = [

        '/404' => [
            'controller' => 'exceptionalPages',
            'controllerPath' => '\engine\base\controllers\\',
            'action' => 'page404',
        ],

        '/' => [
            'controller' => 'mainPage',
            'controllerPath' => '\engine\main\controllers\\',
            'action' => 'index',
        ],
        '/uploadFile' => [
            'controller' => 'mainPage',
            'controllerPath' => '\engine\main\controllers\\',
            'action' => 'uploadVideo',
        ],


    ];


}