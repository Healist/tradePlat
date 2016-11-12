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
		$sql = "SELECT count(*) AS num FROM `resource` ";
		$db = doMySQL();
		$guide = $db->query($sql);
		$guide = $guide->fetch(PDO::FETCH_OBJ);
		$pageNum = ceil($guide->num / $limit);//总页数
		if (!is_numeric($page) || ($page > $pageNum) || ($page < 1)) {
			$page = 1;
		}

		$from = ($page-1) * $limit;
		$sql = "SELECT `id`,`userId`,`name`,`price`,`path`,`description`,`school`,`canCut` ,`type`,`date`,`count` FROM `resource` ORDER BY `date` DESC LIMIT {$from},{$limit}";
		$get = $db->query($sql);
		$res = $get->fetchAll(PDO::FETCH_OBJ);
			if ($res) {
			for ($i=0; $i < count($res); $i++) { 
				$sql = "SELECT `schName` FROM `school` WHERE `id` = ".$res[$i]->school;
				$cate = $db->query($sql)->fetch(PDO::FETCH_OBJ);
				$res[$i]->school = $cate->schName;

				$sql2 = "SELECT `name` FROM `cut` WHERE `id` = ".$res[$i]->canCut;
				$cate2 = $db->query($sql2)->fetch(PDO::FETCH_OBJ);
				$res[$i]->canCut = $cate2->name;

				$sql3 = "SELECT `name` FROM `sourcetype` WHERE `id` = ".$res[$i]->type;
				$cate3 = $db->query($sql3)->fetch(PDO::FETCH_OBJ);
				$res[$i]->type = $cate3->name;
			}
			return output(array("total" => $pageNum,"current" => $page,"source" => $res));
		}else{
			return error("none");
		}
	}

	function getSourceByType($request,$response,$args) {

		$page     =    trim($args['page']);
		$limit    =    trim($args['limit']);
		$type     =    trim($args['type']);

		if (!is_numeric($page) || !is_numeric($type) || $limit == 0) {
			return error("invalid request");
		}

		$db = doMySQL();

		$sql = "SELECT count(*) AS num FROM `resource` WHERE `type` = {$type }";
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
		$sql = "SELECT `id`,`userId`,`name`,`price`,`path`,`description`,`school`,`canCut` ,`type`,`date`,`count` FROM `resource` WHERE `type`= {$type} ORDER BY `date` DESC LIMIT {$from},{$limit}";
		$get = $db->query($sql);
		$res = $get->fetchAll(PDO::FETCH_OBJ);
		if ($res) {
			for ($i=0; $i < count($res); $i++) { 
				$sql = "SELECT `schName` FROM `school` WHERE `id` = ".$res[$i]->school;
				$cate = $db->query($sql)->fetch(PDO::FETCH_OBJ);
				$res[$i]->school = $cate->schName;

				$sql2 = "SELECT `name` FROM `cut` WHERE `id` = ".$res[$i]->canCut;
				$cate2 = $db->query($sql2)->fetch(PDO::FETCH_OBJ);
				$res[$i]->canCut = $cate2->name;

				$sql3 = "SELECT `name` FROM `sourcetype` WHERE `id` = ".$res[$i]->type;
				$cate3 = $db->query($sql3)->fetch(PDO::FETCH_OBJ);
				$res[$i]->type = $cate3->name;
			}
			return output(array("total" => $pageNum,"current" => $page,"source" => $res));
		}else{
			return error("none");
		}
	}

	function getPublicById($request,$response,$args) {
		$page = trim($args['page']);
		$userID = trim($args['userID']);
		$limit    =    trim($args['limit']);
		if (!is_numeric($page) || !is_numeric($userID) || $limit == 0) {
			return error("invalid request");
		}
		$db = doMySQL();

		$sql = "SELECT count(*)  AS  num FROM `resource` WHERE `userId` = {$userID}";

		$guide = $db->query($sql);
		$guide = $guide->fetch(PDO::FETCH_OBJ);
		if ($guide->num == 0) {
			return error("no resource exist of this person!");
		}

		$pageNum = ceil($guide->num / $limit);//总页数
		if (!is_numeric($page) || ($page > $pageNum) || ($page < 1)) {
			$page = 1;
		}

		$from = ($page-1) * $limit;
		$sql = "SELECT `id`,`userId`,`name`,`price`,`path`,`description`,`school`,`canCut` ,`type`,`date`,`count` FROM `resource` WHERE `userId` = {$userID} ORDER BY `date` DESC LIMIT {$from},{$limit}";
		$get = $db->query($sql);
		$res = $get->fetchAll(PDO::FETCH_OBJ);

		if ($res) {
			for ($i=0; $i < count($res); $i++) { 
				$sql = "SELECT `schName` FROM `school` WHERE `id` = ".$res[$i]->school;
				$cate = $db->query($sql)->fetch(PDO::FETCH_OBJ);
				$res[$i]->school = $cate->schName;

				$sql2 = "SELECT `name` FROM `cut` WHERE `id` = ".$res[$i]->canCut;
				$cate2 = $db->query($sql2)->fetch(PDO::FETCH_OBJ);
				$res[$i]->canCut = $cate2->name;

				$sql3 = "SELECT `name` FROM `sourcetype` WHERE `id` = ".$res[$i]->type;
				$cate3 = $db->query($sql3)->fetch(PDO::FETCH_OBJ);
				$res[$i]->type = $cate3->name;
			}
			return output(array("total" => $pageNum,"current" => $page,"source" => $res));
		}else{
			return error("none");
		}
	}

	function getOrderById($request,$response,$args) {
		$page = trim($args['page']);
		$userID = trim($args['userID']);
		$limit    =    trim($args['limit']);
		if (!is_numeric($page) || !is_numeric($userID) || $limit == 0) {
			return error("invalid request");
		}

		$db = doMySQL();

		$sql = "SELECT (*)  AS  num FROM `orders` WHERE `userId` = {$userID}";

		
		$guide = $db->query($sql);
		$guide = $guide->fetch(PDO::FETCH_OBJ);

		if ($guide->num == 0) {
			return error("no userID exist!");
		}

		$pageNum = ceil($guide->num / $limit);//总页数
		if (!is_numeric($page) || ($page > $pageNum) || ($page < 1)) {
			$page = 1;
		}

		$from = ($page-1) * $limit;
		$sql = "SELECT `id`,`userId`,`name`,`price`,`path`,`description`,`school`,`canCut` ,`type`,`date`,`count` FROM `resource` WHERE `id` IN  (SELECT `resourceId` FROM `orders` WHERE `userId`= {$userID}) ORDER BY `date` DESC LIMIT {$from},{$limit}";
		$get = $db->query($sql);
		$res = $get->fetchAll(PDO::FETCH_OBJ);

		if(count($res) == 0) {
			return error("the num of datasets is zero!");
		}

		if ($res) {

			for ($i=0; $i < count($res); $i++) { 
				$sql = "SELECT `schName` FROM `school` WHERE `id` = ".$res[$i]->school;
				$cate = $db->query($sql)->fetch(PDO::FETCH_OBJ);
				$res[$i]->school = $cate->schName;

				$sql2 = "SELECT `name` FROM `cut` WHERE `id` = ".$res[$i]->canCut;
				$cate2 = $db->query($sql2)->fetch(PDO::FETCH_OBJ);
				$res[$i]->canCut = $cate2->name;

				$sql3 = "SELECT `name` FROM `sourcetype` WHERE `id` = ".$res[$i]->type;
				$cate3 = $db->query($sql3)->fetch(PDO::FETCH_OBJ);
				$res[$i]->type = $cate3->name;	
			}
			return output(array("total" => $pageNum,"current" => $page,"source" => $res));
		}else{
			return error("none");
		}
	}

	function getSourceById($request,$response,$args) {

		$sourceID = trim($args['sourceId']);

		$db = doMySQL();

		if (!is_numeric($sourceID)) {
			return error("invalid request");
		}

		// $sql = "SELECT `id`,`userId`,`name`,`price`,`path`,`description`,`school`,`canCut` ,`type`,`date`,`count` FROM `resource` WHERE `id` = {$sourceID}";
		// $sql = "SELECT resource.id, admin.name as adminName, admin.telephone, resource.userId, resource.name as resourceName, resource.price, resource.path, resource.description, resource.school, resource.canCut, resource.type, resource.date, resource.count comment.id as commentId, comment.userId as commentUser, comment.content, comment.dates as commentDate from resource, admin ,comment WHERE resource.id = {$sourceID} AND admin.id = resource.userId AND comment.sourceId = {$sourceID}";
		// $sql = "SELECT resource.id, admin.name as adminName, admin.telephone, resource.userId, resource.name as resourceName, resource.price, resource.path, resource.description, resource.school, resource.canCut, resource.type, resource.date, resource.count comment.id as commentId, from resource, admin WHERE resource.id = {$sourceID} AND admin.id = resource.userId";
		// $sql = "SELECT resource.id,resource.userId,resource.name,resource.price,resource.path,resource.description,resource.school,resource.canCut ,resource.type,resource.date,resource.count, admin.name as adminName, admin.telephone, comment.userId as commentUser, comment.content as commentContent,comment.dates as commentDate FROM resource,admin,comment WHERE resource.id = {$sourceID} AND admin.id = resource.userId AND comment.sourceId = {$sourceID}";
		$sql = "SELECT resource.id,resource.userId,resource.name,resource.price,resource.path,resource.description,resource.school,resource.canCut ,resource.type,resource.date,resource.count, admin.name as adminName, admin.telephone FROM resource,admin WHERE resource.id = {$sourceID} AND admin.id = resource.userId";
		$get = $db->query($sql);
		$res = $get->fetchAll(PDO::FETCH_OBJ);

		if ($res) {

			for ($i=0; $i < count($res); $i++) { 
				$sql = "SELECT `schName` FROM `school` WHERE `id` = ".$res[$i]->school;
				$cate = $db->query($sql)->fetch(PDO::FETCH_OBJ);
				$res[$i]->school = $cate->schName;

				$sql2 = "SELECT `name` FROM `cut` WHERE `id` = ".$res[$i]->canCut;
				$cate2 = $db->query($sql2)->fetch(PDO::FETCH_OBJ);
				$res[$i]->canCut = $cate2->name;

				$sql3 = "SELECT `name` FROM `sourcetype` WHERE `id` = ".$res[$i]->type;
				$cate3 = $db->query($sql3)->fetch(PDO::FETCH_OBJ);
				$res[$i]->type = $cate3->name;	
			}

			$sql2 = "SELECT admin.name as adminName, admin.telephone, comment.id as commentId, comment.userId as commentUser, comment.content as commentContent,comment.dates as commentDate FROM admin,comment WHERE admin.id = comment.userId AND comment.sourceId = {$sourceID}";
			$get2 = $db->query($sql2);
			$res2 = $get2->fetchAll(PDO::FETCH_OBJ);

			if ($res2) {
				for ($i=0; $i < count($res2); $i++) { 
					//添加评论的回复内容获取（reply）
					$sql = "SELECT reply.id as replyId, reply.commentId as replyCommentId, reply.content as replyContent, reply.userId as replyUserId, reply.date as replyDate, reply.type as replyType, reply.to_id, admin.name as replyUser FROM reply,admin WHERE reply.commentId = {$res2[$i]->commentId} AND reply.userId=admin.id";
					$reply = $db->query($sql)->fetchAll(PDO::FETCH_OBJ);
					if($reply) {
						for ($j=0; $j < count($reply); $j++) {
							//评论的回复
							if($reply[$j]->replyType == "1"){
								$sql = "SELECT admin.name as commentUserName FROM admin,reply,comment WHERE admin.id = comment.userId AND {$reply[$j]->replyCommentId} = comment.id";
								$commentUserName = $db->query($sql)->fetch(PDO::FETCH_OBJ);
								$reply[$j]->commentUserName = $commentUserName->commentUserName;
							} else {  //回复的回复
								$sql = "SELECT admin.name as commentUserName FROM admin,reply WHERE reply.id = {$reply[$j]->to_id} AND reply.userId=admin.id";
								$commentUserName = $db->query($sql)->fetch(PDO::FETCH_OBJ);
								$reply[$j]->commentUserName = $commentUserName->commentUserName;
							}
						}
						@$res2[$i]->reply = $reply;
					} else {
						$res2[$i]->reply = "";
					}	
				}
			}
			return output(array("source" => $res,"comment" => $res2));
		}else{
			return error("none");
		}
	}


	function getCommentBySourceId($request,$response,$args){
		$sourceId = trim($args['sourceId']);

		if (!is_numeric($sourceId)) {
			return error("invalid request");
		}

		$db = doMySQL();

		$sql = "SELECT `id`,`userId`,`sourceId`,`content`,`dates` FROM `comment` WHERE `sourceId` = {$sourceId} ORDER BY `dates` DESC";
		// $sql = "SELECT comment.id as commentId, comment.sourceId as commentSourceId, comment.userId as commentUserId, comment.content as commentConetent, comment.dates as commentDates, reply.id as replyId, reply.commentId as replyCommentId, reply.content as replyContent, reply.userId as replyUserId, reply.date as replyDate FROM comment,reply WHERE comment.sourceId = {$sourceId} AND reply.commentId = comment.id  ORDER BY `dates` DESC";
		$get = $db->query($sql);
		$res = $get->fetchAll(PDO::FETCH_OBJ);

		if ($res) {
			for ($i=0; $i < count($res); $i++) { 
				$sql = "SELECT `name` FROM `admin` WHERE `id` = ".$res[$i]->userId;
				$cate = $db->query($sql)->fetch(PDO::FETCH_OBJ);
				$res[$i]->nickName = $cate->name;
				//添加评论的回复内容获取（reply）
				$sql = "SELECT reply.id as replyId, reply.commentId as replyCommentId, reply.content as replyContent, reply.userId as replyUserId, reply.date as replyDate FROM reply,comment WHERE reply.commentId = {$res[$i]->id} ORDER BY reply.date DESC";
				$cate2 = $db->query($sql)->fetch(PDO::FETCH_OBJ);
				if($cate2) {
					$res[$i]->reply = $cate2;
				} else {
					$res[$i]->reply = "";
				}
				
			}
			return output(array("comment" => $res));
		}else{
			return error("none");
		}
	}


 ?>