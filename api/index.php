<?php 
	require 'vendor/autoload.php';
	include 'function.php';

	$configuration = [
	    'settings' => [
	        'displayErrorDetails' => true,
	    ],
	];
	$c = new \Slim\Container($configuration);
	$app = new \Slim\App($c);

	// 添加路由回调
	$app->get('/', function ($request, $response, $args) {
	    return $response->withStatus(200)->write('Welcome!');
	});

	//get some source 
	$app->get('/source/{page}/{limit}', "getResource");

	//get source by type
	$app->get('/type/{type}/{page}/{limit}', "getSourceByType");

	//get source by sourceid
	$app->get('/resource/{sourceId}', "getSourceById");

	//get user's public resource by userid
	$app->get('/source/{page}/{limit}/{userID}', "getPublicById");

	//get user's order by userid
	$app->get('/order/{userID}/{page}/{limit}', "getOrderById");

	//get comment by 商品id
	$app->get('/comment/{sourceId}', "getCommentBySourceId");


	//用户注册
	//$app->post('/signup', "signup");

	// 运行应用
	$app->run();

 ?>