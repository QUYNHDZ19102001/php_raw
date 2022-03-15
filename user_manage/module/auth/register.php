<?php
if (!defined('_INCODE')) die('access deined...');
//file này đăng ký
$dataTitle = [
    'datatitle' => 'đăng ký',
];

layout('head-login', $dataTitle);

// sử lý đăng ký 
if (isPost()) {
    //vadilate form 
    $body = getBody();// laays tất cả dữ liệu trong form 
    $error = [] ; // array luw truu all loi

    // validate ho tien :
    if (empty($body['fullname'])) {
        $error['fullname']['required'] = 'uses không được bỏ trống';
    } else {
        if (strlen(trim($body['fullname'])) < 5) {
            $error['fullname']['min'] = 'use phải lớn hơn 5 ký tự';
        }

    }
    // validate phone đăng ký 
    if (empty(trim($body['phone']))) {
        $error['phone']['required'] = 'phone không được bỏ trống';
    } else {
        if (!isPhone($body['phone'])) {
            $error['phone']['isphone'] = 'sdt không hợp lệ'; 
        }
        
    }
    // validation email đăng kys
    if (empty(trim($body['email']))) {
        $error['email']['required'] = 'email không được bỏ trống';
    } else {
        // kiem tra email hop le 
        if (!isEmail(trim($body['email']))) {
            $error['email']['isemail'] = 'email không hợp lệ';
        }// else {
        //     $email = trim($body['email']);
        //     // email có tồn tại trong database 
        //     $sql = "SELECT id FROM users WHERE email ='$email' ";
        //     if (getRows($sql) > 0) {
        //         $error['email']['unique'] = 'địa chỉ email đã tồn tại';
        //     } 
        // }
    }
    // vadilate password 

    if (empty(trim($body['password']))) {
        $error['password']['required'] = 'password không được bỏ trống';

    } else {
        if (strlen(trim($body['password'])) < 8)  {
            $error['password']['min'] = 'password quá ngắn';
        }
    }

    // validate confirm_password

    if (empty(trim($body['confirm_password']))) {
        $error['confirm_password']['required'] = 'confirm_password không được bỏ trống';

    } else {
        if ((trim($body['confirm_password'])) != (trim($body['password']))) {
            $error['confirm_password']['equa'] = 'confirm_password không đúng';
        }
    }
    if (empty($error)) {
        // setFlashData('msg', 'đăng ký thành công');
        // setFlashData('msg_type', 'success');
        // redirect('?module=auth&action=login');
        $activeToken = sha1(uniqid().time());
        $insertData = [
            'fullname' => $body['fullname'],
            'email' => $body['email'],
            'phone' => $body['phone'],
            'password' => password_hash($body['password'], PASSWORD_DEFAULT),
            'activeToken' => $activeToken,
            'createAt' => date('Y-m-d H:i:s'),
            

        ];
        $insertStatus = insert('users', $insertData);
        if ($insertStatus) {
            $linkAction = _WEB_HOST_ROOT.'?module=auth&action=active&token='.$activeToken;


        // thiết lập gửi mail 
            $subject = $body['fullname'].'vui lòng kích hoạt tài khoản';
            $content = 'chào bạn: '.$body['fullname'].'<br/>';
            $content.= 'vui lòng click vào link dưới đây để kích hoạt tài khoản:'.'<br/>';
            $content.= $linkAction.'<br/>';
            $content.= 'thân ái!';

        // tiến hành gửi mail 
            $sendMail = sendMail($body['email'], $subject, $content);
           
            if ($sendMail == true) {
               
            }  else {
               setFlashData('msg', 'đăng ký thành công. vui lòng kiểm tra email');
               setFlashData('msg_type', 'success');
            //    setFlashData('msg', 'hệ thống đang gặp sự cố . vui lòng thử lại sau !');
            //    setFlashData('msg_type', 'danger');
            }
            
        } else {
            setFlashData('msg', 'hệ thống đang gặp sự cố . vui lòng thử lại sau !');
            setFlashData('msg_type', 'danger');
        }

        // tạo link kích hoạt: 
        
        redirect('?module=auth&action=register');

    } else {
        setFlashData('msg', 'vui lòng kiểm tra dữ liệu đầu vào ');
        setFlashData('msg_type', 'danger');
        setFlashData('error', $error);
        setFlashData('old', $body);
        redirect('?module=auth&action=register');// load laij trang đăng ký
    }

   
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$error = getFlashData('error');
$old = getFlashData('old');



?>
<div class="row">
    <div class="col-6" style="margin: 20px auto;">
        <h3 class="text-center">đăng ký tài khoản </h3>
        <?php
        getMsg($msg, $msgType);

        ?>
        <form action="" method="post"> 
            <div class="from-group">
                <label for="">user name</label>
                <input type="text" name="fullname" class="form-control" placeholder = "fullname..." value="<?php echo old('fullname', $old); ?>" >

                <?php echo form_error('fullname', $error, '<span class="error">',' </span>' );?>
                
                
            </div>
            <div class="from-group">
                <label for="">số điện thoại</label>
                <input type="text" name="phone" class="form-control" placeholder = "nhập số điện thoại "value="<?php echo old('phone', $old);?>"  >
                <?php echo form_error('phone', $error, '<span class="error">',' </span>' );?>
                
            </div>
            <div class="from-group">
                <label for="">email </label>
                <input type="email" name="email" class="form-control" placeholder = "địa chỉ email..."value="<?php echo old('email', $old);?>"  >
                <?php echo form_error('email', $error, '<span class="error">',' </span>' );?>
                
            </div>
            <div class="from-group">
                <label for=""> mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder = "password..." >
                <?php echo form_error('password', $error, '<span class="error">',' </span>' );?>
                
            </div>
            <div class="from-group">
                <label for="">nhập lại mật khẩu </label>
                <input type="password" name="confirm_password" class="form-control" placeholder = "password..." >
                <?php echo form_error('confirm_password', $error, '<span class="error">',' </span>' );?>
                
            </div>
            <button type="submit" class="btn btn-primary" >đăng ký  </button>
            <hr>
            
            <p class="text-center"> <a href="?module=auth&action=login"> đăng nhập hệ thống</a></p>
        </form>
    </div>
</div>
<?php
