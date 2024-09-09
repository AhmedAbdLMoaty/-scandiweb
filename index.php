<?php
require_once './app/config.php';
require_once './app/core/app.php';
require_once './app/core/controller.php';
require_once './app/core/database.php';
$database = new Database();
$db = $database->getConnection();
$app = new App($db);