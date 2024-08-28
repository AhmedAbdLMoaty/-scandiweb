<?php
class App {
    protected $controller = "Home";
    protected $method = "index";
    protected $params = [];
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $url = $this->parseURL();

        $controllerClass = str_replace(' ', '', ucwords(str_replace('-', ' ', $url[0])));
        $controllerFile = "../app/controllers/" . ucfirst($url[0]) . ".php";

        if (file_exists($controllerFile)) {
            require $controllerFile;
        
            if (class_exists($controllerClass)) {
                $this->controller = new $controllerClass($this->db);
                unset($url[0]);

                if (isset($url[1]) && method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                }
            } else {
                $this->method = "index";
            }
        } else {
            $this->method = "index";
        }

        $this->params = $url ? array_values($url) : [];

        if (is_callable([$this->controller, $this->method])) {
            call_user_func_array([$this->controller, $this->method], $this->params);
        } else {
            if (method_exists($this->controller, 'index')) {
                $this->controller->index();
            } else {
                echo "404 - Method Not Found";
            }
        }
    }

    private function parseURL() {
        $url = isset($_GET['url']) ? $_GET['url'] : "home/index";
        return explode("/", filter_var(trim($url, "/"), FILTER_SANITIZE_URL));
    }
}



?>
