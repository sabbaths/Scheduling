$(document).ready(function () {

	//select_instructor
	$('.select_user_type_test').change(function(e) {
		//alert("test");
		var user_details = $(this).find(":selected").attr("id");
		var user_type_value = $(this).find(":selected").val();
		var user_type_value_id = 1;

		if(user_type_value == 'Student') {
			user_type_value_id = 3;
		} else if(user_type_value == 'Instructor') {
			user_type_value_id = 2;
		}

		console.log("value" + user_details);
		console.log("value" + user_type_value);
		addEditUser($(this).find(":selected"),'edit_user_type','','','','','','','','','',user_type_value_id);
	});

	$('#login_form').submit(function(e) {
		if(false) { //offline mode
			form.submit();
		}

	    var form = this;
	    e.preventDefault();
	    
	    var username = $('#username').val();
	    var password = $('#password').val();

	    if(username.length == 0 || password.length == 0) {
	          $("#idnga").find('h1').remove();
	          $( "#idnga" ).append( "<h1>DUH!!!</h1>" );
	          alert("Input Username and Password.");
	    } else {
	    	var jsonObjects = [{id:1, name:"amit"}, {id:2, name:"ankit"},{id:3, name:"atin"},{id:1, name:"puneet"}];

			$.ajax({
			    type: 'POST',  
			    url: 'login_handler.php', 
			    dataType: "json",
			    data: JSON.stringify(jsonObjects),
			    success: function(response) {
			        console.log(response);
			        form.submit();
			        /*
			      if(response == '1001') {
			        form.submit();
			      } else if(response == '1002'){
			        alert("Wrong Username or Password");
			      } else {
			      	alert("Account does not exist");
			      }    */ 
			    },
			    error: function(errMsg) {
			    	console.log("ERROR " + errMsg);
			    	console.log(errMsg);
			    }
			});
	    } 

	});

	$('#registration_form').submit(function(e) {
	    var form = this;
	    e.preventDefault();
	    var username = $('#username').val();
	    var first_name = $('#first_name').val();
	    var middle_name = $('#middle_name').val();
	    var last_name = $('#last_name').val();
	    var password = $('#password').val();
	    var email = $('#email').val();
	    var phone = $('#phone').val();
	    var user_type_stud = $('#rdt_btn_stud').is(':checked');
	    var user_type_fi = $('#rdt_btn_fi').is(':checked');
	    var user_type_admin = $('#rdt_btn_admin').is(':checked');

		var user_type = 1; //stud

		if(user_type_fi == true) {
			user_type = 2 //fi
		} else if(user_type_admin == true){
			user_type = 3 //admin
		}
		console.log("user type" + user_type);
		
	    if(first_name.length == 0 || last_name.length == 0) {
    		alert("Null Fields");
	    } else {
			$.ajax({
			    type: 'POST',  
			    url: 'registration_handler.php', 
			    data: { username: username,
			    		first_name: first_name,
			    		middle_name: middle_name,
			    		last_name: last_name,
			    		password: password,
			    		email: email,
			    		phone: phone,
			    		user_type: user_type
			    },
			    success: function(response) {
		        	console.log(response); 

			      if(response == '5001') {
			      	alert("Registration Successful! Wait for Admin to Accept your request.")
			        form.submit();
			      } else if(response == '5002'){
			        alert("Registration Error");
			      } else {
			      	alert("Account already exists");
			      }   
			    }
			});
	    }
	});


	$('.active_airact').change(function () {
		var input_id =  $(this).attr('id');
		//console.log(input_id);
		var is_active = $(this).is(":checked") == true ? 1 : 0;

		console.log(input_id + " " + is_active);
		
		//mode 1 = edit;
		$.ajax({  
		    type: 'POST',  
		    url: 'aircraft_handler.php', 
		    data: { mode: 'edit',
		    	 	id_input: input_id,
		    		is_active: is_active
		    },
		    success: function(response) {
		        console.log(response);
		        location.reload();  
		    }
		}); 
	});

	$('.active_slot').change(function () {
		var input_id =  $(this).attr('id');
		//console.log(input_id);
		var is_active = $(this).is(":checked") == true ? 1 : 0;

		console.log(input_id + " " + is_active);
		
		//mode 1 = edit;
		$.ajax({  
		    type: 'POST',  
		    url: 'slot_handler.php', 
		    data: { mode: 'edit_active',
		    	 	id_input: input_id,
		    		is_active: is_active
		    },
		    success: function(response) {
		        console.log(response);
		        location.reload();  
		    }
		}); 
	});	

	$('.active_student').change(function () {
		var student_details =  JSON.parse($(this).attr('id'));
		//console.log(input_id);
		var is_active = $(this).is(":checked") == true ? 1 : 0;

		console.log("Student Detail: " +student_details + " Active: " + is_active);
		
		addEditStudent('edit', student_details[0],student_details[1],student_details[2],
			student_details[3], is_active);
	});

	$('.active_user').change(function () {
		var user_details =  JSON.parse($(this).attr('id'));
		//console.log(input_id);
		var is_active = $(this).is(":checked") == true ? 1 : 0;

		console.log("User Detail: " +user_details + " Active: " + is_active);
		
		var user_id = user_details[0];
		var username = user_details[1];
		var password = user_details[2];
		var first_name = user_details[3];
		var middle_name = user_details[4];
		var last_name = user_details[5];
		var phone = user_details[5];
		var email = user_details[5];
		var active = user_details[6];
		var user_type_id = user_details[7];
		//var username = user_details[7];

		addEditUser(this, 'edit_user_active', user_id, username, password,
			first_name, middle_name, last_name, phone, email, is_active, user_type_id);
	});

	$('.active_instructor').change(function () {
		var inst_details =  JSON.parse($(this).attr('id'));
		//console.log(input_id);
		var is_active = $(this).is(":checked") == true ? 1 : 0;

		console.log("Inst Detail: " +inst_details + " Active: " + is_active);
		
		addEditInstructor('edit', inst_details[0],inst_details[1],inst_details[2],
			inst_details[3], is_active);
	});
});



function searchSel() 
{
      var input = document.getElementById('realtxt').value.toLowerCase();
       
          len = input.length;
          output = document.getElementById('select_instructor').options;
      for(var i=0; i<output.length; i++)
          if (output[i].text.toLowerCase().indexOf(input) != -1 ){
          output[i].selected = true;
              break;
          }
      if (input == '')
        output[0].selected = true;
}

function searchSelStud() {
      var input = document.getElementById('realtxtstud').value.toLowerCase();
       
          len = input.length;
          output = document.getElementById('select_student').options;
      for(var i=0; i<output.length; i++)
          if (output[i].text.toLowerCase().indexOf(input) != -1 ){
          output[i].selected = true;
              break;
          }
      if (input == '')
        output[0].selected = true;
S}

function showLoading() {
	document.getElementById("loader").style.visibility = "visible"; 
}

function hideLoading() {
	document.getElementById("loader").style.visibility = "hidden"; 
}

//schedules table in home.php
function openEditModal(ac, schedule, slot_id, slot_time, students, instructors, purpose, tabledataid) {
	document.getElementById('editScheduleModal').style.display='block';
	document.getElementById('realtxt').value = "";
	document.getElementById('realtxtstud').value = "";
	document.getElementById('label_data_id').textContent = tabledataid;
	document.getElementById('label_data_id').value = tabledataid;
	document.getElementById('label_date_id').textContent = schedule;
	document.getElementById('label_date_id').value = schedule;
	document.getElementById('label_aircraft_id').textContent = ac;
	document.getElementById('label_aircraft_id').value = ac;
	document.getElementById('label_slot_id').textContent = slot_time;
	document.getElementById('label_slot_id').value = slot_id;

	//console.log(tabledataid);
    students_obj = JSON.parse(students);
    instructors_obj = JSON.parse(instructors);
    purpose_obj = JSON.parse(purpose);

    //INSTRUCTORS
	var instructor_list = instructors_obj.instructors;
	var select_instructor = document.getElementById('select_instructor');
	while (select_instructor.firstChild) {
    	select_instructor.removeChild(select_instructor.firstChild);
	}
	for (var i = 0; i<instructor_list.length; i++){
	    var opt = document.createElement('option');
	    opt.value = instructor_list[i][0];;
	    opt.innerHTML = instructor_list[i][1] + " " + instructor_list[i][2] + " " + instructor_list[i][3];
	    select_instructor.appendChild(opt);
	}
	select_instructor.selectedIndex = instructors_obj.instructor_id - 1;

	//STUDENTS
	var student_list = students_obj.students;
	var select_student = document.getElementById('select_student');
	while (select_student.firstChild) {
    	select_student.removeChild(select_student.firstChild);
	}
	for (var x = 0; x<student_list.length; x++){
	    var opt = document.createElement('option');
	    opt.value = student_list[x][0];;
	    opt.innerHTML = student_list[x][1] + " " + student_list[x][2] + " " + student_list[x][3];
	    select_student.appendChild(opt);
	}

	select_student.selectedIndex = students_obj.student_id - 1;
	console.log("SELECTED STUD:" + select_student.selectedIndex + " " + students_obj.student_id);
	
	//PURPOSE DROPDOWN
	var purpose_list = purpose_obj.purpose;
	var select_purpose = document.getElementById('select_purpose');
	while (select_purpose.firstChild) {
    	select_purpose.removeChild(select_purpose.firstChild);
	}
	for (var y = 0; y<purpose_list.length; y++){
	    var opt = document.createElement('option');
	    opt.value = purpose_list[y][0];
	    opt.innerHTML = purpose_list[y][1];
	    select_purpose.appendChild(opt);
	}
	select_purpose.selectedIndex = purpose_obj.purpose_id - 1;

}

function cancelFlightModal() {
	document.getElementById('editScheduleModal').style.display='none';
	var selected_instructor = $('#select_instructor').find(":selected").text();
	var instructor_id = $('#select_instructor').find(":selected").val() || "";
	var selected_student = $('#select_student').find(":selected").text();
	var student_id = $('#select_student').find(":selected").val();
	var selected_purpose = $('#select_purpose').find(":selected").text();
	var purpose_id = $('#select_purpose').find(":selected").val();
	var data_flight = $('#label_data_id').val();
	var date_flight = $('#label_date_id').val();
	var aircraft_id = $('#label_aircraft_id').val();
	var slot_id = $('#label_slot_id').val();
	var slot_time = $('#label_slot_id').text();
	console.log(data_flight);
	console.log(selected_instructor + " " + instructor_id);
	console.log(selected_student + " " + student_id);
	console.log(selected_purpose + " " + purpose_id);
	console.log(date_flight);
	console.log(aircraft_id);
	console.log(slot_id + " " + slot_time);
	
	$.ajax({  
	    type: 'POST',  
	    url: 'cancel_flight_schedule.php', 
	    data: { instructor_id: instructor_id,
	    	 	student_id: student_id,
	    		purpose_id: purpose_id,
	    		slot_id: slot_id,
	    		date_flight: date_flight,
	    		aircraft_id: aircraft_id,
	    },
	    success: function(response) {
	    	//location.reload();
	        $("#"+data_flight).remove("p", "<p>");
	        $("#"+data_flight+" > p").remove();
	        $("#"+data_flight).prepend( "<p>CANCELLED</p>");
	    },
	    error: function() {
	    	alert("Error: Contact Developer");
	    }
	});

}
//close edit schedules
function closeEditModal() {
	showLoading();
	document.getElementById('editScheduleModal').style.display='none';
	//document.getElementById('openAddEditModal').style.display='none';
	var selected_instructor = $('#select_instructor').find(":selected").text();
	var instructor_id = $('#select_instructor').find(":selected").val();
	var selected_student = $('#select_student').find(":selected").text();
	var student_id = $('#select_student').find(":selected").val();
	var selected_purpose = $('#select_purpose').find(":selected").text();
	var purpose_id = $('#select_purpose').find(":selected").val();
	var date_flight = $('#label_date_id').val();
	var data_flight = $('#label_data_id').val();
	var aircraft_id = $('#label_aircraft_id').val()
	var slot_id = $('#label_slot_id').val()
	var slot_time = $('#label_slot_id').text()
	var table_td = document.getElementById(data_flight);
	/*
	console.log(data_flight);
	console.log(selected_instructor + " " + instructor_id);
	console.log(selected_student + " " + student_id);
	console.log(selected_purpose + " " + purpose_id);
	console.log(date_flight);
	console.log(aircraft_id);
	console.log(slot_id + " " + slot_time); */

	$.ajax({  
	    type: 'POST',  
	    url: 'create_edit_schedule.php', 
	    data: { instructor_id: instructor_id,
	    	 	student_id: student_id,
	    		purpose_id: purpose_id,
	    		slot_id: slot_id,
	    		date_flight: date_flight,
	    		aircraft_id: aircraft_id,
	    },
	    success: function(response) {
	        //location.reload();  
	        //console.log("append" + data_flight);
	        
	        $("#"+data_flight).remove("p", "<p>");
	        $("#"+data_flight+" > p").remove();
	        $("#"+data_flight).prepend( "<p>PURPOSE: " + selected_purpose + "</p>");
	        $("#"+data_flight).prepend( "<p>STUDENT: " + selected_student + "</p>");
	        $("#"+data_flight).prepend( "<p>CAPT: " + selected_instructor + "</p>");
	        hideLoading();
	    },
	    error: function(response) {
	    	alert("Error: Contact Developer");
	    }
	});

}

function wait(ms)
{
    var d = new Date();
    var d2 = null;
    do { d2 = new Date(); }
    while(d2-d < ms);
}


function addEditStudent(mode, id, first, middle, last, is_active) {
	console.log("add edit student");
	
	$.ajax({  
	    type: 'POST',  
	    url: 'students_handler.php', 
	    data: { mode: mode,
	    		id_input: id,
	    	 	first_name: first,
	    	 	middle_name: middle,
	    	 	last_name: last,
	    		is_active: is_active
	    },
	    success: function(response) {
	        console.log(response);
	        location.reload(); 
	    }
	});
}

function addEditUser(this_obj, mode, id, username, password, first, middle, last, phone, email, is_active, user_type_id) {
	console.log("add edit user function");
	var student_details;
	var user_id = id;
	var user_type_id;
	if(mode == 'edit_user_type' || mode == 'edit_user_active') {
		student_details =  JSON.parse($(this_obj).attr('id'));
		user_id = student_details[0];
		user_type_id = user_type_id;//student_details[7];
	}

	console.log("func addEditUser " + mode + " user id " + user_id + " user type id " + user_type_id);
	
	showLoading();

	$.ajax({  
	    type: 'POST',  
	    url: 'user_handler.php', 
	    data: { mode: mode,
	    		user_id: user_id,
	    		username: username,
	    		password: password,
	    	 	first_name: first,
	    	 	middle_name: middle,
	    	 	last_name: last,
	    	 	phone: phone,
	    	 	email: email,
	    		is_active: is_active,
	    		user_type_id: user_type_id
	    },
	    success: function(response) {
	        console.log(response);
	        location.reload(); 
	    }
	}); 
}



function addEditInstructor(mode, id, first, middle, last, is_active) {
	console.log("add edit instructor");
	
	$.ajax({  
	    type: 'POST',  
	    url: 'instructors_handler.php', 
	    data: { mode: mode,
	    		id_input: id,
	    	 	first_name: first,
	    	 	middle_name: middle,
	    	 	last_name: last,
	    		is_active: is_active
	    },
	    success: function(response) {
	        console.log(response);
	        location.reload(); 
	    }
	});
}

function addEditAC(mode, id_input, reg, bew, moment, is_active) {
	$.ajax({  
	    type: 'POST',  
	    url: 'aircraft_handler.php', 
	    data: { mode: mode,
	    		id_input: id_input,
	    	 	registration: reg,
	    	 	bew: bew,
	    	 	moment: moment,
	    		is_active: is_active
	    },
	    success: function(response) {
	        console.log(response);
	        location.reload(); 
	    }
	}); 
}

function addEditSlot(mode, id_input, first, second, third, is_active) {
	$.ajax({  
	    type: 'POST',  
	    url: 'slot_handler.php', 
	    data: { mode: mode,
	    		id_input: third,
	    	 	slot_id: first,
	    	 	slot_time: second,
	    		is_active: is_active
	    },
	    success: function(response) {
	    	var json_obj = JSON.parse(response);
	    	var status_code = json_obj.status_code;
	        console.log(response + " " + status_code);
	    	if(status_code == '9003') {
	    		alert("SLOT NUMBER/ID already exists!");
	    	} else {
	    		location.reload(); 
	    	}
	    }
	}); 
}

function addEditGS(mode, id_input, class_a, class_b) {
	$.ajax({  
	    type: 'POST',  
	    url: 'gs_handler.php', 
	    data: { mode: mode,
	    		gs_id: id_input,
	    	 	class_a: class_a,
	    	 	class_b: class_b,
	    },
	    success: function(response) {
	        console.log(response);
	        location.reload(); 
	    }
	}); 
}
//add edit of every page
function openAddEditModal(from_view, mode, data_array = '') {
	document.getElementById('openAddEditModal').style.display='block';
	var id_label = document.getElementById('id_label');
	var first_label = document.getElementById('first_label');
	var second_label = document.getElementById('second_label');
	var third_label = document.getElementById('third_label');
	var fourth_label = document.getElementById('fourth_label');
	var fifth_label = document.getElementById('fifth_label');
	var first_input = document.getElementById('first_input');
	var second_input = document.getElementById('second_input');
	var third_input = document.getElementById('third_input');
	var fourth_input = document.getElementById('fourth_input');
	var fifth_input = document.getElementById('fifth_input');

	id_input.placeholder = "ID";
	first_input.placeholder = "First Name";
	second_input.placeholder = "Middle Name";
	third_input.placeholder = "Last Name";

	first_label.textContent = 'First Name';
	second_label.textContent = 'Middle Name';
	third_label.textContent = 'Last Name';

	id_input.disabled = true;
	id_input.value = "";
	first_input.value = "";
	second_input.value = "";
	third_input.value = "";
	second_input.disabled = false;
	id_input.style.display = "none";
	id_label.style.display = "none";


	console.log(from_view, mode, data_array);
	if(from_view == 'ac_table_view') {
		fourth_label.style.display = "none";
		fifth_label.style.display = "none";
		fourth_input.style.display = "none";
		fifth_input.style.display = "none";
		document.getElementById('first_label').textContent = 'Registration';
		document.getElementById('second_label').textContent = 'Active';
		document.getElementById('third_label').textContent = 'Basic Empty Weight';		
		first_input.placeholder = "Registration";
		second_input.placeholder = "Active";
		third_input.placeholder = "Basic Empty Weight";

		if(mode == 'add') {
			//second_label.hidden = true;
			//second_input.hidden = true;
			second_input.value = "Yes";
			second_input.disabled = true;
			document.getElementById( "btn_save_modal" ).setAttribute( "onClick", "javascript: closeAddEditModal('ac_table_view','add')" );
		} else {
			second_input.disabled = true;
			second_input.disabled = true;
			id_input.value = data_array[0];
			first_input.value = data_array[1];
			second_input.value = data_array[2] == '1' ? "Yes" : "No";
			third_input.value = data_array[3];

			document.getElementById( "btn_save_modal" ).setAttribute( "onClick", "javascript: closeAddEditModal('ac_table_view','edit')" );
		}
	} else if(from_view == 'edit_slot_view') { 
		first_label.textContent = 'Slot Number';
		second_label.textContent = 'Slot Time';
		third_label.textContent = 'ID';
		third_label.style.display = "none";
		third_input.style.display = "none";
		fourth_label.style.display = "none";
		fifth_label.style.display = "none";
		fourth_input.style.display = "none";
		fifth_input.style.display = "none";


		if(mode == 'add') {


			first_input.placeholder = "";
			second_input.placeholder = "";
			third_input.text = "";
			third_input.value = "0";
			third_input.disabled = true;			


			document.getElementById( "btn_save_modal" ).setAttribute( "onClick", "javascript: closeAddEditModal('edit_slot_view','add')" );
		} else {
			id_input.value = data_array[3];
			first_input.value = data_array[0]; //slot number
			second_input.value = data_array[1]; //slot time
			third_input.value = data_array[3]; //slot id
			third_input.disabled = true;
			
			document.getElementById( "btn_save_modal" ).setAttribute( "onClick", "javascript: closeAddEditModal('edit_slot_view','edit')" );
		}

	} else if(from_view == 'students_table_view') {
		if(mode == 'add') {

			document.getElementById( "btn_save_modal" ).setAttribute( "onClick", "javascript: closeAddEditModal('students_table_view','add')" );
		} else {
			id_input.value = data_array[0];
			first_input.value = data_array[1];
			second_input.value = data_array[2];
			third_input.value = data_array[3];

			document.getElementById( "btn_save_modal" ).setAttribute( "onClick", "javascript: closeAddEditModal('students_table_view','edit')" );
		}	
	} else if(from_view == 'instructors_table_view') {
		if(mode == 'add') {
			document.getElementById( "btn_save_modal" ).setAttribute( "onClick", "javascript: closeAddEditModal('instructors_table_view','add')" );
		} else {
			id_input.value = data_array[0];
			first_input.value = data_array[1];
			second_input.value = data_array[2];
			third_input.value = data_array[3];

			document.getElementById( "btn_save_modal" ).setAttribute( "onClick", "javascript: closeAddEditModal('instructors_table_view','edit')" );
		}
	} else if(from_view == 'gs_view') {
		if(mode == 'add') {

		} else {
			first_label.textContent = 'Classroom A';
			second_label.textContent = 'Classroom B';
			third_label.style.display = 'none';

			$(first_input).replaceWith("<textarea id='first_input' class='w3-input w3-border' style='resize:none' rows='10'></textarea>");
			$(second_input).replaceWith("<textarea id='second_input' class='w3-input w3-border' style='resize:none' rows='10'></textarea>");

			first_input = document.getElementById('first_input');
			second_input = document.getElementById('second_input');

			first_input.placeholder = "";
			second_input.valplaceholderue = "";

			id_input.value = data_array[0];
			first_input.value = data_array[1] || "";
			second_input.value = data_array[2] || "";
			
			third_input.style.display = 'none';
			
			document.getElementById( "btn_save_modal" ).setAttribute( "onClick", "javascript: closeAddEditModal('gs_view','edit')" );
		}
	} else if(from_view == 'users_table_view') {
		console.log("here");
		first_label.textContent = 'Username';
		second_label.textContent = 'Password';
		first_input.placeholder = "Username";
		second_input.placeholder = "Password";
		third_label.textContent = 'First Name';
		fourth_label.textContent = 'Middle Name';
		fifth_label.textContent = 'Last Name';
		third_input.placeholder = "First Name";
		fourth_input.placeholder = "Middle Name";
		fifth_input.placeholder = "Last Name";
		fourth_input.required = true;
		fifth_input.required = true;


		if(mode == 'add') {
			document.getElementById( "btn_save_modal" ).setAttribute( "onClick", "javascript: closeAddEditModal('users_table_view','add')" );
		} else {

			id_input.value = data_array[0];
			first_input.value = data_array[1];
			second_input.value = data_array[2];
			third_input.value = data_array[3];
			fourth_input.value = data_array[4];
			fifth_input.value = data_array[5];

			document.getElementById( "btn_save_modal" ).setAttribute( "onClick", "javascript: closeAddEditModal('users_table_view','edit')" );
		}
	}

	/*else {
		document.getElementById( "btn_save_modal" ).setAttribute( "onClick", "javascript: closeAddEditModal('add_instructors_view')" );
		if(from_view == 'add_students_view') {
			document.getElementById( "btn_save_modal" ).setAttribute( "onClick", "javascript: closeAddEditModal('add_students_view', 'add')" );
		}
	} */
	
}

function closeAddEditModal(from_view, mode) {
	console.log(from_view + " "  + mode);
	var id_input = document.getElementById('id_input').value;
	var first_input = document.getElementById('first_input').value;
	var second_input = document.getElementById('second_input').value;
	var third_input = document.getElementById('third_input').value;
	var fourth_input = document.getElementById('fourth_input').value;
	var fifth_input = document.getElementById('fifth_input').value;
	var is_active = 1;//document.getElementById('third_input').value;

	//check for null inputs
	if(from_view != 'gs_view' && (first_input == "" || second_input == "" || third_input == "" || fourth_input == "" || fifth_input == "")) {
		alert("Invalid Fields");
		return;
	}

	if(from_view == "students_table_view") {
		if(mode == 'add') {
			addEditStudent(mode, id_input, first_input, second_input, third_input, 1);
			//addStudent(first_input, second_input, third_input);
		} else {
			addEditStudent(mode, id_input, first_input, second_input, third_input, is_active);
		}
	} else if(from_view == "instructors_table_view") {
		if(mode == 'add') {
			//addEditStudent(mode, id_input, first_input, second_input, third_input, 1);
			addEditInstructor(mode, id_input, first_input, second_input, third_input, 1);
		} else {
			addEditInstructor(mode, id_input, first_input, second_input, third_input, is_active);
		}
	} else if(from_view == "ac_table_view") {
		if(mode == 'add') {
			addEditAC(mode, id_input, first_input, third_input, third_input, is_active);
		} else {
			addEditAC(mode, id_input, first_input, third_input, third_input, is_active);
		}
	} else if(from_view == "gs_view") {
		if(mode == 'add') {
			//addEditAC(mode, id_input, first_input, third_input, third_input, is_active);
		} else {
			console.log("INPUT ID " +id_input);

			addEditGS(mode, id_input, first_input, second_input);
		}
	} else if(from_view == "edit_slot_view") {
		if(mode == 'add') {
			addEditSlot(mode, id_input, first_input, second_input, third_input, is_active);
		} else {
			addEditSlot(mode, id_input, first_input, second_input, third_input, is_active);
		}
	} else if(from_view == "users_table_view") {
		if(mode == 'add') {
			addEditUser('', mode, id_input, first_input, second_input, third_input, fourth_input, fifth_input, is_active);
		} else {
			addEditUser('', mode, id_input, first_input, second_input, third_input, fourth_input, fifth_input, is_active);
		}
	}
	//save data to database

	/* old code add students
	if(from_view == 'add_ac_view') { // from aircraft add save button
		addAC(first_input, second_input, third_input);
	} else if (from_view == 'add_students_view' && mode == 'add') {
		addStudent(first_input, second_input, third_input);
	} else if (from_view == 'add_instructors_view') {
		addInstructor(first_input, second_input, third_input);
	} */

	//close the modal
	document.getElementById('openAddEditModal').style.display='none'; 
}

function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
}
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}
