<?php

session_start();

require_once("includes/db.php");

// require_once("functions/functions.php");
// if(!isset($_SESSION['seller_user_name'])){
// 	echo "<script>window.open('../login','_self')</script>";
// }
$seller_user_name = $_SESSION['seller_user_name'];
	
	$toCurrency = $input->post('toCurrency');

  function currencyConverter($toCurrency,$amount_total) {

      $from_currency = 'EGP'; 
      // $toCurrency = $toCurrency;
      $amount_total = 10;
     $url = "https://api.currconv.com/api/v7/convert?q=".$from_currency."_".$toCurrency."&compact=y&apiKey=43ff88807fc747d49fd2e3c2d76be71e";
	  
    
      $ch = curl_init();
      $timeout = 30;
      curl_setopt($ch,CURLOPT_URL,$url);
      curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
      $data = curl_exec($ch);

      if(!curl_errno($ch)){ 
         $amount = json_decode($data, true);

          return $amount[$from_currency.'_'.$toCurrency]['val'];

      }else{
        echo 'Curl error: ' . curl_error($ch); 
      }
      curl_close($ch);

  }
  // $_SESSION['currency'] = $toCurrency;
  // echo currencyConverter($toCurrency,$amount_total);
 
