<?php

namespace engine\main\notificationSystem\controllers;


use engine\base\controllers\BaseController;
use engine\main\authentication\controllers\AccessRightsController;
use engine\main\notificationSystem\models\MainModel;


// Класс для работы системы уведомлений
abstract class NotificationSystemController extends BaseController
{

    protected function inputData()
    {
        if(!$this->model) $this->model = MainModel::getInstance();
        if(!$this->accessRightsChecker) $this->accessRightsChecker = AccessRightsController::getInstance();

        // запрет на кеширование
        $this->sendNoCacheHeaders();
    }


    protected function execBase()
    {
        self::inputData();
    }


    // запрет на кеширование
    protected function sendNoCacheHeaders()
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    }


    // метод для проверки доступа
    protected function allAccessCheck()
    {
        $this->execBase();

        if(!$this->accessRightsChecker->isAutorized()){
            $this->redirect('/login');
        }
        // проверка на права доступа
        $this->accessRightsChecker->accessRightsCheck($_SERVER['REQUEST_URI']);
    }

}