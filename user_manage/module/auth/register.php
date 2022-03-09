<?php
if (!defined('_INCODE')) die('access deined...');
//file này đăng ký
$dataTitle = [
    'datatitle' => 'đăng ký',
];

layout('head-login', $dataTitle);
?>
<div class="row">
    <div class="col-6" style="margin: 20px auto;">
        <h3 class="text-center">đăng ký tài khoản </h3>
        <from action="" method="post"> 
            <div class="from-group">
                <label for="">user name</label>
                <input type="email" class="form-control" placeholder = "địa chỉ email..." >
                
            </div>
            <div class="from-group">
                <label for="">số điện thoại</label>
                <input type="text" class="form-control" placeholder = "nhập số điện thoại " >
                
            </div>
            <div class="from-group">
                <label for="">email </label>
                <input type="email" class="form-control" placeholder = "địa chỉ email..." >
                
            </div>
            <div class="from-group">
                <label for=""> mật khẩu</label>
                <input type="password" class="form-control" placeholder = "password..." >
                
            </div>
            <div class="from-group">
                <label for="">nhập lại mật khẩu </label>
                <input type="password" class="form-control" placeholder = "password..." >
                
            </div>
            <button type="submit" class="btn btn-primary" >đăng ký  </button>
            <hr>
            
            <p class="text-center"> <a href="?module=auth&action=login"> đã có tài khoản</a></p>
        </from>
    </div>
</div>
<?php
