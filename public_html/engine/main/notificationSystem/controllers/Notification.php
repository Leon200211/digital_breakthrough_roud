<?php


namespace engine\main\notificationSystem\controllers;


use engine\base\controllers\Singleton;
use mysqli_sql_exception;
use Vtiful\Kernel\Format;


class Notification extends NotificationSystemController
{

    // трейт для паттерна Singleton
    use Singleton;

    // массив путей к объектам
    protected $paths = [
        'admin' => [
            'order' => SITE_URL . 'office/manager/order',
            'shift' => ''
        ],
        'ceo' => [],
        'laser_machine_operator' => [],
        'laser_machine_boss' => [],
        'manager' => [],
    ];


    public function __construct()
    {
        $this->execBase();
    }

    // метод для получения всех уведомлений
    public function getNotifications()
    {

        $notice_db = $this->model->read('notice', [
            'where' => [
                'id_user_notice' => $_SESSION['id_user']
            ]
        ]);

        // Массив уведомлений
        $notice = [];

        foreach ($notice_db as $key => $value){

            // Заполнение основной информации
            switch ($value['type'])
            {
                case 'order':
                    $notice[$key]['id'] = $value['id'];
                    $notice[$key]['id_user'] = $value['id_user_notice'];
                    $notice[$key]['title'] = 'Заказ №' . $value['id_order_notice'];
                    $notice[$key]['note'] = $value['note'];
                    $notice[$key]['date'] = $value['date'];

                    $notice[$key]['path'] = $this->getNoticePath('order') . $this->model->read('orders', ['fields' => ['id'], 'where' => ['id_order' => $value['id_order_notice']]])[0]['id'];
                    break;

                case 'shift':
                    $notice[$key]['id'] = $value['id'];
                    $notice[$key]['id_user'] = $value['id_user_notice'];
                    $notice[$key]['title'] = 'Смена №' . $value['id_shift_notice'];
                    $notice[$key]['note'] = $value['note'];
                    $notice[$key]['date'] = $value['date'];

                    $notice[$key]['path'] = $this->getNoticePath('shift') . $value['id_shift_notice'];
                    break;
            }

            // Визуальное заполнение
            switch ($value['priority'])
            {
                case 0:
                    $notice[$key]['img'] = 'warning.png';
                    break;
            }

        }

        return $notice;

    }


    /**
     * метод для определения адреса переадресации
     *
     * @param $type
     */
    public function getNoticePath($type)
    {

        $noticePath = [
            'admin' => [
                'order' => SITE_URL . 'office/manager/order?id=',
                'shift' => SITE_URL . 'laserworkshop/shift/info?id_shift='
            ],
            'ceo' => [
                'order' => SITE_URL . 'office/manager/order?id=',
                'shift' => SITE_URL . 'laserworkshop/shift/info?id_shift='
            ],
            'laser_machine_operator' => [
                'order' => SITE_URL . '/laserworkshop/orders/order?id=',
                'shift' => SITE_URL . 'laserworkshop/shift/info?id_shift='
            ],
            'laser_workshop_boss' => [
                'order' => SITE_URL . '/laserworkshop/orders/order?id=',
                'shift' => SITE_URL . 'laserworkshop/shift/info?id_shift='
            ],
            'manager' => [
                'order' => SITE_URL . 'office/manager/order?id=',
                'shift' => SITE_URL . 'laserworkshop/shift/info?id_shift='
            ],
        ];

        return $noticePath[$_SESSION['role'][0]['role_title']][$type];

    }


    /**
     * Метод для добавления уведомлений
     *
     * @param string $type
     * @param int $priority
     * @param string $note
     * @param int $id
     * @param int $idUser
     */
    public function setNotice(string $type, int $priority, string $note, int $id, array $userList)
    {

        $type = htmlspecialchars(stripslashes(trim($type)));
        $priority = htmlspecialchars(stripslashes(trim($priority)));
        $note = htmlspecialchars(stripslashes(trim($note)));
        $id = htmlspecialchars(stripslashes(trim($id)));


        // Генерируем массив пользователей
        $user_list = [];
        foreach ($userList as $user){
            // Если это один пользователь, то добавляем его
            if(is_int($user) or is_numeric($user)){
                $user_list[] = $user;
            }
            else if(is_string($user)){  // Если это роль

                $id_role = $this->model->read('roles', [
                    'fields' => ['id as role_id'],
                    'where' => [
                        'title' => $user
                    ],
                ])[0]['role_id'];

                $users_id = $this->model->read('user_roles', [
                    'fields' => ['id_user'],
                    'where' => [
                        'id_role' => $id_role
                    ],
                ]);

                foreach ($users_id as $user_id){
                    $user_list[] = $user_id['id_user'];
                }

            }

        }

        // Начало транзакции
        mysqli_begin_transaction($this->model->getDbConnection());
        try {

            switch ($type)
            {
                case 'order':
                    // Перебор всех пользователь
                    foreach ($user_list as $user){
                        $this->model->add('notice', [
                            'fields' => [
                                'id_user_notice' => $user,
                                'id_order_notice' => $id,
                                'type' => $type,
                                'priority' => $priority,
                                'note' => $note,
                            ]
                        ]);
                    }

                    break;

                case 'shift':
                    // Перебор всех пользователь
                    foreach ($user_list as $user){
                        $this->model->add('notice', [
                            'fields' => [
                                'id_user_notice' => $user,
                                'id_shift_notice' => $id,
                                'type' => $type,
                                'priority' => $priority,
                                'note' => $note,
                            ]
                        ]);
                    }

                    break;
            }

            // Если код достигает этой точки без ошибок, фиксируем данные в базе данных.
            mysqli_commit($this->model->getDbConnection());

        } catch (mysqli_sql_exception $exception) {
            mysqli_rollback($this->model->getDbConnection());

            throw $exception;
        }

    }

}