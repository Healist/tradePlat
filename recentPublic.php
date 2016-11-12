<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" charset="utf8" />
    <title>工大二手交易平台</title>
    <!--Import materialize.css-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/index.css"/>
    <style type="text/css">
        [v-cloak] {
          display: none;
        }
    </style>
</head>
<body onload="">
    <?php 

        include './components/header.php';

        include './components/sidebar.php';

     ?>

    <div class="main-content">

        <!-- <div class="progress" style="position: relative;top: 30px;width: 80%;margin: 0 auto;">
            <div class="indeterminate"></div>
        </div> -->

        <!-- 最新发布模块 -->
        <div class="index-title">
            <a href="">最新发布</a>
            <hr class="hr1">
            <hr class="hr2">
        </div>

        <div class="components row" id="box1">
            <!-- 模板 -->
            <div class="card col" v-for="item in source" v-cloak>
                <a href="./details.php?id={{item.id}}">
                    <div class="card-image"><img style="width: 100%;height: 100%;" src="{{item.path}}"></div>
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

    </div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/jquery.loadTemplate-1.4.3.min.js"></script>
    <script type="text/javascript" src="js/vue.js"></script>
    <script type="text/javascript" src="js/all.js"></script>
    <script type="text/javascript" src="js/index.js"></script>

    <script type="text/javascript" src="js/dropdown.js"></script>
    
</body>
</html>