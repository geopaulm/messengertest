<?php 

/** Manages page subscription events like messaging and stuff */

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
		$text = $message->message->text;
		error_log("Received $text from $senderId at $timestamp");
	}
}
?>