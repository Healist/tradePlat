<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" charset="utf8" />
    <title>工大二手交易平台</title>
    <!--Import materialize.css-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/index.css"/>
    <link type="text/css" rel="stylesheet" href="css/detail.css"/>
    <style type="text/css">
        [v-cloak] {
          display: none;
        }
    </style>
</head>
<body>
    <?php
        session_start();
        include './components/header.php';
     ?>

    <div id="box1">
        <div class="detail-box row">

            <div class="col s12 path" v-for="item in source" v-cloak>
                <a v-if="item.type == '闲置数码'" href="./shuma.php">{{item.type}}</a>
                <a v-if="item.type == '校园代步'" href="./daibu.php">{{item.type}}</a>
                <a v-if="item.type == '电器日用'" href="./dianqi.php">{{item.type}}</a>
                <a v-if="item.type == '图书教材'" href="./tushu.php">{{item.type}}</a>
                <a v-if="item.type == '美妆衣物'" href="./mzyw.php">{{item.type}}</a>
                <a v-if="item.type == '运动棋牌'" href="./sports.php">{{item.type}}</a>
                <a v-if="item.type == '其他'    " href="./other.php">{{item.type}}</a>
                <em>></em>
                <a>{{item.name}}</a>
            </div>

            <div class="col s6"   v-for="item in source">
                <div class="slider" style="overflow: hidden;">
                    <img :src="item.path" style="width: 100%;height: 100%;">
                </div>
            </div>

            <div class="col s6"  v-for="item in source"  v-cloak>
                <h1 class="item-name">{{item.resourceName}}</h1>
                <h2 class="item-price">￥{{item.price}}</h2>
                <div class="item-public-info">
                    <p class="bargain">{{item.canCut}}</p>
                    <p>
                        <i class="material-icons dp48">room</i>
                        <em class="item-location" style="position: relative;top:-5px;">{{item.school}}</em>
                    </p>
                </div>

                <div class="publisher-info-title">
                    <em>卖家信息</em>
                    <hr>
                </div>

                <div class="item-contact" v-for="item in source">
                    <?php 
                        if(isset($_SESSION['user'])) {
                            echo "<div class=\"row\">
                                <div class=\"base-blue z-depth-1 attr col s1\"><i class=\"material-icons dp48\" style=\"position:relative;top:7px;left:-4px;\">contacts</i></div>
                                <div class=\"value  col s11\">{{item.adminName}}</div>
                            </div>
                            <div>
                                <div class=\"base-blue z-depth-1 attr col s1\"><i class=\"material-icons dp48\" style=\"position:relative;top:7px;left:-4px;\">dialer_sip</i></div>
                                <div class=\"value col s11\">{{item.telephone}}</div>
                            </div>";
                        } else {
                            echo "<p class=\"not-login\">请您先登录吧</p><a href=\"./login\">登陆</a>";
                        }
                     ?> 
                    <h1 class="item-pub-time" style="position: relative;top: 25px;">发布于 {{item.date}}</h1>
                </div>
            </div>
        </div>

        <div class="detail-box row" v-for="item in source"   v-cloak>
            <h1 class="title">商品详情</h1>
            <hr class="hr1">
            <hr class="hr2">
            <p class="section"> {{item.description}} </p>
            <p class="section">联系我的时候说是工大二手工坊看见的哦</p>
        </div>
        

        <div class="row detail-area">
            <div class="col s12"> 
                <div class="comment">
                    <h1 class="title">评论</h1>
                    <hr class="hr1">
                    <hr class="hr2">
                    <!--评论 -->
                    <div class="comment-collection" v-for="item in comment"   v-cloak>
                        <div class="comment-item">
                            <div class="comment-main-content">
                                <em class="name">{{item.adminName}}:</em>
                                <em class="content">{{item.commentContent}}</em>
                            </div>
                            <div class="comment-function">
                                <em class="time">{{item.commentDate}}</em>
                                <i v-show="<?php echo $_SESSION['user']; ?> != ''">
                                    <a class="reply-or-delete" v-if="item.commentUser == <?php echo $_SESSION['userId']; ?>" data-id="{{item.commentId}}" href='javascript:doDel({{item.commentId}})'>删除</a>
                                    <a onclick="modalTrigger({{item.commentId}})" class="reply-or-delete reply" v-else>回复</a>
                                </i>
                            </div>
                        </div>
                        <div class="comment-item" v-if="item.reply" v-for="rep in item.reply">
                            <div class="comment-main-content">
                                <em class="name">{{rep.replyUser}}:</em>
                                <em class="name">回复</em>
                                <em class="name">@{{rep.commentUserName}}:</em>
                                <em class="content">{{rep.replyContent}}</em>
                            </div>
                            <div class="comment-function">
                                <em class="time">{{rep.replyDate}}</em>
                                <i v-show="<?php echo $_SESSION['user']; ?> != ''">
                                    <a class="reply-or-delete" v-if="rep.replyUserId == <?php echo $_SESSION['userId']; ?>" data-id="{{rep.replyId}}" href='javascript:doDelReply({{rep.replyId}})'>删除</a>
                                    <a onclick="modalTrigger2({{rep.replyCommentId}}, {{rep.replyId}})" class="reply-or-delete reply" v-else>回复</a>
                                </i>
                            </div>
                        </div>
                    </div>
                    <div class="comment-add row">
                        <div class="input-field col s12">
                            <form method="post" id="myform">
                                <i class="iconfont"></i>
                                <input id="commentbox" type="text" class="validate" name="content"></input>
                                <input type="hidden" name="sourceId"></input>
                                <label for="commentbox">这里写下评论</label>
                                <a class="wave-effect wave-light btn comment-submit">确认</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                        

    <!-- 评论的回复！ -->
    <!-- Modal Structure -->
    <div id="modal1" class="modal modal-fixed-footer">
        <form id="replyForm" method="post">
            <input type="hidden" name="sourceId"></input>
            <input type="hidden" name="commentId"></input>
            <input type="hidden" name="type"></input>
            <input type="hidden" name="to_id"></input>
            <div class="modal-content">
                <h4>回复</h4>
                <textarea id="replyContent" rows="5" cols="20" style="width: 100%;height: 250px;" name="replyContent" placeholder="留下你的精彩点评吧"></textarea>
            </div>
                <div class="modal-footer">
                <a href="javascript:replySubmit(1, 0)" class="modal-action modal-close waves-effect waves-green btn-flat ">提交</a>
            </div>
        </form>
    </div>

    <!-- 回复的回复！ -->
    <!-- Modal Structure -->
    <div id="modal2" class="modal modal-fixed-footer">
        <form id="replyForm2" method="post">
            <input type="hidden" name="sourceId"></input>
            <input type="hidden" name="commentId"></input>
            <input type="hidden" name="type"></input>
            <input type="hidden" name="to_id"></input>
            <div class="modal-content">
                <h4>回复</h4>
                <textarea id="replyContent2" rows="5" cols="20" style="width: 100%;height: 250px;" name="replyContent" placeholder="留下你的精彩点评吧"></textarea>
            </div>
                <div class="modal-footer">
                <a href="javascript:replySubmit2(2)" class="modal-action modal-close waves-effect waves-green btn-flat ">提交</a>
            </div>
        </form>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/vue.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/details.js"></script>
    <script type="text/javascript" src="js/dropdown.js"></script>

</body>
</html>