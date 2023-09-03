<?php


namespace engine\main\userProfile\controllers;


/**
 * Class UpdateProfileInfoController контроллер для изменение информации в профиле
 * @package engine\main\userProfile\controllers
 */
class UpdateProfileInfoController extends UserProfileController
{

    public function __construct()
    {
        $this->execBase();
    }


    // основной метод обновления данных профиля
    public function index()
    {

        if(!$this->accessRightsChecker->isAutorized()){
            $this->redirect('/login');
        }
        // проверка на права доступа
        $this->accessRightsChecker->accessRightsCheck($_SERVER['REQUEST_URI']);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // валидация данных
            $this->dataValidation();
            // обновление данных
            $this->updateData();
        }

        $this->redirect('/profile');

    }


    // метод проверки данных профиля
    protected function dataValidation()
    {
        $errors = [];

        if (!preg_match('/^[A-Za-zА-ЯЁа-яё]+\s[A-Za-zА-ЯЁа-яё]+\s[A-Za-zА-ЯЁа-яё]+$/u', $_POST['fullName']))
            $errors['name'] = 'ФИО должно содержать три слова';

        if (!is_string($_POST['about']) ||
                $_POST['about'] == '' ||
                mb_strlen($_POST['about']) < 8 ||
                mb_strlen($_POST['about']) > 64) {
            $errors['about'] = 'Информация должна быть больше 8 и меньше 64 символов';
        }

        if (!is_string($_POST['address']) ||
            $_POST['address'] == '' ||
            mb_strlen($_POST['address']) < 8 ||
            mb_strlen($_POST['address']) > 64) {
            $errors['address'] = 'Адрес должна быть больше 8 и меньше 64 символов';
        }

        if(!preg_match("/^8-[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}$/", $_POST['phone'])) {
            $errors['phone'] = 'Ошибка в телефоне, формат ввода 8-999-000-00-00';
        }

        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) != $_POST['email'])
            $errors['email'] = 'Ошибка в email';

        // валидация фото

        if(!empty($errors)){

            $error = '';
            foreach ($errors as $value){
                $error .= $value . '<br>';
            }

            $this->redirect("/profile?error_type=1&error=$error&fullName={$_POST['fullName']}" .
             "&about={$_POST['about']}&address={$_POST['address']}&phone={$_POST['phone']}&email={$_POST['email']}");
        }

    }


    // метод обновления данных профиля
    protected function updateData()
    {
        // обновление фото профиля
        if(!empty($_FILES['profile_file']['name'])){
            $uploadfile = USER_PROFILE_IMG . basename('profile_img_idUser-' . $_SESSION['id_user'] . '.png');

            move_uploaded_file($_FILES['profile_file']['tmp_name'], $uploadfile);
            $_SESSION['profile_img'] = 'profile_img_idUser-' . $_SESSION['id_user'] . '.png';
            $uploadfile = 'profile_img_idUser-' . $_SESSION['id_user'] . '.png';
        }else{
            $uploadfile = $_SESSION['profile_img'];
        }

        // обновление информации профиля
        $this->model->update('users', [
            'fields' => [
                'name' => $_POST['fullName'],
                'info' => $_POST['about'],
                'address' => $_POST['address'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'photo' => $uploadfile
            ],
            'where' => ['id' => $_SESSION['id_user']]
        ]);

        $_SESSION['name'] = $_POST['fullName'];

        $this->redirect('/profile');
    }




    // метод удаления фото профиля
    protected function deleteUserImg()
    {
        $imgPath = USER_PROFILE_IMG . basename('profile_img_idUser-' . $_SESSION['id_user'] . '.png');

        if(file_exists($imgPath)){
            // удаление фото профиля
            unlink($imgPath);

            // удаления фотографии из БД
            $this->model->update('users', [
                'fields' => [
                    'photo' => 'default_img_user.png'
                ],
                'where' => ['id' => $_SESSION['id_user']]
            ]);

            $_SESSION['profile_img'] = 'default_img_user.png';

        }

        $this->redirect('/profile');

    }

}