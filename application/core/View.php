<?php
class View {

    //Подключает базовый шаблон и передает в него контентс данными
    public function generate($pathToView, $pathToTemplate, $data = null)
    {
        include_once $pathToTemplate;
    }
}