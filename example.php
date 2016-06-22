<?php

/**
  @package    PayVida::PHP::SDK
  @author     Chad Reitsma
  @copyright  Copyright 2016 PayVida Solutions Inc.
  @version    v1.0
  
  
  This file contains examples of all API functions
  Uncomment the //$result line to see the results of that particular action
  
*/


# Fill in your Dev or Live Credentials
$gatewayUrl = 'https://dev.gopayvida.com/api/';  
$merchantId = '007975';
$apiKey = 'keJadTO4f7bttC8pjKsWEMdscXEL61Jq';



require_once('Payvida/gateway.php');


# Initiatialize PayVida Object
$payvida = new \Payvida\Gateway($merchantId, $apiKey, $gatewayUrl);




# Get Card Token 
$get_token_data =  array(
						'card_name' => 'Test masterCard',
						'card_number' => '4111111111111111',
						'card_expiry_date' => '1117',
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
$result = $payvida->ccgettoken($get_token_data);   




# Update Card Token
$token_update_data = array(
						'card_token' => '6011000990139424',  
						'card_expiry_date' => '1221',
						'card_cvv' => '123'
					  );
//$result = $payvida->ccupdatetoken($token_update_data);   




# Credit-Card Sale with Data
$payment_data = array(
					
					'amount' => '25.00',
					
					'card_name' => 'Test Card',
					'card_number' => '342400001000180',
					'card_expiry_date' => '0620',
					'card_cvv' => '1234',
					
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
//$result = $payvida->ccsale($payment_data); 





# Credit-Card sale with Token
 $payment_token_data = array(
				'amount' => '25.00',
				'card_token' => '9036502847831117'
  );
//$result = $payvida->ccsale($payment_token_data);



# Pre-Auth a Credit-Card for $25.00
//$result = $payvida->ccauthonly($payment_data);   


# Make Payment with a Token for $99.00
//$result = $payvida->ccsale($payment_token_data);   


# Make Pre-Auth with a Token for $99.00
//$result = $payvida->ccauthonly($payment_token_data);   



# Complete a Pre-auth  (Use the transaction ID you got from the Make pre-auth function above)
$txn_id = '150316A15-18EA7730-C671-40E0-BB96-958DEEC5A3D0';
//$result = $payvida->cccomplete($txn_id);


# Return a Transaction

$txn_id = '150316A15-18EA7730-C671-40E0-BB96-958DEEC5A3D0';
//$amount = "25.00";    //Optional amount for partial refund
//$result = $payvida->ccreturn($txn_id, $amount);


# Void a Transaction 
$txn_id = '150316A15-18EA7730-C671-40E0-BB96-958DEEC5A3D0';
//$result = $payvida->ccvoid($txn_id);



# Add a Customer
$add_customer =  array(
					'billing_name' => 'Test Testerson',
					'billing_email' => 'totally@validemail.com',
					'card_name' => 'Name on Card',
					'card_number' => '4111111111111111',
					'card_expiry_date' => '0419',
					'card_cvv' => '123'
					);

//$result = $payvida->addCustomer($add_customer);   



# Update a Customer Record
$update_customer =  array(
					'customer_id' => '63',
					'billing_name' => 'New Name',
					'billing_email' => 'new@validemail.com',
					);

//$result = $payvida->updateCustomer($update_customer);  


# Add Card to a Customer Record
# IF the card_number and token already exist they will be updated not duplicated.
$add_card =  array(
					'customer_id' => '63',
					'card_name' => 'New Card',
					'card_number' => '5100000010001004',
					'card_expiry_date' => '0419',
					'card_cvv' => '123'
					);

//$result = $payvida->addCard($add_card);  


# Update Card Details (same as ccupdateToken)
$update_card =  array(
					'card_token' => '8091069978011004',
					'card_expiry_date' => '0419',
					);

//$result = $payvida->updateCard($update_card);  



# Create a Subscription
$new_subscription = array(
					  'title' => 'Monthly Membership Fee',
					  'amount' => '79.99',
					  'interval' => '1',
					  'frequency' => 'month',
					  'webhook' => 'https://www.mywebsite.com/subscription_listener.php'
					);


//$result = $payvida->createSubscription($new_subscription);



# Subscribe a customer
$subscription_data = array(
						   'subscription_id' => '38',
						   'customer_id' => '63',
						   'card_token' => '8091069978011004',
						   'start' => '06/22/2016',
						   'end' => '04/01/2017'  //leave empty to re-bill forever optional
						   );

//$result = $payvida->subscribeCustomer($subscription_data);











/* PARSE RESULTS */
// Show pretty array
$response = json_decode($result, true);  # Convert JSON response into array for ease of use
if ($response['result'] == "1") { 
	
	# Success!
	# Print the array (response) so you can see the key value pairs that are returned
	print_r($response);
	
	
}
else {
	
	# Declined/Error
	echo "There was an error: " . $response['message'];
	exit();

}


?>