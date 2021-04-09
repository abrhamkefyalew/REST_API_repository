<?php
	/**
	 * @author Abrham Kefyalew <abrekefe22@gmail.com>
 	 * @copyright
 	 * @license
	 */

	 // include the file with the major CRUD functions and database operations
include('../core/UsersCore.php');

// create object of a class UsersCore to
$core = new UsersCore();

/**
 * use the REST API parameters as the following
 * use this ("parameter" = "value")
 * url/api/api.php?parameter = value&parameter2 = value2
 */

if($_GET["perpose"] == 'count_all_users')
{
	// retrives the total number of users
	$core_responce = $core->count_users_all();
}
if($_GET["perpose"] == 'count_bn_time')
{
	// retrives the total number of users created between two time periods
	$core_responce = $core->count_bn_given_period();
}
if($_GET["perpose"] == 'last_name_count_all')
{
	// retrives the number of users who have the same last name in general
	$core_responce = $core->cont_same_last_name_all();
}
if($_GET["perpose"] == 'last_name_count_specific')
{
	// retrives the number of users haveing a specific last name requested from the user
	$core_responce = $core->cont_same_last_name_specific($_GET["l_name"]);
}
if($_GET["perpose"] == 'add')
{
	// creates a user
	$core_responce = $core->add_user();
}
if($_GET["perpose"] == 'remove')
{
	// deletes a user with specific user id
	$core_responce = $core->remove_user($_GET["id"]);
}
if($_GET["perpose"] == 'edit')
{
	// updates a specific user informations
	$core_responce = $core->edit_user_info();
}
if($_GET["perpose"] == 'all_users')
{
	// retrives all users with thair corrosponding information
	$core_responce = $core->get_all_users();
}
if($_GET["perpose"] == 'specific_user')
{
	// retrives a specific user with a given id
	$core_responce = $core->get_specific_user($_GET["id"]);
}

// encode (convert) the returned data on the API to JSON data format
// and print it
echo json_encode($core_responce);
?>
