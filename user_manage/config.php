<?php
//file chưas hằng số cần thiết
const _MODULE_DEFAULT = 'home';
const _ACTION_DEFAULT = 'list';

const _INCODE = true;// ngawn chanwj hành vi truy cập trực tiếp vào file

define('_WEB_HOST_ROOT', 'http://'.$_SERVER['HTTP_HOST'].'/PHP/modunl5/user_manage');
define('_WEB_HOST_TEMPLATE', _WEB_HOST_ROOT.'/template');
define('_WEB_PATH_ROOT', __DIR__);
define('_WEB_PATH_TEMPLATE', _WEB_PATH_ROOT.'/template');
// hằng số kết nối data base
const __HOST = 'localhost';
const __DB = 'student';
const __USER = 'root';
const __PASSWORD = '';
const __DRIVER = 'mysql';
