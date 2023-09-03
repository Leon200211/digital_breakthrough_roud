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
            'controller' => 'main',
            'controllerPath' => '\engine\main\authentication\controllers\\',
            'action' => 'index',
        ],
        '/login' => [
            'controller' => 'authorization',
            'controllerPath' => '\engine\main\authentication\controllers\\',
            'action' => 'index'
        ],



        // работа лазерный цех
        '/laserworkshop/chart/add' => [
            'controller' => 'addShift',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\chart\\',
            'action' => 'index'
        ],
        '/laserworkshop/chart/show' => [
            'controller' => 'showShift',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\chart\\',
            'action' => 'index'
        ],
        '/laserworkshop/shift' => [
            'controller' => 'shift',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\shift\\',
            'action' => 'index'
        ],
        '/laserworkshop/shift/info' => [
            'controller' => 'OneShift',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\shift\\',
            'action' => 'index'
        ],
        '/laserworkshop/shift/metal/take' => [
            'controller' => 'shift',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\shift\\',
            'action' => 'takeFromWarehouse'
        ],
        '/laserworkshop/shift/comment/update' => [
            'controller' => 'shift',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\shift\\',
            'action' => 'updateShiftOperatorComment'
        ],
        '/laserworkshop/shift/work/update' => [
            'controller' => 'shift',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\shift\\',
            'action' => 'updateShiftWork'
        ],
        '/laserworkshop/shift/admin/work/update' => [
            'controller' => 'oneShift',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\shift\\',
            'action' => 'updateShiftWork'
        ],
        '/laserworkshop/shift/report/delete' => [
            'controller' => 'reportWarehouse',
            'controllerPath' => '\engine\modules\erpMetal\controllers\\',
            'action' => 'deleteFromReport'
        ],
        '/laserworkshop/workers' => [
            'controller' => 'workers',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\\',
            'action' => 'index'
        ],
        // заполнение смены информацией
        '/laserworkshop/shift/exercise/update' => [
            'controller' => 'OneShift',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\shift\\',
            'action' => 'exerciseUpdate'
        ],
        '/laserworkshop/shift/order/add' => [
            'controller' => 'OneShift',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\shift\\',
            'action' => 'addOrderToShift'
        ],
        '/laserworkshop/shift/order/delete' => [
            'controller' => 'OneShift',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\shift\\',
            'action' => 'deleteOrderFromShift'
        ],
        '/laserworkshop/shift/order/position/add' => [
            'controller' => 'OneShift',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\shift\\',
            'action' => 'addOrderPositionToShift'
        ],
        '/laserworkshop/shift/order/position/delete' => [
            'controller' => 'OneShift',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\shift\\',
            'action' => 'deleteOrderPositionFromShift'
        ],
        '/laserworkshop/shift/worker/add' => [
            'controller' => 'OneShift',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\shift\\',
            'action' => 'addShiftWorker'
        ],
        '/laserworkshop/shift/worker/delete' => [
            'controller' => 'OneShift',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\shift\\',
            'action' => 'deleteShiftWorker'
        ],
        '/laserworkshop/orders' => [
            'controller' => 'Orders',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\orders\\',
            'action' => 'index'
        ],
        '/laserworkshop/orders/order' => [
            'controller' => 'Order',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\orders\\',
            'action' => 'index'
        ],
        '/laserworkshop/orders/order/update/status' => [
            'controller' => 'Order',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\orders\\',
            'action' => 'updateOrderStatus'
        ],
        '/laserworkshop/orders/order/update/date' => [
            'controller' => 'Order',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\orders\\',
            'action' => 'updateOrderDate'
        ],
        '/laserworkshop/reports' => [
            'controller' => 'Reports',
            'controllerPath' => '\engine\modules\laserWorkshop\controllers\reports\\',
            'action' => 'index'
        ],


        // работа с профилем
        '/profile' => [
            'controller' => 'showProfile',
            'controllerPath' => '\engine\main\userProfile\controllers\\',
            'action' => 'index'
        ],
        '/profile/update' => [
            'controller' => 'UpdateProfileInfo',
            'controllerPath' => '\engine\main\userProfile\controllers\\',
            'action' => 'index'
        ],
        '/profile/password' => [
            'controller' => 'ChangePassword',
            'controllerPath' => '\engine\main\userProfile\controllers\\',
            'action' => 'index'
        ],
        '/profile/login' => [
            'controller' => 'ChangePassword',
            'controllerPath' => '\engine\main\userProfile\controllers\\',
            'action' => 'index'
        ],
        '/profile/delete/img' => [
            'controller' => 'UpdateProfileInfo',
            'controllerPath' => '\engine\main\userProfile\controllers\\',
            'action' => 'deleteUserImg'
        ],


        // склад металла
        '/warehouse/sheet' => [
            'controller' => 'Warehouse',
            'controllerPath' => '\engine\modules\erpMetal\controllers\\',
            'action' => 'warehouseSheet'
        ],
        '/warehouse/pipes' => [
            'controller' => 'Warehouse',
            'controllerPath' => '\engine\modules\erpMetal\controllers\\',
            'action' => 'warehousePipes'
        ],
        '/warehouse/add' => [
            'controller' => 'Warehouse',
            'controllerPath' => '\engine\modules\erpMetal\controllers\\',
            'action' => 'warehouseAddItem'
        ],
        '/warehouse/take' => [
            'controller' => 'Warehouse',
            'controllerPath' => '\engine\modules\erpMetal\controllers\\',
            'action' => 'warehouseTakeItem'
        ],


        // офис менеджер
        '/office/manager/orders' => [
            'controller' => 'Orders',
            'controllerPath' => '\engine\modules\office\manager\controllers\\',
            'action' => 'index'
        ],
        '/office/manager/order/create' => [
            'controller' => 'CreateOrder',
            'controllerPath' => '\engine\modules\office\manager\controllers\\',
            'action' => 'index'
        ],
        '/office/manager/order' => [
            'controller' => 'Order',
            'controllerPath' => '\engine\modules\office\manager\controllers\\',
            'action' => 'index'
        ],
        '/office/manager/order/position/delete' => [
            'controller' => 'Order',
            'controllerPath' => '\engine\modules\office\manager\controllers\\',
            'action' => 'delPos'
        ],
        '/office/manager/order/edit/info' => [
            'controller' => 'Order',
            'controllerPath' => '\engine\modules\office\manager\controllers\\',
            'action' => 'editOrderInfo'
        ],
        '/office/manager/order/edit/date' => [
            'controller' => 'Order',
            'controllerPath' => '\engine\modules\office\manager\controllers\\',
            'action' => 'editOrderDate'
        ],
        '/office/manager/order/edit/status' => [
            'controller' => 'Order',
            'controllerPath' => '\engine\modules\office\manager\controllers\\',
            'action' => 'editOrderStatus'
        ],
        '/office/manager/order/position/edit' => [
            'controller' => 'Order',
            'controllerPath' => '\engine\modules\office\manager\controllers\\',
            'action' => 'editPos'
        ],
        '/office/manager/order/position/file/delete' => [
            'controller' => 'Order',
            'controllerPath' => '\engine\modules\office\manager\controllers\\',
            'action' => 'deletePositionFile'
        ],





        '/notification/remove' => [
            'controller' => 'NotificationAction',
            'controllerPath' => '\engine\main\notificationSystem\controllers\\',
            'action' => 'removeNotification'
        ],
        '/notification' => [
            'controller' => 'NotificationPage',
            'controllerPath' => '\engine\main\notificationSystem\controllers\\',
            'action' => 'index'
        ]

    ];


}