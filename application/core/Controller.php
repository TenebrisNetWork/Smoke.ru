<?php
require_once ROOT.'core/Model.php';
require_once ROOT.'core/View.php';
class Controller {

    protected $model;
    protected $view;
    protected $nameTemplate = 'baseTemplate';

    function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
    }

    //Принимает на вход название файла с видом (без .php) и данные, строит маршруты и вызывает метод generate у вида
    public function render($pathToView, $data = null)
    {
        $className = stristr(get_class($this), 'Controller', true);
        $pathToView = ROOT . 'views/' . $className . '/' . $pathToView . '.php';
        $pathToTemplate = ROOT.'views/template/'.$this->nameTemplate.'.php';
        $this->view->generate($pathToView, $pathToTemplate, $data);
    }
}
