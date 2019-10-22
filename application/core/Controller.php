<?php
require_once ROOT.'core/Model.php';
require_once ROOT.'core/View.php';
class Controller {

    protected $model;
    protected $view;

    function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
    }

    public function render($pathToView)
    {
        $className = stristr(get_class($this), 'Controller');
        $pathToView = ROOT . 'views/' . $className . '/' . $pathToView;
        return include_once($pathToView);
    }
}
