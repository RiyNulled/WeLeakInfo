<?php
function email_check($mail) {   
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://leakcheck.net/api/?key=KEY&check=".$mail."&type=auto");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close ($ch);
    $json = json_decode($server_output, true);
    if($json['success'] === true) {
        return $json;
    } else {
        return false;
    }       
}
function hash_brute($hash) {   
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://api.fth.su/api.php?value=".$hash."&type=decode&key=KEY");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close ($ch);
    $json = json_decode($server_output, true);
    if(!isset($json['error'])) {
        return $json;
    } else {
        return false;
    }       
}
$db = mysqli_connect("localhost", "USERNAME", "PASSWORD", "DB");
if(!$db) {
	die(json_encode(array("success" => false, "error" => "Can't connect to DB. Contact support")));
}
if(!isset($_REQUEST['value']) OR !isset($_REQUEST['type']) OR !isset($_REQUEST['key'])) {
		die(json_encode(array("success" => false, "error" => "Please fill all input data")));
}
$value = mysqli_real_escape_string($db, $_REQUEST['value']);
$type = mysqli_real_escape_string($db, $_REQUEST['type']);
$key = mysqli_real_escape_string($db, $_REQUEST['key']);
$check = mysqli_query($db, "SELECT * FROM `users` WHERE `api_key` = '".$key."'");
if(mysqli_num_rows($check) < 1) {
	die(json_encode(array("success" => false, "error" => "Invalid key")));
} 
$fetch_user = mysqli_fetch_assoc($check);
if($fetch_user['license'] !== 'Pro' && $fetch_user['license'] !== 'Elite') {
	die(json_encode(array("success" => false, "error" => "Access to API from Pro.")));
}
if(time() > $fetch_user['expire']) {
	die(json_encode(array("success" => false, "error" => "Plan expired.")));
}
switch($type) {
	case 'email':
	$request = email_check($value);
	if($request == false) {
		die(json_encode(array("success" => false, "error" => "Result not found.")));	
	}
	$result_return = array();
	foreach($request['result'] as $userka) {
		$result_return[] = array( 
		'line' => $userka['line']
	); 
	}
	$g = array('success' => true, 'found' => $request['found'], 'result' => $result_return);
	echo json_encode($g);
	break;
	case 'decode':
	if($fetch_user['license'] !== 'Elite') {
		die(json_encode(array("success" => false, "error" => "Access to Decoder API from Elite.")));
	}
	$request = hash_brute($value);
	if($request == false) {
		die(json_encode(array("success" => false, "error" => "Result not found.")));	
	}
	echo json_encode(array("success" => true, "result" => $request['password']));
	break;
	default:
			$json = json_encode(array('success' => false, "error" => "Invalid type"));
			die($json);
}
?>