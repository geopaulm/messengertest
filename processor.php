<?php
	/**
	 This file is the entry point for the Facebook messenger bot service. 
	 Route all the calls to different classes as per the pattern.
	**/

	/** Facebook tests whether the webhook is alive by using some get request.
	Providin the appropriate response. */
	if($_GET['hub_challenge']) {
		//This is not the ideal way to do it.
		echo $_GET['hub_challenge'];
		exit(0);
	}
?>