<?php
if (!defined('_INCODE')) die('access deined...');
?>
<div style= "width: 600px; padding: 20px 30px; text-align: center; margin: 0 auto;"> 
   <h3> lỗi biên dịch <h3> 
   </hr>
   <p><?php echo $e-> getMessage();?> <p>
   <p>file: <?php echo $e -> getFile();?></p>
   <p>line: <?php echo $e -> getLine();?></p>

<div>
