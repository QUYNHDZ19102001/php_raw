<?php
if (!defined('_INCODE')) die('access deined...');

try {
    if (class_exists('PDO')) {
        $dsn = __DRIVER.':dbname='.__DB.';host='.__HOST;
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // đẩy lỗi vào ex khi truy vấn
        ];
        $conn = new PDO($dsn, __USER, __PASSWORD, $options);

        // var_dump($conn);
    }

}
catch (Exception $e) {
    require_once 'module/erorr/databases.php';
    die();
}