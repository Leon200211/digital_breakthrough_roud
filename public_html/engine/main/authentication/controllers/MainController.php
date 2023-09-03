<?php


namespace engine\main\authentication\controllers;


use engine\base\controllers\BaseController;



/**
 * Class MainController основной контроллер для всех пользователей
 * @package engine\main\authentication\controllers
 */
class MainController extends AuthenticationController
{

    protected $title = 'PskVesna';

    public function index(){

        $this->execBase();

        if(!$this->accessRightsChecker->isAutorized()){
            $this->redirect('/login');
        }

    }


    public function outputData(){
        return $this->render($_SERVER['DOCUMENT_ROOT'] . '/templates/default/index');
    }

}