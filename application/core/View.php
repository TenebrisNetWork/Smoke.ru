<?php
class View {

    public function generate($pathToView, $pathToTemplate, $data = null)
    {
        include_once $pathToTemplate;
    }
}