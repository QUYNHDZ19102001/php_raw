<?php
if (!defined('_INCODE')) die('access deined...');
// file này chứa quên mật khẩu
$dataTitle = [
    'datatitle' => 'quên mật khẩu ',
];

layout('head-login', $dataTitle);
?>
<div class="row">
    <div class="col-6" style="margin: 20px auto;">
        <h3 class="text-center">đặt lại mật khẩu </h3>
        <from action="" method="post"> 
            <div class="from-group">
                <label for="">địa chỉ Email quên mật khẩu ....</label>
                <input type="email" class="form-control" placeholder = "địa chỉ email..." >
                
            </div>
           
            <button type="submit" class="btn btn-primary" style ="margin: 0 auto;"> submit </button>
            <hr>
            <p class="text-center"> <a href="?module=auth&action=register"> đăng ký tài khoản mới</a></p>
        </from>
    </div>
</div>
<?php
?>