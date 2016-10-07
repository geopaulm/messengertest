<?php
	require_once('MainRouter.php');
	/**
	 This file is the entry point for the Facebook messenger bot service. 
	 Route all the calls to different classes as per the pattern.
	**/

	/** Facebook tests whether the webhook is alive by using some get request.
	Providin the appropriate response. */
	if(isset($_GET['hub_challenge'])) {
		//This is not the ideal way to do it.
		echo $_GET['hub_challenge'];
		exit(0);
	}


	//All the requests from fb will arive via raw post data. 
	//Retriving it and passing it to router
	$data = file_get_contents("php://input");

	//Don't FORGET to comment below line
	//error_log($data);
	new MainRouter(json_decode($data));

?>