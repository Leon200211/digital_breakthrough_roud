<?php


namespace engine\main\userProfile\models;


use engine\base\controllers\Singleton;
use engine\base\models\BaseModel;


class MainModel extends BaseModel
{

    // трейт для паттерна Singleton
    use Singleton;


    // метод получения всех данных о пользователе
    public function getUserData($id_user){

        // ищем все роли пользователя
        $userData = $this->read('users', [
            'where' => [
                'id' => $id_user,
            ],
            'operand' => ['='],
            'join' => [
                [
                    'table' => 'subdivision',
                    'fields' => ['title as sub_title', 'address as sub_address'],
                    'type' => 'inner',
                    'operand' => ['='],
                    'condition' => ['AND'],
                    'on' => ['subdivision_id', 'id']
                ]
            ],
        ])[0];

        return $userData;

    }

}