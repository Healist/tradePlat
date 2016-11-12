<?php
  SESSION_start();
  header("Content-Type: text/html; charset=UTF-8");
  if(!isset($_SESSION['user'])){//判断是否登录
   	  echo '<meta http-equiv="refresh" content="0;url=./login">';//定时跳转
    }
    else{
      unset ($_SESSION['login']);//销毁session以退出登录
      unset ($_SESSION['user']);
      echo '<meta http-equiv="refresh" content="0;url=./">';
    }
?>