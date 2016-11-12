<?php
  $link = mysqli_connect('localhost:3306', 'root', '') or die('暂停服务');
  mysqli_select_db($link,"tradeplat") or die('暂停服务');
?>