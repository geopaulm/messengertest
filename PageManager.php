<?php 

/** Manages page subscription events like messaging and stuff */
require_once('SendMessageManager.php');
class PageManager {
	/** Process all the enties */
	function processEntries($entries) {
		foreach ($entries as $value) {
			$this->processEntry($value);
		}
	}

	/** Process a single entry */
	function processEntry($data) {
		$messages = $data->messaging;
		foreach ($messages as $message) {
			$this->processMessage($message);
		}
	}

	/** Process a single messange */
	function processMessage($message) {
		$senderId = $message->sender->id;
		$timestamp = $message->timestamp;
		if (isset($message->message)) {
			//Process incoming message
			$text = $message->message->text;
			error_log("Received $text from $senderId at $timestamp");
		
			//Sending the text back
			$result = SendMessageManager::sendTextMessage($senderId,$text);
		} else if (isset($message->read)) {
			//process delivery report
		} else {
			error_log("Unknown incoming message type : ".json_encode($message));
		}
	}
}
?>