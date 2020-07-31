<?php
session_start();
$db = mysqli_connect("localhost", "USERNAME", "Degomer7418521!", "weleakin_database");
if(!$db) {
	echo 'We are under attack!';
	die();
}
function getIp() {
	if(isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
		return $_SERVER['HTTP_CF_CONNECTING_IP'];
	}elseif(isset($_SERVER['HTTP_X_REAL_IP'])) {
        return $_SERVER['HTTP_X_REAL_IP'];
    }
	return $_SERVER['REMOTE_ADDR'];
}
$lic = false;
$auth = false;
$ip = getIp(); 
if (isset($_SESSION['username'])) {
   $user = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username = '".$_SESSION['username']."'"));
   $vk_auth    = $user['id'];
   $email      = $user['email'];
   $lic        = $user['license'];
   $_SESSION['lic'] = $user['license'];
   if($user['license'] !== "user") {
    if(time() > $user['expire']) {
        mysqli_query($db, "UPDATE users SET license = 'user', expire = 0 WHERE `username` = '".$_SESSION['username']."';");
        $_SESSION['lic'] = "user";
	}
   }
   if ($user['license'] == "user") $lic = false;
}
function number_restyle( $n, $precision = 1 ) {
    if ($n < 900) {
        $n_format = number_format($n, $precision);
        $suffix = '';
    } else if ($n < 900000) {
        $n_format = number_format($n / 1000, $precision);
        $suffix = 'K';
    } else if ($n < 900000000) {
        $n_format = number_format($n / 1000000, $precision);
        $suffix = 'KK';
    } else if ($n < 900000000000) {
        $n_format = number_format($n / 100000000, $precision);
        $suffix = 'KKK';
    } else {
        $n_format = number_format($n / 1000000000000, $precision);
        $suffix = 'T';
    }
    if ( $precision > 0 ) {
        $dotzero = '.' . str_repeat( '0', $precision );
        $n_format = str_replace( $dotzero, '', $n_format );
    }
    return $n_format.$suffix;
}
function getStat($type) {
    global $db;
	switch ($type) {
		case 'db':
			$result = mysqli_query($db, "SELECT * FROM `stat`");
			$res = mysqli_fetch_assoc($result);
			return number_restyle($res['db']);
		break;
	}
}
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
function c_check($mail, $type) {   
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://leakcheck.net/api/?key=KEY&check=".$mail."&type=".$type);
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
function mcc_check($text) {   
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://api.fth.su/api.php?value=".$text."&type=mc_check&key=KEY&type_check=1");
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
?>
