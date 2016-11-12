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
	$app->get('/city/{type}/{page}/{limit}', "getSourceByCityType");

	//get source by type
	$app->get('/subject/{type}/{page}/{limit}', "getSourceBySubType");

	//get city list
	$app->get('/city/list', "getCityList");

	//get subject list
	$app->get('/subject/list', "getSubjectList");

	//test login
	$app->get('/user/{account}/{password}', "testLogin");

	//get focus content by user
	$app->get('/user/{cityfocus}', "getCityFocusContent");

	//get focus content by user
	$app->get('/focus/subject/{subjectFocus}', "getSubjectFocusContent");

	//update focus content by user
	$app->get('/cityFocus/{account}/{cityFocus}', "updateCityFocusContent");

	//update focus content by user
	$app->get('/subjectFocus/{account}/{subjectFocus}', "updateSubjectFocusContent");

	//get reports by keyword
	$app->get('/keyword/{keyword}', "getReportsByKey");

	// 运行应用
	$app->run();

 ?>