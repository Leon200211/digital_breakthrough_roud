<?php


namespace engine\main\notificationSystem\controllers;


/**
 * Класс для прочтения уведомлений
 *
 * Class RemoveNotificationController
 * @package engine\main\notificationSystem\controllers
 */
class NotificationActionController extends Notification
{

    /**
     * RemoveNotificationController constructor.
     */
    public function removeNotification()
    {
        $this->execBase();

        // метод для проверки доступа
        $this->allAccessCheck();

        $idNotice = $_POST['idNotice'];
        $idUser = $_POST['idUser'];

        if($_SESSION['id_user'] == $idUser){
            $this->model->delete('notice', [
                'where' => [
                    'id' => $idNotice,
                    'id_user_notice' => $idUser
                ]
            ]);
        }

    }


}