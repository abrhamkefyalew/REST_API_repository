<?php
 /**
	* make database connection and do CRUD oprations on user entity
	* all the data is recived from the API 'api/api.php' using JSON data format
	* @author Abrham Kefyalew <abrekefe22@gmail.com>
	* @copyright
	* @license
	*/
require_once("../connection/Connection.php");

class UsersCore
{
	/**
	 * @var $CONN object holds The connecton object from resource 'connection/Connection.php'
	 */
	private $CONN = NULL;

	/**
	 * Call the database connection class
	 */
	function __construct()
	{
		$connection=new Connection();
		$this->CONN=$connection->connect();
	}

	/**
	 * @return int
	 */
	function count_users_all()
	{
		// loop through all users
		// count all the users registed on the system
		$sqlQuery = ("SELECT COUNT(*) as total from users");
		// execute the query
		$sqlQueryResult = $this->CONN->query($sqlQuery);

			if($sqlQueryResult)
			{
				// retrive the result
				$total = $sqlQueryResult->fetch_assoc();
			}
		return $total['total'];
	}


	/**
	 * @return int
	 */
	function count_bn_given_period()
	{
		// receive the parameters for the sql statement from from the API 'api/api.php' (start_time and end_time) then
		// count the number of users created between the two times
		$time_span = array(
			':time_stat' => $_POST['start_time'],
			':time_end' => $_POST['end_time']
		);
		$starting_time = $time_span[':time_stat'];
		$ending_time =$time_span[':time_end'];
		$sqlQuery = ("SELECT COUNT(*) as total FROM users WHERE time_created >= '$starting_time' AND time_created <= '$ending_time'");
		// execute the sql statement
		$sqlQueryResult = $this->CONN->query($sqlQuery);
			if($sqlQueryResult)
			{
				// retrive the result
				$total = $sqlQueryResult->fetch_assoc();
			}
		return $total['total'];
	}


	/**
	 * @return int
	 */
	function cont_same_last_name_all()
	{
		// counts all users who have the same last name
		// this is done by grouping all the users based on thair last name simmilarity
		// all users are grouped with other user who have the same last name with them and counted
		$sqlQuery = ("SELECT COUNT(*) as total from users GROUP BY last_name");
	  // execute the sql statement
		$sqlQueryResult = $this->CONN->query($sqlQuery);
		$total = 0;
			if($sqlQueryResult)
			{
				foreach ($sqlQueryResult as $value)
				{
					// check if a user have the same last name with other user
					if($value['total']>1)
					{
						// a user have the same last name with other user
						// so count all of them which are grouped with users which have same last name with them
						$total = $total + $value['total'];
					}
				}
			}
		return $total;
	}


	/**
	 * @param $l_name_to_count stirng
	 * @return int
	 */
	function cont_same_last_name_specific($l_name_to_count)
	{
		// count number of users who have specific last name
		$sqlQuery = ("SELECT COUNT(*) as total from users WHERE last_name='".$l_name_to_count."'");
		// execute the sql statement
		$sqlQueryResult = $this->CONN->query($sqlQuery);
			if($sqlQueryResult)
			{
				$total = $sqlQueryResult->fetch_assoc();
			}
		return $total['total'];
	}

	/**
	 * @return array boolian
	 */
	function add_user()
	{
		// receive the parameters of the user for the sql statement
		// from the API 'api/api.php' (first_name, last_name, phone_number)
		// then create a user in the databae with his information
		if(isset($_POST["first_name"]))
		{
			$user_information = array(
				':first_name'	=>	$_POST['first_name'],
				':last_name'	=> $_POST['last_name'],
				':phone_number'		=>	$_POST['phone_number']
			);
      $sqlStmt = "INSERT INTO users (first_name, last_name, phone_number, time_created) VALUES (?, ?, ?, NOW())";
			$sqlStmtprepare = $this->CONN->prepare($sqlStmt);
			$sqlStmtprepare->bind_param("sss", $fname, $lname, $pnumber);
			$fname=$user_information[':first_name'];
			$lname=$user_information[':last_name'];
			$pnumber=$user_information[':phone_number'];
			// check execution seccess
			if($sqlStmtprepare->execute())
			{
				$responce[] = array(
					'responceOk'	=>	'true'
				);
			}
			else
			{
				$responce[] = array(
					'responceOk'	=>	'false'
				);
			}
		}
		else
		{
			$responce[] = array(
				'responceOk'	=>	'false'
			);
		}
		return $responce;
	}


	/**
	 * @param $id int
	 * @return array boolian
	 */
	function remove_user($id)
	{
		// remove a record from the database with a given user database table id
		$sqlStmt = ("DELETE FROM users WHERE id = '".$id."'");
		$sqlStmtprepare = $this->CONN->prepare($sqlStmt);
		if($sqlStmtprepare->execute())
		{
			$responce[] = array(
				'responceOk'	=>	'true'
			);
		}
		else
		{
			$responce[] = array(
				'responceOk'	=>	'false'
			);
		}
		return $responce;
	}

	/**
	 * @return array boolian
	 */
	function edit_user_info()
	{
		// receive the parameters of the user for the sql statement
		// from the API 'api/api.php' (id, first_name, last_name, phone_number)
		// then update a user and his information with the specific id given from the parameters
		if(isset($_POST["first_name"]))
		{
			$user_information = array(
				':first_name'	=>	$_POST['first_name'],
				':last_name'	=> $_POST['last_name'],
				':phone_number'		=>	$_POST['phone_number'],
				':id' => $_POST['id']
			);
			$sqlStmt = ("UPDATE users SET first_name = ?, last_name = ?, phone_number = ? WHERE id = ?");
			$sqlStmtprepare = $this->CONN->prepare($sqlStmt);
			$sqlStmtprepare->bind_param("sssi", $fname, $lname, $pnumber, $id);
			$fname=$user_information[':first_name'];
			$lname=$user_information[':last_name'];
			$pnumber=$user_information[':phone_number'];
			$id=$user_information[':id'];
			if($sqlStmtprepare->execute())
			{
				$responce[] = array(
					'responceOk'	=>	'true'
				);
			}
			else
			{
				$responce[] = array(
					'responceOk'	=>	'false'
				);
			}
		}
		else
		{
			$responce[] = array(
				'responceOk'	=>	'false'
			);
		}
		return $responce;
	}


	/**
	 * @return array string
	 */
	function get_all_users()
	{
		// select all users from the users table from the database
		$sqlQuery = ("SELECT * FROM users ORDER BY id DESC");
		$sqlQueryResult = $this->CONN->query($sqlQuery);
		if($sqlQueryResult)
		{
			$query_result=null;
			foreach($sqlQueryResult as $value)
			{
				$query_result[] = $value;
			}
			return $query_result;
		}
	}

	/**
	 * @param $id int
	 * @return array string
	 */
	function get_specific_user($id)
	{
		// select a single user with the specified id
		$sqlQuery = ("SELECT first_name, last_name, phone_number FROM users WHERE id='".$id."'");
		$sqlQueryResult = $this->CONN->query($sqlQuery);
		if($sqlQueryResult)
		{
			$query_result=null;
			foreach($sqlQueryResult as $value)
			{
				$query_result = $value;
			}
			return $query_result;
		}
	}
}

?>
