<?php
class Router
{
    //Объявляем переменную с маршрутами.
    private $routes = array();
    public function __construct()
    {
        //Получаем путь к маршрутам
        $routesPath = ROOT."config/routes.php";
        //Достаем маршруты из файла в переменную $routes
        $this->routes = include($routesPath);
    }
    //Получение URI, возвращает строку
    private function getURI(){
        if(!empty($_SERVER["REQUEST_URI"])){
            //Возвращает строку, удаляя из нее пробелы
            return trim($_SERVER["REQUEST_URI"], "/");
        }
    }
    public function run()
    {
        //Получаем строку запроса
        $uri = $this->getURI();
        //Проверяем наличие такого запроса в routes.php
        foreach($this->routes as $uriPattern=>$path)
        {
            //Сравниваем $uriPattern и $uri
            if(preg_match("~^$uriPattern$~", $uri))
            {
                //Получаем внутренний маршрут из внешнего.
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                //Разделяем строку на элементы массива по знаку "/"
                $segments = explode("/", $internalRoute);
                //Получаем и составляем имя контроллера.
                $controllerName = ucfirst(array_shift($segments)."Controller");
                //Получаем и составляем имя action
                $actionName = "action".ucfirst(array_shift($segments));
                //Получаем параметры запроса
                $parameters = $segments;
                //Подключаем файл класса контроллера
                //Составляем путь к файлу контроллера
                $controllerFile = ROOT."/controllers/".$controllerName.".php";
                //Если существует данный файл, то подключить его
                if(file_exists($controllerFile))
                {
                    include_once($controllerFile);
                }
                //Создаем объект класса контролллера
                $controllerObject = new $controllerName;
                //Вызываем action($actionName) с параметрами запроса($parameters)
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                //Если результат получен, то прекратить выполнение
                if($result != NULL)
                {
                    break;
                }
            }
        }
    }
}