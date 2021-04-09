<?php
/**
 * this controller receives the data from the client and send it to the API 'api/api.php'
 * using (cURL) Client URL Request Library then to be sent to the server
 * this controller listenes all the requests from the user then
 * print the responce from the API(the api recives the data from the server using JSON)
 *
 * @author Abrham Kefyalew <abrekefe22@gmail.com>
 * @copyright
 * @license
 */
if(isset($_POST["perpose"]))
{

	// to count users with specific last name
	if($_POST["perpose"] == 'count_specifc_last_name')
	{
		$last_name_to_count = $_POST['enterd_last_name'];
		// the API url will change with the appropriate ip address or domain name when the site is hosted
		$REST_API_interfaceUrl = "http://localhost/RestApi/api/api.php?perpose=last_name_count_specific&l_name=".$last_name_to_count;

		// Initialize the cURL session
		$load_data = curl_init($REST_API_interfaceUrl);
		// Set option for the cURL transfer
		curl_setopt($load_data, CURLOPT_RETURNTRANSFER, true);
		// make the curl opration
		$server_response = curl_exec($load_data);
		$recieved_data = json_decode($server_response);
		$specific_same_last_name_count = 0;
		$last_result_print = "";
		if(!is_null($recieved_data))
		{
			$specific_same_last_name_count = $recieved_data;
			if($specific_same_last_name_count == 1)
			{
				$last_result_print = "There is onely One <b>(1)</b>
				result with Last name called : <b>".$last_name_to_count."</b>";
			}
			else if($specific_same_last_name_count >= 2)
			{
				$last_result_print = "<b>".$specific_same_last_name_count.
				"</b> :	Users Have The Same Last Name called <b>".$last_name_to_count."</b>";
			}
		}
		if($recieved_data == 0)
		{
			$specific_same_last_name_count = 0;
			$last_result_print = "<b>".$specific_same_last_name_count."</b> :
				(There are No Users that have Last Name called <b>"
				.$last_name_to_count."</b>)";
		}

		// print the result
		echo  $last_result_print;
	}

	// to count users created within a given two periods of time
	if($_POST["perpose"] == 'coumt_between_period_of_time')
	{
		// receive form parameters
		$recieved_form_parameters = array(
			'start_time'	=>	$_POST['t_period_start'],
			'end_time'		=>	$_POST['t_period_end']
		);
		// the API url will change with the appropriate ip address or domain name when the site is hosted
		$REST_API_interfaceUrl = "http://localhost/RestApi/api/api.php?perpose=count_bn_time";

		// Initialize the cURL session
		$load_data = curl_init($REST_API_interfaceUrl);
		// Set option for the cURL transfer
		// Set the POST option for the cURL transfer
		curl_setopt($load_data, CURLOPT_POST, true);
		// POST the form paramerer array
		curl_setopt($load_data, CURLOPT_POSTFIELDS, $recieved_form_parameters);
		// return the actual result from the successful operation or false if not seccessfull
		curl_setopt($load_data, CURLOPT_RETURNTRANSFER, true);
		// make the curl opration
		$server_response = curl_exec($load_data);
		// Close a cURL session
		curl_close($load_data);
		$recieved_data = json_decode($server_response, true);
		$bn_time_count = 0;
		$last_result_print = "";
		if(!is_null($recieved_data))
		{
			$bn_time_count = $recieved_data;
			if($bn_time_count == 1)
			{
				$last_result_print = "Only One <b>(1)</b> :
				User is Created Between Time Period <b>("
				.$recieved_form_parameters['start_time'].")</b> - And -<b>("
				.$recieved_form_parameters['end_time'].")</b>";
			}
			else if($bn_time_count >= 2)
			{
				$last_result_print = "<b>".$bn_time_count.
				"</b> : Users are Created Between the Time Period <b>("
				.$recieved_form_parameters['start_time'].")</b> - And -<b>("
				.$recieved_form_parameters['end_time'].")</b>";
			}
		}
		if($recieved_data == 0)
		{
			$bn_time_count = 0;
			$last_result_print = "<b>".$bn_time_count.
			"</b> : (There are No Users that are Created Between the Time Period <b>("
			.$recieved_form_parameters['start_time'].")</b> - And - <b>("
			.$recieved_form_parameters['end_time'].")</b>";
		}

		// print the result
		echo  $last_result_print;
	}

  // get specific data from the server
	if($_POST["perpose"] == 'get_specific')
	{
		$id = $_POST["id"];
		// the API url will change with the appropriate ip address or domain name when the site is hosted
		$REST_API_interfaceUrl = "http://localhost/RestApi/api/api.php?perpose=specific_user&id=".$id;
		// Initialize the cURL session
		$load_data = curl_init($REST_API_interfaceUrl);
		// Set option for the cURL transfer
		curl_setopt($load_data, CURLOPT_RETURNTRANSFER, true);
		// make the curl opration
		$server_response = curl_exec($load_data);
		echo $server_response;
	}

	// to update user information
	if($_POST["perpose"] == 'edit_user')
	{
		// receive form parameters
		$recieved_form_parameters = array(
			'first_name'	=>	$_POST['first_name'],
			'last_name'		=>	$_POST['last_name'],
			'phone_number' => $_POST['phone_number'],
			'id'			=>	$_POST['hidden_id']
		);
		// the API url will change with the appropriate ip address or domain name when the site is hosted
		$REST_API_interfaceUrl = "http://localhost/RestApi/api/api.php?perpose=edit";

		// Initialize the cURL session
		$load_data = curl_init($REST_API_interfaceUrl);
		// Set option for the cURL transfer
		// Set the POST option for the cURL transfer
		curl_setopt($load_data, CURLOPT_POST, true);
		// POST the form paramerer array
		curl_setopt($load_data, CURLOPT_POSTFIELDS, $recieved_form_parameters);
		// return the actual result from the successful operation or false if not seccessfull
		curl_setopt($load_data, CURLOPT_RETURNTRANSFER, true);
		// make the curl opration
		$server_response = curl_exec($load_data);
		// Close a cURL session
		curl_close($load_data);
		$recieved_data = json_decode($server_response, true);
		foreach($recieved_data as $keys => $values)
		{
			// check if update is seccessfull
			if($recieved_data[$keys]['responceOk'] == 'true')
			{
				// update seccessfull
				echo 'edited';
			}
			else
			{
				// update not seccessfull
				echo 'fail';
			}
		}
	}

	// to create a user
	if($_POST["perpose"] == 'add_user')
	{
		// receive form parameters
		$recieved_form_parameters = array(
			'first_name'	=>	$_POST['first_name'],
			'last_name'		=>	$_POST['last_name'],
			'phone_number' =>	$_POST['phone_number']
		);
		// the API url will change with the appropriate ip address or domain name when the site is hosted
		$REST_API_interfaceUrl = "http://localhost/RestApi/api/api.php?perpose=add";

		// Initialize the cURL session
		$load_data = curl_init($REST_API_interfaceUrl);
		// Set option for the cURL transfer
		// Set the POST option for the cURL transfer
		curl_setopt($load_data, CURLOPT_POST, true);
		// POST the form paramerer array
		curl_setopt($load_data, CURLOPT_POSTFIELDS, $recieved_form_parameters);
		// return the actual result from the successful operation or false if not seccessfull
		curl_setopt($load_data, CURLOPT_RETURNTRANSFER, true);
		// make the curl opration
		$server_response = curl_exec($load_data);
		// Close a cURL session
		curl_close($load_data);
		$recieved_data = json_decode($server_response, true);
		foreach($recieved_data as $keys => $values)
		{
			// check if user creation seccessfull
			if($recieved_data[$keys]['responceOk'] == 'true')
			{
				// create seccessfull
				echo 'added';
			}
			else
			{
				// create not seccessfull
				echo 'fail';
			}
		}
	}

	// to remove a user
	if($_POST["perpose"] == 'remove_user')
	{
		$id = $_POST['id'];
		// the API url will change with the appropriate ip address or domain name when the site is hosted
		$REST_API_interfaceUrl = "http://localhost/RestApi/api/api.php?perpose=remove&id=".$id;

		// Initialize the cURL session
		$load_data = curl_init($REST_API_interfaceUrl);
		// Set option for the cURL transfer
		curl_setopt($load_data, CURLOPT_RETURNTRANSFER, true);
		// make the curl opration
		$server_response = curl_exec($load_data);
		// print server responce
		echo $server_response;
	}
}


?>
