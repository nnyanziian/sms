<?php

	require 'vendor/autoload.php';
	require 'config.php';
	
	//custom libraries
	require 'lib/main.php';
	require 'lib/users.php';
	require 'lib/admin.php';
	require 'lib/serial.php';

	use \Slim\App;
	$app = new App(["settings" => $config]);
	
		
	//api/users/all 
	$app->get('/users/all', 'getAllUsers');

	//api/user/id 	
	$app->get('/user/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return getUserById($id);
	});
	
		//api/serails/all 
	$app->get('/serials/all', 'getAllSerials');

	//api/serial/id 	
	$app->get('/serial/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return getSerialById($id);
	});
	
			//api/admins/all 
	$app->get('/admins/all', 'getAllAdmins');

	//api/admin/id 	
	$app->get('/admin/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return getAdminById($id);
	});


	//add Admin *
	$app->post('/admin/register', 'registerAdmin');	
	
	//add Serial *
	$app->post('/serial/add', 'addSerial');	
	
	//add Admin *
	$app->post('/user/register', 'registerUser');
	

	//update admin Details *
	$app->post('/admin/update/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return updateAdmin($id);
	});
	
	
		//update serial Details *
	$app->post('/serial/update/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return updateSerial($id);
	});
	
			//update user Details *
	$app->post('/user/update/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return updateUser($id);
	});


		//remove serial	
	$app->get('/serial/delete/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return deleteSerial($id);
	});
	
	//remove user	
	$app->get('/user/delete/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return deleteUser($id);
	});
	
	//Set Admin Photo*

	$app->post('/admin/setphoto/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return setAdminPhoto($id);
	});
	
	//Set Serial Cover*

	$app->post('/serial/setcover/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return setCoverPhoto($id);
	});
	
		//Set User image*

	$app->post('/user/setimage/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return setUserProfile($id);
	});
	
	
		//Set User image*

	$app->post('/serial/setdoc/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return uploadSerialDoc($id);
	});

	//add Admin *
	$app->post('/user/login', 'userLogin');


	$app->run();