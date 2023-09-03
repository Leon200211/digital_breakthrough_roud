<?php


namespace engine\main\userProfile\controllers;


/**
 * Class ChangePasswordController контроллер для смены пароля
 * @package engine\main\userProfile\controllers
 */
class ChangePasswordController extends UserProfileController
{


    public function index()
    {
        // метод для проверки доступа
        $this->allAccessCheck();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            if(isset($_POST['password_btn'])){
                // проверка пароля
                $this->passwordCheck();
                // валидация данных
                $this->passwordValidation();
                // обновление пароля
                $this->updatePassword();
            }else if(isset($_POST['login_btn'])){
                // проверка логина
                $this->loginCheck();
                // проверка пароля
                $this->passwordCheck();
                // валидация данных
                $this->loginValidation();
                // обновление пароля
                $this->updateLogin();
            }

        }

        $this->redirect('/profile');

    }


    // проверка старого пароля
    protected function loginCheck()
    {

        // ищем пользователя при  авторизации
        $passRes = $this->model->read('users', [
            'where' => [
                'id' => $_SESSION['id_user'],
            ]
        ]);

        if(empty($passRes) or $_POST['login'] != $passRes[0]['login']){
            $this->redirect("/profile?error_type=3&error=Неверный логин");
        }

    }


    // метод валидации нового логина
    protected function loginValidation()
    {

        if(empty($_POST['newlogin']) or empty($_POST['renewlogin'])){
            $this->redirect("/profile?error_type=3&error=Заполните все поля");
        }

        if($_POST['newlogin'] !== $_POST['renewlogin']){
            $this->redirect("/profile?error_type=3&error=Логины не совпадают");
        }

    }


    // метод смены логина
    public function updateLogin()
    {

        // обновление информации профиля
        $this->model->update('users', [
            'fields' => [
                'login' => $_POST['newlogin'],
            ],
            'where' => ['id' => $_SESSION['id_user']]
        ]);


        $this->redirect('/login');

    }


    // проверка старого пароля
    protected function passwordCheck()
    {
        // ищем пользователя при  авторизации
        $passRes = $this->model->read('users', [
            'where' => [
                'id' => $_SESSION['id_user'],
            ]
        ]);

        if(empty($passRes) or !password_verify($_POST['password'], $passRes[0]['password'])){
            $this->redirect("/profile?error_type=3&error=Неверный пароль");
        }
    }


    // метод валидации нового пароля
    protected function passwordValidation()
    {
        if(empty($_POST['newpassword']) or empty($_POST['renewpassword'])){
            $this->redirect("/profile?error_type=3&error=Заполните все поля");
        }

        if($_POST['newpassword'] !== $_POST['renewpassword']){
            $this->redirect("/profile?error_type=3&error=Пароли не совпадают");
        }
    }


    // метод смены пароля
    public function updatePassword()
    {
        // обновление информации профиля
        $this->model->update('users', [
            'fields' => [
                'password' => password_hash($_POST['renewpassword'], PASSWORD_DEFAULT),
            ],
            'where' => ['id' => $_SESSION['id_user']]
        ]);


        $this->redirect('/login');
    }


}