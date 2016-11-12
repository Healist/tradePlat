<div class="header navbar-fixed">
    <nav>
        <div class="nav-wrapper white">
        <a href="./index.php" class="logo">
            <em class="em1">工大</em>
            <em class="em2">二手工坊</em>
        </a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <?php 
              if(isset($_SESSION['user'])) {
                echo "<li class=\"publish-btn\">
                <a href=\"./public.php\"><button class=\"red lighten-1 waves-effect waves-light btn \" data-delay=\"50\">我要发布</button></a></li>";
              } else {
                echo "<li class=\"publish-btn\">
                <button class=\"red lighten-1 waves-effect waves-light btn tooltipped\" data-position=\"bottom\" data-delay=\"50\" data-tooltip=\"需要先登录哦\">我要发布</button></li>";
              }
           ?>
          <?php 
              if(isset($_SESSION['user'])) {
                echo "<li><a href='./myGoods.php'>我发布的商品</a></li>";
                echo "<li><a href='#'>".$_SESSION['user']."</a></li>";
                echo "<li><a href=\"javascript:;\" class='dropdown-button' data-activates='dropdown1'><i class=\"material-icons dp48\">view_list</i></a>
                  <ul id='dropdown1' class='dropdown-content'>
                    <li><a href=\"./change/changeName.php\">更改用户名</a></li>
                    <li><a href=\"./change/changePwd.php\">更改密码</a></li>
                    <li class=\"divider\"></li>
                    <li><a href=\"./quit.php\">退出</a></li>
                  </ul>
                </li>";
              } else {
                echo "<li><a href='./login'>登陆</a></li>
                    <li><a href='./signup'>注册</a></li>";
              } 
           ?>
        </ul>
        </div>
    </nav>
</div>