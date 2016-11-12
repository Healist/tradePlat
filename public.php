<?php 
	session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<title>发布商品</title>
	<!--Import materialize.css-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/index.css"/>
</head>
<body>
	<?php
		include './components/header.php';
	 ?>

	 <div class="container" style="background-color: white;margin-top: 80px;padding: 40px;">
	 	<div class="row">
		    <form class="col s12" action="action/action.php?action=public" method="post" enctype="multipart/form-data">
		      <div class="row">

		        <div class="input-field col s6">
		          <input id="icon_prefix" type="text" class="validate" name="name">
		          <label for="icon_prefix">商品名称</label>
		        </div>

		        <div class="input-field col s6">
		          <input id="icon_telephone" type="tel" class="validate" name="price">
		          <label for="icon_telephone">商品价格</label>
		        </div>
		        
		        <div class="input-field col s12">
		          <input id="count" type="number" class="validate" name="count">
		          <label for="count">数量</label>
		        </div>    

		        <div class="row">
				        <div class="input-field col s12">
				          <textarea id="textarea1" class="materialize-textarea" name="description"></textarea>
				          <label for="textarea1">商品描述</label>
				        </div>
				  </div>

		        <div class="input-field col s6">
				    <select name="school">
				      <option value="" disabled selected>选择</option>
				      <option value="0">新区</option>
				      <option value="1">老区</option>
				    </select>
				    <label>校区选择</label>
				 </div>


				 <div class="input-field col s6">
				    <select name="type">
				      <option value="" disabled selected>类别</option>
				      <option value="1">闲置数码</option>
				      <option value="2">校园代步</option>
				      <option value="3">电器日用</option>
				      <option value="4">图书教材</option>
				      <option value="5">美妆衣物</option>
				      <option value="6">运动棋牌</option>
				      <option value="7">其他</option>
				    </select>
				    <label>类别选择</label>
				 </div>

			    <div class="file-field input-field row" style="position: relative;top: 50px;">
			      <div class="btn col s2">
			        <span>上传商品图片</span>
			        <input type="file"  name="pic"/>
			      </div>
			      <input class="file-path validate col s10" type="text"/>
			    </div>


			    <div class="s12" style="position: relative;top: 50px;">
			    	<p class="center-align" style="display: inline-block;margin-left: 40%;">
				      <input name="cutdown" type="radio" id="test1" value="1" />
				      <label for="test1">可讲价</label>
				    </p>
				    <p class="center-align" style="display: inline-block;margin-left: 50px;">
				      <input name="cutdown" type="radio" id="test2" value="2" />
				      <label for="test2">不可讲价</label>
				    </p> 
			    </div>   

			    <div class="col s12 center-align" style="position: relative;top: 70px;">
			    	<button class="btn" type="submit">提交</button>
			    </div>

		      </div>
		    </form>
		  </div>
	 </div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/vue.js"></script>
    <script type="text/javascript" src="js/dropdown.js"></script>
    <script type="text/javascript">
    	$(document).ready(function() {
	    	$('select').material_select();
	  	});
    </script>
</body>
</html>