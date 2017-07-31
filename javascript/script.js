$(document).ready(function () {

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
		    	 	aircraft_id: input_id,
		    		is_active: is_active
		    },
		    success: function(response) {
		        location.reload();  
		    }
		}); 
	});
});

function openEditModal(ac, schedule, slot_id, slot_time, students, instructors, purpose) {
	document.getElementById('id01').style.display='block';
	document.getElementById('label_date_id').textContent = schedule;
	document.getElementById('label_date_id').value = schedule;
	document.getElementById('label_aircraft_id').textContent = ac;
	document.getElementById('label_aircraft_id').value = ac;
	document.getElementById('label_slot_id').textContent = slot_time;
	document.getElementById('label_slot_id').value = slot_id;

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
	document.getElementById('id01').style.display='none';
	var selected_instructor = $('#select_instructor').find(":selected").text();
	var instructor_id = $('#select_instructor').find(":selected").val() || "";
	var selected_student = $('#select_student').find(":selected").text();
	var student_id = $('#select_student').find(":selected").val();
	var selected_purpose = $('#select_purpose').find(":selected").text();
	var purpose_id = $('#select_purpose').find(":selected").val();
	var date_flight = $('#label_date_id').val();
	var aircraft_id = $('#label_aircraft_id').val();
	var slot_id = $('#label_slot_id').val();
	var slot_time = $('#label_slot_id').text();
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
	    	location.reload();
	    }
	});

}

function closeEditModal() {
	document.getElementById('id01').style.display='none';
	var selected_instructor = $('#select_instructor').find(":selected").text();
	var instructor_id = $('#select_instructor').find(":selected").val();
	var selected_student = $('#select_student').find(":selected").text();
	var student_id = $('#select_student').find(":selected").val();
	var selected_purpose = $('#select_purpose').find(":selected").text();
	var purpose_id = $('#select_purpose').find(":selected").val();
	var date_flight = $('#label_date_id').val();
	var aircraft_id = $('#label_aircraft_id').val()
	var slot_id = $('#label_slot_id').val()
	var slot_time = $('#label_slot_id').text()
	console.log(selected_instructor + " " + instructor_id);
	console.log(selected_student + " " + student_id);
	console.log(selected_purpose + " " + purpose_id);
	console.log(date_flight);
	console.log(aircraft_id);
	console.log(slot_id + " " + slot_time);

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
	        location.reload();  
	    }
	});

}
