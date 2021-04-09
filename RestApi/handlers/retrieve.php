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

if(isset($_GET["id"]))
{

	// count number of all users
	if($_GET["id"] == 'count_number_of_users')
	{
		// the API url will change with the appropriate ip address or domain name when the site is hosted
		$REST_API_interfaceUrl = "http://localhost/RestApi/api/api.php?perpose=count_all_users";
		// Initialize the cURL session
		$load_data = curl_init($REST_API_interfaceUrl);
		// Set option for the cURL transfer
		curl_setopt($load_data, CURLOPT_RETURNTRANSFER, true);
		// make the curl opration
		$server_response = curl_exec($load_data);
		$recieved_data = json_decode($server_response);
		$total_users_count = 0;
		if(!is_null($recieved_data))
		{
			$total_users_count = $recieved_data;
		}
		else
		{
			$total_users_count = 0;
		}
		// print the result
		echo  "<b>".$total_users_count."</b> : Users are registerd in your system";
	}

	// count all users which have the same last name
	if($_GET["id"] == 'same_lastname_all')
	{
		// the API url will change with the appropriate ip address or domain name when the site is hosted
		$REST_API_interfaceUrl = "http://localhost/RestApi/api/api.php?perpose=last_name_count_all";
		// Initialize the cURL session
		$load_data = curl_init($REST_API_interfaceUrl);
		// Set option for the cURL transfer
		curl_setopt($load_data, CURLOPT_RETURNTRANSFER, true);
		// make the curl opration
		$server_response = curl_exec($load_data);
		$recieved_data = json_decode($server_response);
		$total_same_last_name_count = 0;
		if(!is_null($recieved_data))
		{
			$total_same_last_name_count = $recieved_data;
		}
		else
		{
			$total_same_last_name_count = 0;
		}
		// print the result
		echo  "<b>".$total_same_last_name_count."</b> : Users Have The Same Last Name";
	}

	// retrive all user data
	if($_GET["id"] == 'all_info')
	{
		// the API url will change with the appropriate ip address or domain name when the site is hosted
		$REST_API_interfaceUrl = "http://localhost/RestApi/api/api.php?perpose=all_users";
		// Initialize the cURL session
		$load_data = curl_init($REST_API_interfaceUrl);
		// Set option for the cURL transfer
		curl_setopt($load_data, CURLOPT_RETURNTRANSFER, true);
		// make the curl opration
		$server_response = curl_exec($load_data);
		$recieved_data = json_decode($server_response);
		$user_informations = '';

		// check if the returned data is not null
		if(!is_null($recieved_data))
		{
			// data is not null
			foreach($recieved_data as $row)
			{
				// use string concatination to make a table with the user information inside it
				$user_informations .= '
				<tr>
					<td>'.$row->first_name.'</td>
					<td>'.$row->last_name.'</td>
					<td>'.$row->phone_number.'</td>
					<td>'.$row->time_created.'</td>
					<td>
						<div class="btn btn-group" role="group">
							<button type="button" name="edit" class="btn btn-info btn-xs edit" id="'.$row->id.'">
								<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
							</button>
							<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id.'">
								<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
							</button>
						</div>
					</td>
				</tr>
				';
			}
		}
		else
		{
			// data count is null
			$user_informations .= '
			<tr>
				<td colspan="4" align="left">Empty table Please add some data</td>
			</tr>
			';
		}
		// print the result
		echo $user_informations;
	}
}
?>
