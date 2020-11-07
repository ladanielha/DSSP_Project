<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset    = "utf-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name       = "viewport" content        = "width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name = "description" content = "Project">
    <meta name = "author" content      = "WeAre">
    
    <title>My School</title>

    <!-- Load File CSS Bootstrap  -->
    <link href = "<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel = "stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src = "https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src = "https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    body {
        min-height : 2000px;
        padding-top: 120px;
    }
    </style>
    <!-- Load file Javascript FontAwesome, Bootstrap & jQuery -->
    <script src=" <?php echo base_url('assets/js/fontawesome.js');?> "></script>
    <script src  = "<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    <script src  = "<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script type = "text/javascript">
        $( document ).ready(function() {
            $("#nav-<?php echo $curr_page; ?>").addClass('active');
        });
    </script>
</head>
<body>
    <!-- Fixed navbar -->
    <?php
    /*
    * Variabel $headernya diambil dari core MY_Controller
    * (application/core/MY_Controller.php)
    * */
    echo $headernya;
    ?>

    <div class = "<?php echo ($curr_page != "home" && $curr_page != "profile" ? "container-fluid" : "container"); ?>">
        <?php
        /*
        * Variabel $contentnya diambil dari core MY_Controller
        * (application/core/MY_Controller.php)
        * */
        echo $contentnya;
        ?>
    </div>
</body>
</html>