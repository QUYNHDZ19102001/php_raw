<?php
if (!defined('_INCODE')) die('access deined...');
// file này chứa login đăng nhập
$dataTitle = [
    'datatitle' => 'đăng nhập hệ thống',
];



layout('head-login',$dataTitle );


if (isPost()) {
    $a = getBody();
    echo '<pre>';

    print_r($a);
    echo '</pre>';
}


?>
<div class="row">
    <div class="col-6" style="margin: 20px auto;">
        <h3 class="text-center">đăng nhập hệ thống</h3>
        <form action="" method="post"> 
            <div class="from-group">
                <label for=""> Email</label>
                <input type="email" name="email" class="form-control" placeholder = "địa chỉ email..." >
                
            </div>
            <div class="from-group">
                <label for=""> mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder = "password..." >
                
            </div>
            <button type="submit" class="btn btn-primary" style ="margin: 0 auto;"> đăng nhập </button>
            <hr>
            <p class="text-center"> <a href="?module=auth&action=forgot"> quên mật khẩu</a></p>
            <p class="text-center"> <a href="?module=auth&action=register"> đăng ký tài khoản mới</a></p>
        </form>
    </div>
</div>
<?php

layout('footer-login');