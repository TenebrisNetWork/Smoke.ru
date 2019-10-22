<?php
require_once ROOT.'core/Controller.php';
class siteController extends  Controller {
    public function  actionIndex(){
        return $this->render('index');
    }
}