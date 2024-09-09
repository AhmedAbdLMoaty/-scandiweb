<?php
class App {
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];
    private $db; // Explicitly declare the $db property

    public function __construct($db) {
        $this->db = $db; // Assign the database connection to the $db property
        $url = $this->parseUrl();

        // Check if URL is empty and default to Home controller
        if (empty($url[0])) {
            $url[0] = 'home';
        }

        // Whitelist of allowed controllers
        $allowedControllers = ['home', 'add-product'];

        // Convert URL to lowercase and check if it's in the allowed controllers
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
                    // Handle the case where the class is not found
                    echo "Class $controllerClass not found.";
                    exit();
                }
            } else {
                // Handle the case where the controller file is not found
                echo "Controller file $controllerFile not found.";
                exit();
            }
        } else {
            // Handle the case where the controller is not allowed
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