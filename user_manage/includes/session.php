<?php
if (!defined('_INCODE')) die('access deined...');
// file chuứa thao tác liên quan tới người dùng
function setSession($key, $value) { // gans sessoin
    if (!empty(session_id())) {
        $_SESSION[$key] = $value;
        return true;
    }
    return false;
}
// docj sessoin
function getSession($key='') {
    if (empty($key)) {
        return $_SESSION;
    } else {
       if ( isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }
    return false;
}
// hamf xoa sessoin 
function removeSession($key='') {
    if (empty($key)) {
        session_destroy();
        return true;
    }
    else {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
            return true;
        }
    }
    return false;
}

// hàm gán flast data 
function setFlashData($key, $value) {
    $key = 'flash_'.$key;
    return setSession($key, $value);
}
// ham docj flash_ data
function getFlashData($key) {
    $key = 'flash_'.$key;
    $data = getSession($key);
    removeSession($key);
    return $data;
}
