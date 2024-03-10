<?php
function SendSMS($phoneNoRecip, $msgText) 
{
  $mob='/^\+?([0-9]{1,4})\)?[-. ]?([0-9]{9})$/';
  $msg=urlencode($msgText);
  //echo $usermob." - ".$msg."<br>";
  if(preg_match($mob, $phoneNoRecip))
  { 
  /*$lines = file_get_contents("http://bulksmspune.mobi/sendurlcomma.aspx?user=20090290&pwd=Sagar@123&senderid=SMSALT&mobileno=$phoneNoRecip&msgtext=$msg");*/
    $lines = file_get_contents("http://dndsms.solapurmall.com/sms-panel/api/http/index.php?username=vidyut&apikey=10C8F-B78B5&apirequest=Unicode&sender=VKWTST&mobile=$phoneNoRecip&message=$msg&route=TRANS&TemplateID=1207167413694786898");  

   /* http://bulksmspune.mobi/sendurlcomma.aspx?user=20090290&pwd=Sagar@123&senderid=MVKKSG&CountryCode=91&mobileno=9890169667&msgtext=महाराष्ट्र वीज कंत्राटी कामगार संघांमध्ये आपले स्वागत आहे. आपला OTP नंबर आहे%%&smstype=9&pe_id=1701159188202979163&template_id=1707161780841213564  */

  }
  return $lines;
}

function random_strings($length_of_string) 
{ 
	// String of all alphanumeric character 
	//$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
	$str_result = '0123456789'; 
	// Shufle the $str_result and returns substring 
	// of specified length 
	return substr(str_shuffle($str_result),0, $length_of_string); 
} 
$code=random_strings(4);

$phoneNo="7588996480";
$msgText="विदयुत कर्मचारी वेलफेअर ट्रस्टमध्ये आपले स्वागत आहे. आपला OTP नंबर ".$code." आहे. 
FROM - 
विदयुत कर्मचारी वेलफेअर ट्रस्ट.";
$x = SendSMS($phoneNo, $msgText);
//$x=1;
if($x)
{
    echo '<script>alert("OTP Send Successfully......")</script>';    
}
?>