<?php

/** Contains all the logic related to sending a message to different users. */
class SendMessageManager {

	//Url to send requests to 
	const FB_ENDPOINT = "https://graph.facebook.com/v2.6/me/messages";

	//Access Token
	const ACCESS_TOKEN = "EAAJ5TxQhdpgBAHrxlCacSskWL2yzoVZBt4NNffrPZCEBTzH1fpTtZBh0ylJFREznvlwSSZCikBxJRv9LcKQu7T8ZAsPXhiJ5TZBR8LWfOtfsHMquxcCEHr947DCGpgZBSNfZBa6yUfcHJf7QDlX7m5SBvrBwHqi6CiCEKYaFrte0cwZDZD";

	//Section for tracking error logs
	const LOG_SECTION = "SendMessageManager";


	//Sending text message to user 
	public function sendTextMessage($recipientId,$messageText) {
		$params = array();

		//setting up recipient
		$recipient = array('id' => $recipientId);

		//setting up message
		$message = array('text' => $messageText);

		$params['recipient'] = $recipient;
		$params['message'] = $message;

		//executing curl
		self::executeCurl($params);
	}

	//Curl Helper to send messager
	private static function executeCurl($data) {
		//initializing curl.
		$ch = curl_init();

		//setup url and access token
		$url = self::FB_ENDPOINT.'?access_token='.self::ACCESS_TOKEN;
		curl_setopt($ch, CURLOPT_URL, $url);

		//After executing return control to php
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//Setting up curl post parameters
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

		//executing curl
		$result = curl_exec($ch);

		//handling response
		if (curl_errno($ch)) {
			//If there is an error log it
			error_log(self::LOG_SECTION." : ".curl_error($ch));
		}
		curl_close ($ch);

		return $result;
	}
}


?>