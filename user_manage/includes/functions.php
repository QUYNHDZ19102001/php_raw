<?php
if (!defined('_INCODE')) die('access deined...');
function layout($layoutName = 'head', $dataTitle = []) {
    if(file_exists(_WEB_PATH_TEMPLATE.'/layout/'.$layoutName.'.php')) {
        require_once _WEB_PATH_TEMPLATE.'/layout/'.$layoutName.'.php';
    }
}
