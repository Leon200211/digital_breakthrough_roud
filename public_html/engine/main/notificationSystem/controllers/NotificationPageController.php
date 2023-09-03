<?php


namespace engine\main\notificationSystem\controllers;


use engine\base\controllers\BaseController;


/**
 * Класс для работы со страницей уведомлений
 *
 * Class NotificationPageController
 * @package engine\main\notificationSystem\controllers
 */
class NotificationPageController extends Notification
{

    protected $notice;

    public function index()
    {
        // метод для проверки доступа
        $this->allAccessCheck();

    }


    public function outputData()
    {
        return $this->render($_SERVER['DOCUMENT_ROOT'] . '/engine/main/notificationSystem/views/notification');
    }

}