<!DOCTYPE html>
<html>
	<head>
		<title>Rest Api</title>
		<link rel="stylesheet" type="text/css" href="../../public/lib/bootstrap/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<br/>
			<h3 align="left">Users List</h3>
			<br/>
			<div align="left" style="margin-bottom:13px;">
				<div class="btn btn-group" role="group">
					<button type="button" name="insert_users" id="insert_users" class="btn btn-primary btn">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create User
					</button>
					<button type="button" name="count_button" id="count_button" class="btn btn-warning btn">
						Count All Users =>
					</button>
					<h4 id="count_all_users" style="margin-left: 270px"></h4>
				</div>
				<div class="alert alert-success" role="alert" style="display: none;" id="seccess_alert_toggle">
					<h4 id="seccess_alert"></h4>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Phone Number</th>
							<th>Time Created</th>
							<th>Oprations</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<div class="col-lg-12">
				<div align="left" style="margin-bottom:100px; box-shadow: 10px 10px 8px #888888; padding: 10px; border-radius: 20px 20px;" class="col-lg-5">
					Count total number of every users with the same last name <br>
					(e.g abrham Kefyalew, redet Kefyalew & lemma Tefera, abera Tefera, asede Tefera : ----- will be count as 5) <br>
					<div class="btn btn-group" role="group">
						<button type="button" name="count_same_last_name_all" id="count_same_last_name_all" class="btn btn-primary btn">
							Count All Users with the same last name =>
						</button>
					</div>
					<h4 style="margin-left: 15px" id="lname_all"></h4>
				</div>
				<div class="col-lg-6" style="box-shadow: 10px 10px 8px #888888; padding: 10px; margin-bottom:100px; margin-left:66px; border-radius: 20px 20px;" align="center">
					Count all users with specific last name the user enters<br>
						<form class="form-inline"  method="POST" id="count_lname_specific">
							<div class="input-group" style="margin-left:44px;">
								<div class="form-group">
								 <input type="text" name="enterd_last_name" id="last_name_to_count" class="form-control" placeholder="Enter Last Name to count">
								</div>
								<input type="hidden" name="perpose" id="same_lastname_count_id_id" value="count_specifc_last_name" />  <!-- is an invisible element used to put the perpose of the opration-->
								<input type="submit" name="perpose_input_counting" class="btn btn-primary" value="Count specfic Last Name" /> <!-- submit button -->
							</div>
						</form>
						<h4 style="margin-left: 15px" id="lname_specific_counted"></h4>
				</div> <br>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-12" style="box-shadow: 10px 10px 8px #888888; padding: 10px; margin-bottom:100px; margin-left:22px; border-radius: 20px 20px;" align="left">
					Count all Users Created Between a given Time Period<br>
						<form class="form-inline"  method="POST" id="count_between_given_period">
							<div class="input-group" style="margin-left:4px;">
								<div class="form-group">
									<label>Enter Starting Time</label><br>
									<input type="datetime-local" name="t_period_start" id="period_start" class="form-control"
 							 		value="2021-04-07T10:40:11" step="1" min="1900-01-01T00:00:00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</div>
								<div class="form-group">
									<label>Enter End Time</label><br>
									<input type="datetime-local" name="t_period_end" id="period_end" class="form-control"
									value="2021-04-07T10:41:13" step="1" min="1900-01-01T00:00:00">
								</div><br><br>
								<input type="hidden" name="perpose" id="timeperiod_count_id_id" value="coumt_between_period_of_time" />  <!-- is an invisible element used to put the perpose of the opration-->
								<input type="submit" name="perpose_input_counting_time" class="btn btn-primary" value="Count Time period" /> <!-- submit button -->
							</div>
						</form>
						<h4 style="margin-left: 15px" id="time_period_counted_result"></h4>
				</div>
			</div>
		</div>
	</body>
</html>

<!-- this html element is used for both creating users and updating users (the java script will alter them)-->
<div id="hoverFormFade" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" id="userForm">
				<div class="modal-header">
		     <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- X button on the top right (to close) -->
		     <h4 class="modal-title">
					 Please Insert The Following User Informations
				 </h4>
		    </div>
		     <div class="modal-body">
		      	<div class="form-group">
			        <label>First Name</label>
			       	<input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter First Name"/>
			      </div>
			      <div class="form-group">
			       	<label>Last Name</label>
			       	<input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Last Name"/>
			      </div>
						<div class="form-group">
			        <label>Phone Number</label>
			       	<input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter Phone Number" pattern="[0-9]+"/>
			      </div>
			    </div>
			    <div class="modal-footer">
			    	<input type="hidden" name="hidden_id" id="hidden_id" /> <!-- is an invisible element used to put the 'id' of the user for 'delete' and 'update' opration-->
			    	<input type="hidden" name="perpose" id="perpose" value="add_user" /> <!-- is an invisible used to put the perpose of the opration 'insert' or 'update'-->
			    	<input type="submit" name="perpose_input" id="perpose_input" class="btn btn-info" value="Insert" /> <!-- submit button -->
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <!-- close button -->
	      	</div>
			</form>
		</div>
  </div>
</div>

<script type="text/javascript" src="../../public/lib/jquery/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../../public/lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

// i used ajax so that any CRUD operations done on this pageor  changes on the page are visible without reloading the page
// any communication and data exchange with the server or the database are done without reloading the page
// cliant requests and server listenes


	/**
	 * function call
	 * to display all user information when the page loads
	 */
	get_all_information();



	/**
	 * count the number of all users
	 */
	function count_number_of_users()
	{
		$.ajax({
			// request the number of all users from the handler
			url:"../../handlers/retrieve.php?id=count_number_of_users",
			// on seccess get the responce from the handler
			success:function(data)
			{
				// write total number of users into the html element with id = count_all_users
				$('#count_all_users').html(data);
			}
		})
	}




	/**
	 * count all users with the same last name
	 */
	function count_all_same_last_name()
	{
		$.ajax({
			// request the number of users with the same last name from the handler
			url:"../../handlers/retrieve.php?id=same_lastname_all",
			// on seccess get the responce from the handler
			success:function(data)
			{
				// write total number of users with the same last name
				// into the html element with id = lname_all
				$('#lname_all').html(data);
			}
		})
	}




	/**
	 * get all user information from the handler
	 */
	function get_all_information()
	{
		$.ajax({
			// request the all users information from the handler
			url:"../../handlers/retrieve.php?id=all_info",
			// on seccess get the responce from the handler
			success:function(data)
			{
				// write all the users with thair information into the html table body
				$('tbody').html(data);
			}
		})
	}




	/**
	 * user clicks on the button with id = count_same_last_name_all to
	 * request number of all users with the same last name
	 */
	$('#count_same_last_name_all').click(function(){
		// function call
		// the function provides number of all users with the same last name
		count_all_same_last_name();
	});




	/**
	 * user clicks on the button with id = count_button to
	 * request number of all users
	 */
	$('#count_button').click(function(){
		// function call
		// the function provides number of all users
		count_number_of_users();
	});





	/**
	 * user clicks on the button with id = count_button to
	 * user clicks insert button
	 * user requests to insert users
	 */
	$('#insert_users').click(function(){
		// alter the #userForm form parameters

		// change the perpose of the form to create a user with the informations provided on the form
		// so change the value of the html hidden input element (with id = perpose) to to add_user
		$('#perpose').val('add_user');
		// change the value of the submit html input element (with id = perpose_input) to display Insert
		$('#perpose_input').val('Insert');
		// change the title of our form by putting on the 'Please Insert The Following User Informations' text on the html element (with class = .model-title)
		$('.modal-title').text('Please Insert The Following User Informations');
		// clean any information written on the inputs of the form with id = userForm
		$('#userForm')[0].reset();
		// make the html elemet with (id = hoverFormFade) containing the form (with id = userForm) visible
		$('#hoverFormFade').modal('show');
	});





	/**
	 * user presses the submit button on the form with id = count_between_given_period
	 * user requests to see how many users created between two periods of time
	 */
	$('#count_between_given_period').on('submit', function(event){
		// prevent the form form being submitted to start with
		event.preventDefault();
		// check if start time is null
		if($('#period_start').val() == '')
		{
			// start time is null
			alert("Starting Time Is Required");
		}
		// check if end time is null
		if($('#period_end').val() == '')
		{
			// end time is null
			alert("End Time is Required");
		}
		// check for null values
		else
		{	// form data (start time and end time are not null)

			// convert the form data to URL encoded text string
			var form_data = $(this).serialize();
			$.ajax({
				// define the handler url
				url:"../../handlers/users_handler.php",
				method:"POST",
				data:form_data,
				// on seccess get the responce from the handler
				success:function(data)
				{
					// write the total number of users created between two periods of time
					// into the html element with id = time_period_counted_result
					$('#time_period_counted_result').html(data);
				}
			});
		}
	})





	/**
	 * user presses the submit button on the form with id = count_lname_specific
	 * user requests to see how many users have the same last name
	 */
	$('#count_lname_specific').on('submit', function(event){
		// prevent the form form being submitted to start with
		event.preventDefault();
		// check if last name to be counted is null
		if($('#last_name_to_count').val() == '')
		{
			// last name to be counted is null
			alert("Please enter the last name to be count");
		}
		else
		{ 	// form data (last name to be counted) is not null

			// convert the form data to URL encoded text string
			var form_data = $(this).serialize();
			$.ajax({
				// define the handler url
				url:"../../handlers/users_handler.php",
				method:"POST",
				data:form_data,
				// on seccess get the responce from the handler
				success:function(data)
				{
					// write the total number of users with the same last name
					// into the html element with id = lname_specific_counted
						$('#lname_specific_counted').html(data);
				}
			});
		}
	})





	/**
	 * user presses the submit button on the form with id = userForm
	 * user requests to insert or update user information
	 * depending on the alterd form informations the opration will be create or update
	 */
	$('#userForm').on('submit', function(event){
		// prevent the form form being submitted to start with
		event.preventDefault();
		// check if first name is null
		if($('#first_name').val() == '')
		{
				// first name is null
			alert("First Name is Required");
		}
		// check if last name is null
		else if($('#last_name').val() == '')
		{
				// last name is null
			alert("Last Name is Required");
		}
			// check if phone number is null
		else if($('#phone_number').val() == '')
		{
			// phone number is null
			alert("Phone Number is Required");
		}
		else
		{ // form data is not null

			// convert the form data to URL encoded text string
			var form_data = $(this).serialize();
			$.ajax({
				// define the handler url
				url:"../../handlers/users_handler.php",
				method:"POST",
				data:form_data,
				// on seccess get the responce from the handler
				success:function(data)
				{
					// function call
					// refresh the user information table so that the changes done will be recognizable (visible) without reloading the page
					// the new inserted or updated user and it's data will be seen (see the changes as the user presses the delete button)  without reloading the page
					get_all_information();

					// clean any information written on the inputs of the form with id = userForm
					$('#userForm')[0].reset();
					// make the html elemet with (id = hoverFormFade) containing the form (with id = userForm) invisible
					$('#hoverFormFade').modal('hide');

					// if the form request (perpose) was to create or update a user
					if(data == 'added')
					{
						// form request (perpose) was to create a user

							// write responce into the html element with id = seccess_alert
						$('#seccess_alert').html("<strong>Seccess!</strong> User is Created Seccesfully");
							// make the html element (with id = seccess_alert_toggle) showing the responce visible
						$('#seccess_alert_toggle').show();
					}
					if(data == 'edited')
					{
						// form request (perpose) was to update a user

							// write responce into the html element with id = seccess_alert
						$('#seccess_alert').html("<strong>Seccess!</strong> User is Updated Seccesfully");
							// make the html element (with id = seccess_alert_toggle) showing the responce visible
						$('#seccess_alert_toggle').show();
					}
				}
			});
		}
	});





	/**
	 * user presses the edit button (with class name = .edit) corrosponding with specific user
	 * user requests to update user or update user information then
	 * the server will write (loads) the corrosponding user information on the form inputs
	 */
	$(document).on('click', '.edit', function(){
		// every user unique database table 'id' is written into thair corrosponding html edit button (with class name = .edit)
		// so the user unique database table 'id' is the .edit button id
		// get the edit button 'id' from the table corrosponding with the html table row were edit button lies
		var id = $(this).attr('id');

		// make the perpose = get single user data (get_specific),  to request from the handler
		var perpose = 'get_specific';
		$.ajax({
			// define the handler url
			url:"../../handlers/users_handler.php",
			method:"POST",
			data:{id:id, perpose:perpose},
			dataType:"json",

			// on seccess get the responce from the handler
			success:function(returnedDataFromTheServer)
			{
				// load the id of the user on the hidden html input element (with id = hidden_id) used to hold user's unique id
				$('#hidden_id').val(id);
				// load the first name of the user on the html input element (with id = first_name)
				$('#first_name').val(returnedDataFromTheServer.first_name);
				// load the last name of the user on the html input element (with id = last_name)
				$('#last_name').val(returnedDataFromTheServer.last_name);
				// load the phone number of the user on the html input element (with id = phone_number)
				$('#phone_number').val(returnedDataFromTheServer.phone_number);
				// change the perpose of the form to update a user with the informations provided on the form
				// so change the value of the html hidden input element (with id = perpose) to to edit_user
				$('#perpose').val('edit_user');

				// change the value of the submit html input element (with id = perpose_input) to display Update
				$('#perpose_input').val('Update');
				// change the title of our form by putting on the 'Update Informations' text on the html element (with class = .model-title)
				$('.modal-title').text('Update Informations');
				// after altering all the form informations and putting (loading) all the above information on the form then
				// make the html elemet with (id = hoverFormFade) containing the form (with id = userForm) visible
				$('#hoverFormFade').modal('show');
			}
		})
	});





	/**
	 * user presses the delete button (with class name = .delete) corrosponding with specific user
	 * user requests to remove user then
	 * the server will lock the corrosponding user on the table to delete it
	 */
	$(document).on('click', '.delete', function(){
		// every user unique database table 'id' is written into thair corrosponding html delete button (with class name = .delete)
		// so the user unique database table 'id' is the .delete button id
		// get the delete button 'id' from the table corrosponding with the html table row were the delete button lies
		var id = $(this).attr("id");

		// make the perpose = remove a single user (remove_user),  to request from the handler
		var perpose = 'remove_user';
		// alert the user that a user is going to be deleted
		// if the user confirms yes on delete the user will be deleted or vice versa
		if(confirm("Are you sure you want to remove this User?"))
		{
			$.ajax({
				// define the handler url
				url:"../../handlers/users_handler.php",
				method:"POST",
				data:{id:id, perpose:perpose},
				// on seccess get the responce from the handler
				success:function(data)
				{

					// function call
					// refresh the user information table so that the changes done will be recognizable (visible) without reloading the page
					// the new deleted user and it's data will vanish (see the changes as the user presses the delete button)  without reloading the page
					get_all_information();
					// write responce into the html element with id = seccess_alert
					$('#seccess_alert').html("<strong>Seccess!</strong> User is Removed Seccesfully");
					// make the html element (with id = seccess_alert_toggle) showing the responce visible
					$('#seccess_alert_toggle').show();
				}
			});
		}
	});

});
</script>
