<?php 
	header('Content-Type: text/html; charset=UTF-8');

	session_start();
	
	if (!isset($_SESSION['user'])) {
        include '404.html';
        exit();
    }

	include './connect/mysql.php';
	include './function.php';

	$name = trim($_POST['name']);
	$tel = trim($_POST['tel']);
	$school = trim($_POST['school']);
	$cutdwon = trim($_POST['cutdown']);
	$des   =   trim($_POST['description']);
	$price = trim($_POST['price']);
	$type  = trim($_POST['type']);
	$count = trim($_POST['count']);
 	$date = date('Y-m-d H:i:s',time());

	$path = "./upload/";
	$typelist = "";

	//暂时默认的值
	$userId = '1';


	$upinfo = uploadFile("pic",$path,$typelist);
	if($upinfo['error'] == false){
		die("文件上传失败:".$upinfo["info"]);
	} else {
		//获取上传成功的文件名
		$fileName = $upinfo['info'];
		//文件路径(相对地址)
		$filePath = $upinfo['path'];		
	}

	if(is_null($name) || is_null($tel) || is_null($school) || is_null($cutdwon) || is_null($des) || is_null($type) || is_null($count)) {
		echo "<script>alert('输入可能有空值哦')</script>";
		exit();
	} else {
		$sql = "insert into resource(id,userId,name,price,path,description,school,canCut,type,date,count) values(null,'{$userId}','{$name}','{$price}','{$filePath}','{$des}','{$school}','{$cutdwon}','$type','$date','$count')";
		//echo $sql;
		@mysqli_query("SET NAMES UTF8");
		$res = mysqli_query($link,$sql);

		if(isset($res)) {
			echo "<script>alert('上传成功！');window.location='submit.html';</script>";
			exit();
		} else {
			echo "<script>alert('上传失败！');window.location='submit.html';</script>";
			exit();
		}

	}

 ?>