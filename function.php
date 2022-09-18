<?php

//function.php

function base_url()
{
	return 'http://localhost/Library-Management-System/';
}

function is_admin_login()
{
	if(isset($_SESSION['admin_id']))
	{
		return true;
	}
	return false;
}

function is_user_login()
{
	if(isset($_SESSION['user_id']))
	{
		return true;
	}
	return false;
}

function set_timezone($connect)
{
	$query = "
	SELECT library_timezone FROM lms_setting 
	LIMIT 1
	";

	$result = $connect->query($query);

	foreach($result as $row)
	{
		date_default_timezone_set($row["library_timezone"]);
	}
}

function get_date_time($connect)
{
	set_timezone($connect);

	return date("Y-m-d H:i:s",  STRTOTIME(date('h:i:sa')));
}

function get_currency_symbol($connect)
{
	$output = '';
	$query = "
	SELECT library_currency FROM lms_setting 
	LIMIT 1
	";
	$result = $connect->query($query);
	foreach($result as $row)
	{
		$currency_data = currency_array();
		foreach($currency_data as $currency)
		{
			if($currency["code"] == $row['library_currency'])
			{
				$output = '<span style="font-family: DejaVu Sans;">' . $currency["symbol"] . '</span>&nbsp;';
			}
		}		
	}
	return $output;
}

function currency_array()
{
	$currencies = array(
		array('code'=> 'LKR',
			'countryname'=> 'Sri Lanka',
			'name'=> 'Sri Lankan rupee',
			'symbol'=> '&#82;&#115;'),
	);
	return $currencies;
}

function Currency_list()
{
	$html = '<option value="">Select Currency</option>';
	$data = currency_array();
	foreach($data as $row)
	{
		$html .= '<option value="'.$row["code"].'">'.$row["name"].'</option>';
	}
	return $html;
}

function Timezone_list()
{
	$timezones = array(
		'Asia/Colombo' => '(GMT+5:30) Asia/Colombo (India Standard Time)',
	);
	
	$html = '<option value="">Select Timezone</option>';
	foreach($timezones as $keys => $values)
	{
		$html .= '<option value="'.$keys.'">'.$values.'</option>';
	}	
	return $html;
}

function convert_data($string, $action = 'encrypt')
{
	$encrypt_method = "AES-256-CBC";
	$secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; // user define private key
	$secret_iv = '5fgf5HJ5g27'; // user define secret key
	$key = hash('sha256', $secret_key);
	$iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
	if ($action == 'encrypt') 
	{
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	    $output = base64_encode($output);
	} 
	else if ($action == 'decrypt') 
	{
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}
	return $output;
}

function get_one_day_fines($connect)
{
	$output = 0;
	$query = "
	SELECT library_one_day_fine FROM lms_setting 
	LIMIT 1
	";
	$result = $connect->query($query);
	foreach($result as $row)
	{
		$output = $row["library_one_day_fine"];
	}
	return $output;
}

function get_book_issue_limit_per_user($connect)
{
	$output = '';
	$query = "
	SELECT library_issue_total_book_per_user FROM lms_setting 
	LIMIT 1
	";
	$result = $connect->query($query);
	foreach($result as $row)
	{
		$output = $row["library_issue_total_book_per_user"];
	}
	return $output;
}

function get_total_book_issue_per_user($connect, $user_unique_id)
{
	$output = 0;

	$query = "
	SELECT COUNT(issue_book_id) AS Total FROM lms_issue_book 
	WHERE user_id = '".$user_unique_id."' 
	AND book_issue_status = 'Issue'
	";

	$result = $connect->query($query);

	foreach($result as $row)
	{
		$output = $row["Total"];
	}
	return $output;
}

function get_total_book_issue_day($connect)
{
	$output = 0;

	$query = "
	SELECT library_total_book_issue_day FROM lms_setting 
	LIMIT 1
	";

	$result = $connect->query($query);

	foreach($result as $row)
	{
		$output = $row["library_total_book_issue_day"];
	}
	return $output;
}

?>