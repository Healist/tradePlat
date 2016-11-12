<?php 
    session_start();
 ?>
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
<body>
    <?php 

        include './components/header.php';

        include './components/sidebar.php';

     ?>

    <div class="main-content">
        
        <?php 
            include './components/slider-wapper.php';
         ?>

        <!-- 最新发布模块 -->
        <div class="index-title">
            <a href="recentPublic.php">最新发布</a>
            <hr class="hr1">
            <hr class="hr2">
        </div>

        <div class="components row" id="box1">
            <!-- 模板 -->
            <div class="card col" v-for="item in source" v-cloak>
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


        <!-- 闲置数码模块 -->
        <div class="index-title">
            <a href="shuma.php">闲置数码</a>
            <hr class="hr1">
            <hr class="hr2">
        </div>

        <div class="components row" id="box2">
            <!-- 模板 -->
            <div class="card col" v-for="item in source" v-cloak>
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

        <!-- 校园代步模块 -->
        <div class="index-title">
            <a href="daibu.php">校园代步</a>
            <hr class="hr1">
            <hr class="hr2">
        </div>

        <div class="components row" id="box3">
            <!-- 模板 -->
            <div class="card col" v-for="item in source" v-cloak>
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


        <!-- 电器日用模块 -->
        <div class="index-title">
            <a href="dianqi.php">电器日用</a>
            <hr class="hr1">
            <hr class="hr2">
        </div>

        <div class="components row" id="box4">
            <!-- 模板 -->
            <div class="card col" v-for="item in source" v-cloak>
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


        <!-- 图书教材模块 -->
        <div class="index-title">
            <a href="tushu.php">图书教材</a>
            <hr class="hr1">
            <hr class="hr2">
        </div>

        <div class="components row" id="box5">
            <!-- 模板 -->
            <div class="card col" v-for="item in source" v-cloak>
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


        <!-- 美妆衣物模块 -->
        <div class="index-title">
            <a href="mzyw.php">美妆衣物</a>
            <hr class="hr1">
            <hr class="hr2">
        </div>

        <div class="components row" id="box6">
            <!-- 模板 -->
            <div class="card col" v-for="item in source" v-cloak>
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


        <!-- 运动棋牌模块 -->
        <div class="index-title">
            <a href="sports.php">运动棋牌</a>
            <hr class="hr1">
            <hr class="hr2">
        </div>

        <div class="components row" id="box7">
            <!-- 模板 -->
            <div class="card col" v-for="item in source" v-cloak>
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


        <!-- 杂物模块 -->
        <div class="index-title">
            <a href="other.php">其他</a>
            <hr class="hr1">
            <hr class="hr2">
        </div>

        <div class="components row" id="box8">
            <!-- 模板 -->
            <div class="card col" v-for="item in source" v-cloak>
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

    </div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/vue.js"></script>
    <script type="text/javascript" src="js/jiexi.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/dropdown.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.slider').slider({full_width: true});
        });
    </script>
</body>
</html>