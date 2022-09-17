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

?>
