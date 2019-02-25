<!DOCTYPE html>
<!--[if lt IE 7 > <html lang="en" class="no-js ie6 lt8"> <![endif-->
<!--[if IE 7 >    <html lang="en" class="no-js ie7 lt8"> <![endif-->
<!--[if IE 8 >    <html lang="en" class="no-js ie8 lt8"> <![endif-->
<!--[if IE 9 >    <html lang="en" class="no-js ie9"> <![endif-->
<!--[if (gt IE 9)|!(IE)><!--> <html lang="en" class="no-js"> <!--<![endif-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title><?php echo $page_title; ?></title>
        <!-- css -->
        <link rel="stylesheet" href="<?php base_url()?>assets/auth/css/demo.css">
        <?php 
        foreach ($css as $key => $value) {
            echo $value;
        }
        ?>
        <link rel="stylesheet" href="<?php base_url()?>assets/css/style.css">

        <script src="<?php echo base_url() ?>assets/js/jquery-3.2.1.js"></script>
        <!-- js -->
        <?php 
        if(!empty($js)){
            foreach ($js as $key => $value) {
                echo $value;
            }
        }
        ?>

    </head>
    <body>
