<?php


namespace engine\main\userProfile\controllers;



/**
 * Class ShowProfileController контроллер для вывода профиля пользователя
 * @package engine\main\userProfile\controllers
 */
class ShowProfileController extends UserProfileController
{

    public $userData = [];

    public function index()
    {
        // метод для проверки доступа
        $this->allAccessCheck();

        // получаем все данные о пользователе
        $this->userData = $this->model->getUserData($_SESSION['id_user']);
    }


    public function outputData()
    {
        return $this->render($_SERVER['DOCUMENT_ROOT'] . '/engine/main/userProfile/views/users-profile');
    }

}