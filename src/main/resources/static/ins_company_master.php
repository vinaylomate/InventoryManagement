<?php
$scode=$_POST['txtcode'];
$company_name=$_POST['txtnm'];
$desc=$_POST['desc'];

	$data = array("companyCode" => $scode, "companyName" => $company_name, "companyDescription" => $desc);
    $data_string = json_encode($data);
    $url = "http://192.168.0.138:8080/manage/add/company";
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/json',
            'content' => $data_string,
        ),
    );
    
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    
    if ($response === FALSE) {
        // Handle error
        echo 0;
    } else {
        // Process the response
        echo 1;
    }
?>