<!DOCTYPE html>
<html lang = "en">
<head>
    <meta http-equiv = "content-type" content = "text/html; charset=UTF-8">
    <meta charset = "utf-8">
    <title>High Ground</title>
    <meta name = "generator" content = "Bootply"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <meta name = "viewport" content = "width=device-width, initial-scale=1, maximum-scale=1">
    <link href = "css/bootstrap.min.css" rel = "stylesheet">
    <!--[if lt IE 9]>
    <script src = "//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script src = "https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src = "https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDH2y8b0SM5NLLOSyI35DI8b2dbfedAZn0"></script>

    <link href = "css/highGround.css" rel = "stylesheet">
</head>
<body>
<div class="navbar navbar-custom navbar-fixed-top">
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Priority Queue</a></li>
            <li><a href="navigationContent">High Ground</a></li>
        </ul>
    </div>
</div>
<!-- begin template -->
<div id = "map-canvas"></div>
<div class = "container-fluid" id = "main">
    <div class = "row">
        <div class = "col-xs-8" id = "left">
            <h2>Priority Queue</h2>
            <?php if(isset($queue)){ echo $queue; } ?>
        </div>
        <div class = "col-xs-4"><!--map-canvas will be postioned here--></div>

    </div>
</div>
<div id = 'pageModalContainer' style = 'display: none;'/>
<!-- end template -->

<!-- script references -->
<script src = "<?php echo _site . '/javascript/mustache.min.js' ?>"></script>
<script src = "//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src = "js/bootstrap.min.js"></script>
<script src = "http://maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed"></script>
<script src = "js/highGround.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script id = "pinDetailsTemplate" type = "x-tmpl-mustache">
    <?php require __DIR__ . DIRECTORY_SEPARATOR . 'views/pinDetailsTemplate.mustache'; ?>

</script>
<script id = "sendMessageTemplate" type = "x-tmpl-mustache">
    <?php require __DIR__ . DIRECTORY_SEPARATOR . 'views/sendMessage.mustache'; ?>

</script>
</body>
</html>