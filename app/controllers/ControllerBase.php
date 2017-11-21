<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

  public function beforeExecuteRoute(){ // ตรวจสอบก่อนเริ่มระบบ
    if(!$this->session->has("email") && $this->dispatcher->getControllerName() != "authen"){
      $this->dispatcher->forward([
        'controller' => 'authen',
        'action' => 'index',
      ]);
    }else{
      return;
    }
  }

  public function initialize() {
    $this->assets
      ->collection('style')
      ->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');

    $this->assets
      ->collection('script')
      ->addJs('https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js')
      ->addJs('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js')
      ->addJs('js/config.js')
      ->addJs('js/facebook.js');

  }

}
