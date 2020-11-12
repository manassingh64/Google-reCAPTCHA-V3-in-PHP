<?php

if(isset($_POST['name']) && $_POST['name']!="" && isset($_POST['email']) && $_POST['email']!="")
{

   // This is Google API url where we pass the API secret key to validate the user request.
   $google_recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
   $recaptcha_secret_key = '<YOUR_SECRET_KEY>'; // Add your generated Secret key
  $set_recaptcha_response = $_POST['recaptcha_response'];

   // Make the request and capture the response by making below request. 
   $get_recaptcha_response = file_get_contents($google_recaptcha_url . '?secret=' . $recaptcha_secret_key . '&response=' . $set_recaptcha_response);
   
   $get_recaptcha_response = json_decode($get_recaptcha_response);
   $success_msg="";
   $err_msg="";
   // Set the Google recaptcha spam score here and based the score, take your action
   if ($get_recaptcha_response->success == true && $get_recaptcha_response->score >= 0.5 && $get_recaptcha_response->action == 'submit') {
       $success_msg = "Your message has been sent successfully.";
   } else {
       $err_msg = "Something went wrong. Please try again after sometime.";
   }
} else {
   $err_msg = "Please enter the required fields in this form";

}
// Get the response and pass it into your ajax as a response.
$return_msg = array(
   'error'     =>  $err_msg,
   'success'   =>  $success_msg
);
echo json_encode($return_msg);

?>