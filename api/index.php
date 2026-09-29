<?php 
require __DIR__ .'/../public/index.php';
if (isset($_SERVER['REQUEST_URI'])) {
    $_SERVER['SCRIPT_NAME'] = '/index.php';
}