<?php 
require_once('PageManager.php');
/** Routes the calls to its own sub classes */

class MainRouter {
	function MainRouter($data) {
		if (isset($data->object)) {
			if($data->object == 'page') {
				//Data is of page type. send it to page manager
				$pageManager = new PageManager();
				$pageManager->processEntries($data->entry);
			} else {
				error_log("Request with unknown object type".$data->object);
			}
		} else {
			error_log("Request with missing object type.");
		}
	}
}
?>