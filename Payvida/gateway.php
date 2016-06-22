<?php
/**
  @package    PayVida::PHP::SDK
  @author     Chad Reitsma
  @copyright  Copyright 2016 PayVida Solutions Inc.
  @version    v1.0
*/

namespace Payvida;	
use Exception;



class Gateway {
	
	
	/**
	 * Constructor
	 * Set basic config vars + endpoint
	 * 
	 * @param string $merchantId Merchant ID
	 * @param string $apiKey API Access Passcode
	 * @param string $endpoint API Url (Gateway Url)
	 */
	 
	public function __construct($merchantId, $apiKey, $endpoint) {
		
		# Make sure cURL is installed
		if ( !extension_loaded('curl'))  throw new Exception('The cURL extension is required (http://php.net/manual/en/book.curl.php)');
		
		# Check required vars
		if (!$merchantId)	throw new Exception('merchantId is missing');
		if (!$apiKey)	throw new Exception('apiKey is missing');
		
		$this->merchantId = $merchantId;
		$this->apiKey = $apiKey;
		$this->endpoint = $endpoint;
		
	}
	
	
	
	
		
	#	
	#	TRANSACTIONS
	#	
	
	public function ccGetToken($data)  {
		$data['action'] = "ccgettoken";
		return $this->request($data);
	}
	
	public function ccUpdateToken($data)  {
		$data['action'] = "ccupdatetoken";
		return $this->request($data);
	}
	
	
	
	public function ccSale($data, $amount='')  {
		
		
		if (!$amount) throw new Exception('Amount cannot be empty when attempting to process a transaction!');
		$data['amount'] = $amount;
		
		
		//If using a token, unset any cc vars they may have sent by mistake
		if (!empty($data['token'])) {
			unset($data['card_number']);
			unset($data['card_name']);
			unset($data['card_expiry_date']);
			unset($data['card_cvv']);
		}
		
		$data['action'] = "ccsale";	
		return $this->request($data);
	}
	
	
	
	public function ccAuthOnly($data, $amount='')  {
		
		
		if (!$amount) throw new Exception('Amount cannot be empty when performing a pre-authorization!');
		$data['amount'] = $amount;
		
		
		//If using a token, unset any cc vars they may have sent by mistake
		if (!empty($data['token'])) {
			unset($data['card_number']);
			unset($data['card_name']);
			unset($data['card_expiry_date']);
			unset($data['card_cvv']);
		}
		
		$data['action'] = "ccauthonly";	
		return $this->request($data);
	}
		
	
	
	public function ccComplete($txn_id)  {
		
		$data['txn_id'] = $txn_id;
		$data['action'] = "cccomplete";	
		
		return $this->request($data);
	}
	
	public function ccReturn($txn_id)  {
		
		$data['txn_id'] = $txn_id;
		$data['action'] = "ccreturn";	
		
		return $this->request($data);
	}
	
	public function ccVoid($txn_id)  {
		
		$data['txn_id'] = $txn_id;
		$data['action'] = "ccvoid";	
		
		return $this->request($data);
	}
	
	
	
		
	#	
	#	CUSTOMERS
	#	
	public function addCustomer($data)  {
		
		$data['action'] = "addCustomer";
		return $this->request($data);
		
	}
	
	public function updateCustomer($data) {
		$data['action'] = "updateCustomer";
		return $this->request($data);
	}
	
	public function addCard($data) {
		$data['action'] = "addCard";
		return $this->request($data);
	}
	
	public function updateCard($data) {
		$data['action'] = "updateCard";
		return $this->request($data);
	}
	
	
	
	#	
	#	SUBSCRIPTIONS
	#	
		
	public function createSubscription($data) {
		$data['action'] = "createSubscription";
		return $this->request($data);
	}
	
	public function subscribeCustomer($data) {
		$data['action'] = "subscribeCustomer";
		return $this->request($data);
	}
	
	
	
	
	/**
	 * Sends request payload to API via CURL
	 * 
	 * @param array $data (transaction data + action added in function request)
	 */
	private function request($data) {
		
		
		$data['merchantid'] = $this->merchantId;
		$data['apikey'] = $this->apiKey;
		

		$ch = curl_init();    								
		curl_setopt($ch, CURLOPT_URL, $this->endpoint); 	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 		
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); 				
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 		
		
		$result = curl_exec($ch); 							
		
		if (curl_errno($ch)) {
		   throw new Exception('Communication error, endpoint: ' . $this->endpoint . " is unavailable at this time.");
		} else {
		   curl_close($ch);
		}
		
		return $result;
		
	}
	
	

}



?>