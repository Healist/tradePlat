<?php 
	session_start();


	function doMySQL() {
		require './config_db.php';
		$dsn = "mysql:host=$dbhost;dbname=$dbname";
		$db = new PDO($dsn,$dbuser,$dbpass); 
		$db -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$db -> query("SET NAMES UTF8");
		return $db;
	}

	function error($errMsg)
	{
		$err = array("status"=>"error","errmsg"=>$errMsg);
		return output($err);
	}

	function output($arr) {
		return json_encode($arr);
	}


	function test($key,$form) {
		$sql = "SELECT count(*)  as num FROM $form WHERE `id` = {$key}";
		$tt = $db->query($sql)->fetch(PDO::FETCH_OBJ);
		if ($tt->num == 0) {
			return true;
		}else {
			return false;
		}
	}



	/*         the  functions  of  getting  source         */

	function getResource($request,$response,$args) {
		$page = trim($args['page']);
		$limit = trim($args['limit']);
		if (!is_numeric($page) || $limit == 0) {
			return error("invalid request");
		}
		$sql = "SELECT count(*) AS num FROM `paper` ";
		$db = doMySQL();
		$guide = $db->query($sql);
		$guide = $guide->fetch(PDO::FETCH_OBJ);
		$pageNum = ceil($guide->num / $limit);//总页数
		if (!is_numeric($page) || ($page > $pageNum) || ($page < 1)) {
			$page = 1;
		}

		$from = ($page-1) * $limit;
		$sql = "SELECT `id`,`title`,`content`,`subject`,`city`,`date`,`author` FROM `paper` ORDER BY `date` DESC LIMIT {$from},{$limit}";
		$get = $db->query($sql);
		$res = $get->fetchAll(PDO::FETCH_OBJ);
			if ($res) {
			for ($i=0; $i < count($res); $i++) { 
				$sql = "SELECT `name` FROM `subject` WHERE `id` = ".$res[$i]->subject;
				$cate = $db->query($sql)->fetch(PDO::FETCH_OBJ);
				$res[$i]->subject = $cate->name;

				$sql2 = "SELECT `name` FROM `city` WHERE `id` = ".$res[$i]->city;
				$cate2 = $db->query($sql2)->fetch(PDO::FETCH_OBJ);
				$res[$i]->city = $cate2->name;
			}
			return output(array("total" => $pageNum,"current" => $page,"source" => $res));
		}else{
			return error("none");
		}
	}

	function getSourceByCityType($request,$response,$args) {

		$page     =    trim($args['page']);
		$limit    =    trim($args['limit']);
		$type     =    trim($args['type']);

		if (!is_numeric($page) || !is_numeric($type) || $limit == 0) {
			return error("invalid request");
		}

		$db = doMySQL();

		$sql = "SELECT count(*) AS num FROM `paper` WHERE `city` = {$type }";
		$guide = $db->query($sql);
		$guide = $guide->fetch(PDO::FETCH_OBJ);

		if ($guide->num == 0) {
			return error("nothing exist of this type!");
		}

		$pageNum = ceil($guide->num / $limit);//总页数
		if (!is_numeric($page) || ($page > $pageNum) || ($page < 1)) {
			$page = 1;
		}
		$from = ($page-1) * $limit;
		$sql = "SELECT `id`,`title`,`content`,`subject`,`city`,`date` FROM `paper` WHERE `city`= {$type} ORDER BY `date` DESC LIMIT {$from},{$limit}";
		$get = $db->query($sql);
		$res = $get->fetchAll(PDO::FETCH_OBJ);
		if ($res) {
			for ($i=0; $i < count($res); $i++) { 
				$sql = "SELECT `name` FROM `subject` WHERE `id` = ".$res[$i]->subject;
				$cate = $db->query($sql)->fetch(PDO::FETCH_OBJ);
				$res[$i]->subject = $cate->name;

				$sql2 = "SELECT `name` FROM `city` WHERE `id` = ".$res[$i]->city;
				$cate2 = $db->query($sql2)->fetch(PDO::FETCH_OBJ);
				$res[$i]->city = $cate2->name;
			}
			return output(array("total" => $pageNum,"current" => $page,"source" => $res));
		}else{
			return error("none");
		}
	}

	function getSourceBySubType($request,$response,$args) {

		$page     =    trim($args['page']);
		$limit    =    trim($args['limit']);
		$type     =    trim($args['type']);

		if (!is_numeric($page) || !is_numeric($type) || $limit == 0) {
			return error("invalid request");
		}

		$db = doMySQL();

		$sql = "SELECT count(*) AS num FROM `paper` WHERE `subject` = {$type }";
		$guide = $db->query($sql);
		$guide = $guide->fetch(PDO::FETCH_OBJ);

		if ($guide->num == 0) {
			return error("nothing exist of this type!");
		}

		$pageNum = ceil($guide->num / $limit);//总页数
		if (!is_numeric($page) || ($page > $pageNum) || ($page < 1)) {
			$page = 1;
		}
		$from = ($page-1) * $limit;
		$sql = "SELECT `id`,`title`,`content`,`subject`,`city`,`date` FROM `paper` WHERE `subject`= {$type} ORDER BY `date` DESC LIMIT {$from},{$limit}";
		$get = $db->query($sql);
		$res = $get->fetchAll(PDO::FETCH_OBJ);
		if ($res) {
			for ($i=0; $i < count($res); $i++) { 
				$sql = "SELECT `name` FROM `subject` WHERE `id` = ".$res[$i]->subject;
				$cate = $db->query($sql)->fetch(PDO::FETCH_OBJ);
				$res[$i]->subject = $cate->name;

				$sql2 = "SELECT `name` FROM `city` WHERE `id` = ".$res[$i]->city;
				$cate2 = $db->query($sql2)->fetch(PDO::FETCH_OBJ);
				$res[$i]->city = $cate2->name;
			}
			return output(array("total" => $pageNum,"current" => $page,"source" => $res));
		}else{
			return error("none");
		}
	}


	function getCityList($request,$response,$args) {

		$sql = "SELECT count(*) AS num FROM `city` ";
		$db = doMySQL();
		$guide = $db->query($sql);
		$guide = $guide->fetch(PDO::FETCH_OBJ);
		if($guide->num == 0){
			return error("none");
		}

		$sql = "SELECT name FROM city";
		$get = $db->query($sql);
		$res = $get->fetchAll(PDO::FETCH_OBJ);
			if ($res) {
			return output(array("cityList" => $res));
		}else{
			return error("none");
		}
	}

	function getSubjectList($request,$response,$args) {

		$sql = "SELECT count(*) AS num FROM `subject` ";
		$db = doMySQL();
		$guide = $db->query($sql);
		$guide = $guide->fetch(PDO::FETCH_OBJ);
		if($guide->num == 0){
			return error("none");
		}

		$sql = "SELECT name FROM subject";
		$get = $db->query($sql);
		$res = $get->fetchAll(PDO::FETCH_OBJ);
			if ($res) {
			return output(array("subList" => $res));
		}else{
			return error("none");
		}
	}

	function testLogin($request,$response,$args) {
		$account = trim($args['account']);
		$password = trim($args['password']);

		$sql = "SELECT `email`, `subjectFocus`, `cityFocus`, count(*) AS num FROM `admin` WHERE `admin` = '{$account}' AND `password` = '{$password}'";
		$db = doMySQL();
		$guide = $db->query($sql);
		$res = $guide->fetch(PDO::FETCH_OBJ);
		if($res->num > 0){
			$sql2 = "SELECT `email`, `subjectFocus`, `cityFocus` FROM `admin` WHERE `admin` = '{$account}' AND `password` = '{$password}'";
			$get = $db->query($sql2);
			$res = $get->fetch(PDO::FETCH_OBJ);
			// $subList  =  explode("|", $res->subjectFocus);
			// $cityList =  explode("|", $res->cityFocus);

			// for ($i=0; $i < count($subList); $i++) { 
			// 	$sql = "SELECT `name` FROM `subject` WHERE `id` = ".$subList[$i];
			// 	$cate = $db->query($sql)->fetch(PDO::FETCH_OBJ);
			// 	$subList[$i] = $cate->name;
			// }

			// for ($i=0; $i < count($cityList); $i++) { 
			// 	$sql = "SELECT `name` FROM `city` WHERE `id` = ".$cityList[$i];
			// 	$cate = $db->query($sql)->fetch(PDO::FETCH_OBJ);
			// 	$cityList[$i] = $cate->name;
			// }
			// $subList = join("|", $subList);
			// $cityList = join("|", $cityList);

			// $res->subjectFocus = $subList;
			// $res->cityFocus = $cityList;

			return output(array("isOk" => "ok", "info" => $res));
		} else {
			return output(array("isOk" => "false"));
		}
	}


	function getCityFocusContent($request,$response,$args) {
		$focus = trim($args['cityfocus']);
		$cate = new stdClass();
		$res = new stdClass();

		$db = doMySQL();
		$focusList = explode("|", $focus);

		for ($i=0; $i < count($focusList); $i++) { 
			$sql = "SELECT `title`,`content`,`date`,`subject`,`city`,`author` FROM `paper` WHERE `city` = ".$focusList[$i];
			$tmp = $db->query($sql)->fetchAll(PDO::FETCH_OBJ);
			for ($j=0; $j < count($tmp); $j++) { 
				$sql = "SELECT `name` FROM `subject` WHERE `id` = ".$tmp[$j]->subject;
				$res2 = $db->query($sql)->fetch(PDO::FETCH_OBJ);
				$tmp[$j]->subject = $res2->name;
				$sql2 = "SELECT `name` FROM `city` WHERE `id` = ".$tmp[$j]->city;
				$res3 = $db->query($sql2)->fetch(PDO::FETCH_OBJ);
				$tmp[$j]->city = $res3->name;
			}
			$cate->$i = $tmp;
		}

		for ($i=0; $i < count($focusList); $i++) { 
			$sql = "SELECT `name` FROM `city` WHERE `id` = ".$focusList[$i];
			$res->$i = $db->query($sql)->fetch(PDO::FETCH_OBJ);
		}
		if($cate) {
			return output(array("cityFocus"=>$cate,"list"=>$res,"status"=>"success"));
		} else {
			return error("none");
		}
		
	}

	function getSubjectFocusContent($request,$response,$args) {
		$focus = trim($args['subjectFocus']);
		$cate = new stdClass();
		$res = new stdClass();

		$db = doMySQL();
		$focusList = explode("|", $focus);

		for ($i=0; $i < count($focusList); $i++) { 
			$sql = "SELECT `title`,`content`,`date`,`subject`,`city`,`author` FROM `paper` WHERE `subject` = ".$focusList[$i];
			$tmp = $db->query($sql)->fetchAll(PDO::FETCH_OBJ);
			for ($j=0; $j < count($tmp); $j++) { 
				$sql = "SELECT `name` FROM `subject` WHERE `id` = ".$tmp[$j]->subject;
				$res2 = $db->query($sql)->fetch(PDO::FETCH_OBJ);
				$tmp[$j]->subject = $res2->name;
				$sql2 = "SELECT `name` FROM `city` WHERE `id` = ".$tmp[$j]->city;
				$res3 = $db->query($sql2)->fetch(PDO::FETCH_OBJ);
				$tmp[$j]->city = $res3->name;
			}
			$cate->$i = $tmp;
		}

		for ($i=0; $i < count($focusList); $i++) { 
			$sql = "SELECT `name` FROM `subject` WHERE `id` = ".$focusList[$i];
			$res->$i = $db->query($sql)->fetch(PDO::FETCH_OBJ);
		}
		if($cate){
			return output(array("subjectFocus"=>$cate,"list"=>$res,"status"=>"success"));
		} else {
			return error("none");
		}
		
	}


	function updateCityFocusContent($request,$response,$args) {
		$focus = trim($args['cityFocus']);
		$account = trim($args['account']);

		$db = doMySQL();

		$sql = "UPDATE admin SET cityFocus='{$focus}' WHERE admin = '{$account}'";
		$get = $db->query($sql);
		if ($get) {
			return output(array("isOk"=>"ok"));
		}else{
			return output(array("isOk"=>"false"));
		}
	}

	function updateSubjectFocusContent($request,$response,$args) {
		$focus = trim($args['subjectFocus']);
		$account = trim($args['account']);

		$db = doMySQL();

		$sql = "UPDATE admin SET subjectFocus='{$focus}' WHERE admin = '{$account}'";
		$get = $db->query($sql);
		if ($get) {
			return output(array("isOk"=>"ok"));
		}else{
			return output(array("isOk"=>"false"));
		}
	}


	function getReportsByKey($request,$response,$args) {

		$keyword     =    trim($args['keyword']);

		$db = doMySQL();

		$sql = "SELECT `id`,`title`,`content`,`subject`,`city`,`date`,`author` FROM `paper` WHERE `title` LIKE '%{$keyword}%' ORDER BY `date` DESC";
		$get = $db->query($sql);
		$res = $get->fetchAll(PDO::FETCH_OBJ);
		if ($res) {
			for ($i=0; $i < count($res); $i++) { 
				$sql = "SELECT `name` FROM `subject` WHERE `id` = ".$res[$i]->subject;
				$cate = $db->query($sql)->fetch(PDO::FETCH_OBJ);
				$res[$i]->subject = $cate->name;

				$sql2 = "SELECT `name` FROM `city` WHERE `id` = ".$res[$i]->city;
				$cate2 = $db->query($sql2)->fetch(PDO::FETCH_OBJ);
				$res[$i]->city = $cate2->name;
			}
			return output(array("source" => $res,"status" => "success"));
		}else{
			return error("none");
		}
	}

 ?>
