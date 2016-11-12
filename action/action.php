<?php 
	header('Content-Type: text/html; charset=UTF-8');
	session_start();

	include '../connect/mysql.php';

	$action = $_GET['action'];

	switch ($action) {
		case 'signup':
			$username =  trim($_POST['username']);
			$psw      =  trim($_POST['password']);
			$phone    =  trim($_POST['telephone']);

			$sql = "insert into admin(id,name,password,telephone) values(null,'{$username}','{$psw}','{$phone}')";

			@mysqli_query("SET NAMES UTF8");
			$res = mysqli_query($link,$sql);

			if($res) {
				echo "<script>alert('注册成功！');window.location='../index.php';</script>";
				exit();
			} else {
				echo "<script>alert('注册失败！');window.location='../signup';</script>";
				exit();
			}
			break;

		case 'login':
			$username =  addslashes(trim($_POST['username']));
			$psw      =  addslashes(trim($_POST['password']));

			if(empty($username) || empty($psw)) {
				echo "<script>alert('输入拥有空值');window.location='../login';</script>";
			 	exit();
			}

			$sql = "select * from admin where name = '{$username}' AND password = '{$psw}'";
			$res = mysqli_query($link,$sql);


			if($res && mysqli_num_rows($res) > 0) {
				$_SESSION['user'] = $username;
				$sql1 = "select id from admin where name = '{$username}' AND password = '{$psw}'";
				$res1 = mysqli_query($link,$sql);
				$row = mysqli_fetch_assoc($res1);
				$_SESSION['userId'] = $row['id'];
				//echo $_SESSION['userId'];
				echo "<script>alert('登陆成功！');window.location='../index.php';</script>";
				exit();
			} else {
				echo "<script>alert('登陆失败！');window.location='../login';</script>";
				exit();
			}

			break;

		case 'public':

			include '../function.php';

			$name = trim($_POST['name']);
			$school = trim($_POST['school']);
			$cutdwon = trim($_POST['cutdown']);
			$des   =   trim($_POST['description']);
			$price = trim($_POST['price']);
			$type  = trim($_POST['type']);
			$count = trim($_POST['count']);
		 	$date = date('Y-m-d H:i:s',time());

			$path = "../upload/";
			$userId = "";
			$typelist = "";

			$userId = $_SESSION['userId'];

			$upinfo = uploadFile("pic",$path,$typelist);
			if($upinfo['error'] == false){
				die("文件上传失败:".$upinfo["info"]);
			} else {
				//获取上传成功的文件名
				$fileName = $upinfo['info'];
				//文件路径(相对地址)
				$filePath = $upinfo['path'];		
			}

			if(is_null($name) || is_null($school) || is_null($cutdwon) || is_null($des) || is_null($type) || is_null($count)) {
				echo "<script>alert('输入可能有空值哦')</script>";
				exit();
			} else {
				$sql = "insert into resource(id,userId,name,price,path,description,school,canCut,type,date,count) values(null,'{$userId}','{$name}','{$price}','{$filePath}','{$des}','{$school}','{$cutdwon}','$type','$date','$count')";
				//echo $sql;
				@mysqli_query("SET NAMES UTF8");
				$res = mysqli_query($link,$sql);

				if(isset($res)) {
					echo "<script>alert('上传成功！');window.location='../';</script>";
					exit();
				} else {
					echo "<script>alert('上传失败！');window.location='../public.php';</script>";
					exit();
				}

			}
			break;
		
		case 'comment':
			$content =  trim($_POST['content']);
			$date    =  date('Y-m-d H:i:s',time());
			$userId  =  @$_SESSION['userId'];
			$sourceId=  trim($_POST['sourceId']);

			if(is_null($content) || $content == "") {
				echo "<script>alert('输入可能有空值哦!');window.location='../details.php?id=".$sourceId."';</script>";
				exit();
			} else if(is_null($userId)) {
				echo "<script>alert('请您先登陆吧!');window.location='../details.php?id=".$sourceId."';</script>";
			}else {
				$sql = "insert into comment(id,sourceId,userId,content,dates) values(null,'{$sourceId}','{$userId}','$content','$date')";
				//echo $sql;
				@mysqli_query("SET NAMES UTF8");
				$res = mysqli_query($link,$sql);

				if(isset($res)) {
					echo "<script>alert('评论成功！');window.location='../details.php?id=".$sourceId."';</script>";
					exit();
				} else {
					echo "<script>alert('评论失败！');window.location='../details.php?id=".$sourceId."';</script>";
					exit();
				}
			}
			break;

		case 'del':
			$id =  trim($_GET['id']);
			$sourceId = trim($_GET['sourceId']);
			if(!is_numeric($id) || !is_numeric($sourceId)) {
				echo "<script>alert(\"参数有误！\");window.location='../details.php?id={$sourceId}'</script>";
			} else {
				$sql = "select count(*) from comment where id = {$id}";
				$res=mysqli_query($link,$sql);
				if($res){
					$sql="delete from comment where id={$id}";
					mysqli_query($link,$sql);
					header("Location:../details.php?id={$sourceId}");
				} else {
					echo "<script>alert(\"该条数据不存在！操作有误！\");window.location='../details.php?id={$sourceId}'</script>";
				}
			}
			break;

		case 'del_reply':
			$id =  trim($_GET['id']);
			$sourceId = trim($_GET['sourceId']);
			if(!is_numeric($id) || !is_numeric($sourceId)) {
				echo "<script>alert(\"参数有误！\");window.location='../details.php?id={$sourceId}'</script>";
			} else {
				$sql = "select count(*) from reply where id = {$id}";
				$res=mysqli_query($link,$sql);
				if($res){
					$sql="delete from reply where id={$id}";
					mysqli_query($link,$sql);
					header("Location:../details.php?id={$sourceId}");
				} else {
					echo "<script>alert(\"该条数据不存在！操作有误！\");window.location='../details.php?id={$sourceId}'</script>";
				}
			}
			break;

		case 'reply':
			$content =  trim($_POST['replyContent']);
			$date    =  date('Y-m-d H:i:s',time());
			$userId  =  @$_SESSION['userId'];
			$sourceId=  trim($_POST['sourceId']);
			$commentId= trim($_POST['commentId']);
			$type     = trim($_POST['type']);
			$to_id    = trim($_POST['to_id']);

			// echo $content."<br>";
			// echo $date."<br>";
			// echo $userId."<br>";
			// echo $sourceId."<br>";
			// echo $commentId."<br>";
			// echo $type."<br>";
			// echo $to_id."<br>";

			if(is_null($content) || $content == "") {
				echo "<script>alert('输入可能有空值哦!');window.location='../details.php?id=".$sourceId."';</script>";
				exit();
			} else if(is_null($userId)) {
				echo "<script>alert('请您先登陆吧!');window.location='../details.php?id=".$sourceId."';</script>";
			} else if (is_null($commentId) || !is_numeric($commentId) || !is_numeric($userId) || !is_numeric($sourceId) || !is_numeric($type) || !is_numeric($to_id)) {
				echo "<script>alert('操作失误!');window.location='../details.php?id=".$sourceId."';</script>";
			} else if($type != '1' && $type != '2'){
				echo "<script>alert('操作失误!');window.location='../details.php?id=".$sourceId."';</script>";
			} else if($to_id == "" || is_null($to_id)) {
				echo "<script>alert('系统错误! ID:'".$to_id.");window.location='../details.php?id=".$sourceId."';</script>";
			} else {
				$sql = "insert into reply(id,commentId,userId,content,date,to_id,type) values(null,'{$commentId}','{$userId}','{$content}','$date','{$to_id}','{$type}')";
				//echo $sql;
				@mysqli_query("SET NAMES UTF8");
				$res = mysqli_query($link,$sql);

				if(isset($res) && $res != null) {
					echo "<script>alert('回复成功！');window.location='../details.php?id=".$sourceId."';</script>";
					exit();
				} else {
					echo "<script>alert('回复失败！');window.location='../details.php?id=".$sourceId."';</script>";
					exit();
				}
			}
			break;

		case 'editUserName':
			$oldusername =  addslashes(trim($_POST['oldusername']));
			$newusername =  addslashes(trim($_POST['newusername']));
			$psw      =  addslashes(trim($_POST['password']));

			if(empty($oldusername) || empty($newusername) || empty($psw)) {
				echo "<script>alert('输入拥有空值');window.location='../change/changeName.php';</script>";
			 	exit();
			}

			$sql = "select count(*) from admin where name = '{$oldusername}' AND password = '{$psw}'";
			$res = mysqli_query($link,$sql);


			if($res && mysqli_num_rows($res) > 0) {
				$sql1 = "update admin set name = '{$newusername}' where name = '{$oldusername}' AND password = '{$psw}'";
				$res1 = mysqli_query($link,$sql1);
				if($res1) {
					$_SESSION['user'] = $newusername;
					echo "<script>alert('修改成功！');window.location='../index.php';</script>";
				} else {
					echo "<script>alert('修改失败！');window.location='../change/changeName.php';</script>";
				}
				exit();
			} else {
				echo "<script>alert('输入有误，无法更改！');window.location='../change/changeName.php';</script>";
				exit();
			}
			break;

		case 'editPassword':
			$username =  addslashes(trim($_POST['username']));
			$newpsw  =  addslashes(trim($_POST['newpassword']));
			$oldpsw  =  addslashes(trim($_POST['oldpassword']));

			if(empty($username) || empty($newpsw) || empty($oldpsw)) {
				echo "<script>alert('输入拥有空值');window.location='../change/changePwd.php';</script>";
			 	exit();
			}

			$sql = "select count(*) from admin where name = '{$username}' AND password = '{$oldpsw}'";
			$res = mysqli_query($link,$sql);


			if($res && mysqli_num_rows($res) > 0) {
				$sql1 = "update admin set password = '{$newpsw}' where name = '{$username}'";
				$res1 = mysqli_query($link,$sql1);
				if($res1) {
					echo "<script>alert('修改成功！');window.location='../index.php';</script>";
				} else {
					echo "<script>alert('修改失败！');window.location='../change/changePwd.php';</script>";
				}
				exit();
			} else {
				echo "<script>alert('输入有误，无法更改！');window.location='../change/changePwd.php';</script>";
				exit();
			}
			break;

		default:
			
			break;
	}


 ?>