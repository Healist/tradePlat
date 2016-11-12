<?php 

	if (!isset($_SESSION['user'])) {
        include '404.html';
        exit();
    }

	function uploadFile($filename,$path,$typelist=null) {
		$upfile = @$_FILES[$filename];
		$fileType = "";  
		if(empty($typelist)) {
			// $typelist = array("image/bmp","image/cis-cod","image/gif","image/jpeg","image/jpeg","application/vnd.ms-excel","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/vnd.openxmlformats-officedocument.presentationml.presentation","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application/x-rar");
			$typelist = array("jpg","jpeg","png","gif","bmp");
		}
		//$path = "./uploads/"; 
		$res = array("error"=>false); //存放返回结果

		if($upfile['error']>0) {
		switch ($upfile['error']) {
			case '1':
				$info = "上传文件超过了php.ini中upload_max_filesize限制的值";
				break;
			
			case '2':
				$info = "上传文件超过了html表单中_max_file_size限制的值";
				break;

			case '3':
				$info = "部分文件上传";
				break;

			case '4':
				$info = "没有文件上传";
				break;

			case '6':
				$info = "找不到文件";
				break;

			case '7':
				$info = "文件写入失败";
				break;
			}
			die("上传文件错误 原因:".$info);
		}

		//上传文件大小控制
		if($upfile['size']>10000000) {
			$res["info"] = "上传文件过大!";
			return $res;
		}

		//获取文件后缀
		$fileType = substr($upfile['name'], strrpos($upfile['name'], '.')+1);

	    //  类型过滤
		if(!in_array($fileType, $typelist)) {
			$res['info'] = "上传类型不符!".$upfile['type'];
			$res['type'] = $upfile['type'];
			return $res;
		}

	    //上传后的文件名的定义（随机获取一个文件名，保持后缀名不变,不会因为名字相同而覆盖原文件）
		// $fileinfo = pathinfo($upfile['name']); //解析上传文件名字
		// do{
		// 	$newfile = date("YmdHis").rand(1000,9999).".".@$fileinfo['extension'];	
		// } while(file_exists($path.$newfile));

		//文件名不做改变
		$newfile = $upfile['name'];
		$newfile=iconv("UTF-8","gbk", $newfile);
	    //执行文件上传 ， 判断是否是一个上传文件
	    if(is_uploaded_file($upfile['tmp_name'])) {
	    	if(move_uploaded_file($upfile['tmp_name'],$path.$newfile)) {
	    		$newfile=iconv("gbk","UTF-8", $newfile);
	    		$res["info"] = $newfile;
	    		$res["error"] = true;
	    		$res["path"] = "./upload/".$newfile;
	    		echo $path.$newfile;
	    		return $res;
	    	} else {
	    		$res["info"] = "上传文件失败";
	    	}
	    } else {
	    	$res["info"] = "不是一个上传文件！";
	    }
	    return $res;
	}

	function get_extension($file)
	{
		return substr($file, strrpos($file, '.')+1);
	}

 ?>