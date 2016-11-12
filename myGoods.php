<?php 
    session_start();
    if (!isset($_SESSION['user'])) {
        include '404.html';
        exit();
    }
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <title>我的发布</title>
    <!--Import materialize.css-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/index.css"/>
</head>
<body>
    <?php
        include './components/header.php';
     ?>

     <div class="index-title">
        <a href="#">我的发布</a>
        <hr class="hr1">
        <hr class="hr2">
    </div>

    <div class="components row" id="box1">
        <!-- 模板 -->
        <div class="card col" v-for="item in source">
            <a href="./details.php?id={{item.id}}">
                <div class="card-image"><img style="width: 100%;height: 100%;" :src="item.path"></div>
                <div class="card-content item-price">￥{{item.price}}</div>
                <div class="card-content item-name">
                    <p>{{item.name}}</p>
                </div>
                <div class="card-content item-location">
                    <p>{{item.school}}</p>
                    <p>{{item.date}}</p>
                </div>
            </a>
        </div>
    </div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/vue.js"></script>
    <script type="text/javascript" src="js/dropdown.js"></script>

    <?php 
        echo "<script type=\"text/javascript\">
            $.ajax({
                    url: 'http://localhost/tradeplat/api/source/1/1000/".$_SESSION['userId']."',
                    type: 'get',
                    dataType: 'json',
                    success: function (datas) {
                        //首页热门
                        var hotIndex = new Vue({
                            el:\"#box1\",
                            data:datas
                        });
                    }
            });
        </script>";
     ?>
    
</body>
</html>