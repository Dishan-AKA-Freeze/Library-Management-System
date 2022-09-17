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

?>