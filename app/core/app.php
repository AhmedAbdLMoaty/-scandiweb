<?php
class App {
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $url = $this->parseUrl();

        if (empty($url[0])) {
            $url[0] = 'home';
        }

        $allowedControllers = ['home', 'add-product'];

        $controllerName = strtolower($url[0]);
        if (in_array($controllerName, $allowedControllers)) {
            $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                $controllerClass = str_replace('-', '', ucfirst($controllerName));
                if (class_exists($controllerClass)) {
                    $this->controller = new $controllerClass($this->db);
                    unset($url[0]);
                } else {
                    echo "Class $controllerClass not found.";
                    exit();
                }
            } else {
                echo "Controller file $controllerFile not found.";
                exit();
            }
        } else {
            echo "Controller $controllerName is not allowed.";
            exit();
        }
        
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}