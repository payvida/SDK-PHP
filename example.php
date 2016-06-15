<?php

/**
  @package    PayVida::PHP::SDK
  @author     Chad Reitsma
  @copyright  Copyright 2016 PayVida Solutions Inc.
  @version    v1.0
  
  
  This file contains examples of all API functions
  
*/


# Fill in your Dev or Live Credentials
$merchantId = '';
$apiKey = '';
$gatewayUrl = '';  






require_once('Payvida/gateway.php');


# Initiatialize PayVida Object
$payvida = new \Payvida\Gateway($merchantId, $apiKey, $gatewayUrl);



# Data for Credit-card payment
$payment_card_data = array(
					  
			'card_name' => 'Test Card',
			'card_number' => '6011500080009080',
			'card_expiry_date' => '0620',
			'card_cvv' => '123',
			
			# I've included billing fields but they are not required
			'billing_name'  => 'Test Testerson',
			'billing_company_name'  => 'PayVida',
			'billing_address1'  => '123 Fake Street',
			'billing_address2' => '',
			'billing_postal_zip' => 'T2Y 4M3',
			'billing_city' => 'Kelowna',
			'billing_province_state' => 'BC',
			'billing_country' => 'CAN',
			'billing_phone' => '555-123-4567',
			'billing_email' => 'totallyvalid@emailaddress.com',
			
			# I've included shipping fields but they are not required
			'shipping_name'  => 'Hank Scorpio',
			'shipping_company_name'  => 'Globex Corp.',
			'shipping_address1'  => '1111 Volcano Lair',
			'shipping_address2' => '',
			'shipping_postal_zip' => 'T1X CB4',
			'shipping_city' => 'Cypress Creek',
			'shipping_province_state' => 'BC',
			'shipping_country' => 'CAN',
			'shipping_phone' => '555-123-45678',
			'shipping_email' => 'hank@globexcorp.com'
			
			);



# Data for Tokenization 
$get_token_data =  array(
			'card_name' => 'Test Card',
			'card_number' => '6011500080009080',
			'card_expiry_date' => '0620',
			'card_cvv' => '123',
			
			# I've included billing fields but they are not required
			'billing_name'  => 'Test Testerson',
			'billing_company_name'  => 'PayVida',
			'billing_address1'  => '123 Fake Street',
			'billing_address2' => '',
			'billing_postal_zip' => 'T2Y 4M3',
			'billing_city' => 'Kelowna',
			'billing_province_state' => 'BC',
			'billing_country' => 'CAN',
			'billing_phone' => '555-123-4567',
			'billing_email' => 'totallyvalid@emailaddress.com'
			);


# Data for Update token
$token_update_data = array(	'card_token' => '9318222095339080',  
				'card_expiry_date' => '0320'
			  );

# Data for Token Payment
$payment_token_data = array(
				'card_token' => '9318222095339080'
			   );










/*  EXAMPLE FUNCTIONS */


# Get Token
//$result = $payvida->ccgettoken($get_token_data);   


# Update Token with the new Expiry Date
//$result = $payvida->ccupdatetoken($token_update_data);   



# Make Credit-Card Payment for $25.00
//$amount = "25.00";
//$result = $payvida->ccsale($payment_card_data, $amount);   

# Pre-Auth a Credit-Card for $25.00
//$amount = "25.00";
//$result = $payvida->ccauthonly($payment_card_data, $amount);   



# Make Payment with a Token for $99.00
//$amount = "99.00";
//$result = $payvida->ccsale($payment_token_data, $amount);   

# Make Pre-Auth with a Token for $99.00
//$amount = "99.00";
//$result = $payvida->ccauthonly($payment_token_data, $amount);   



# Complete a Pre-auth  (Use the transaction ID you got from the Make pre-auth function above)
//$txn_id = '150316A15-18EA7730-C671-40E0-BB96-958DEEC5A3D0';
//$result = $payvida->cccomplete($txn_id);



# Return a Transaction
//$txn_id = '150316A15-18EA7730-C671-40E0-BB96-958DEEC5A3D0';
//$result = $payvida->ccreturn($txn_id);


# Void a Transaction 
//$txn_id = '150316A15-18EA7730-C671-40E0-BB96-958DEEC5A3D0';
//$result = $payvida->ccvoid($txn_id);





/* PARSE RESULTS */

$response = json_decode($result, true);  # Convert JSON response into array for ease of use
if ($response['code'] >= 400) { 
	
	# Declined/Error
	echo "There was an error: " . $response['message'];
	exit();
	
}
else {
	
	# Success!
	# Print the array (response) so you can see the key value pairs that are returned
	print_r($response);
	

}


?>
