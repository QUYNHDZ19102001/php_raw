<?php
if (!defined('_INCODE')) die('access deined...');


?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ! empty($dataTitle['datatitle']) ? $dataTitle['datatitle']:'Unicode'  ?></title>
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE;?>/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE;?>/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE;?>/css/style.css?ver=<?php echo rand();?>" />
</head>
<body>
    
