function openEditModal(a, b, c) {
	document.getElementById('id01').style.display='block';
	document.getElementById('label_date_id').innerHTML ='DATE: ' + b;
	document.getElementById('label_aircraft_id').innerHTML ='AIRCRAFT: ' + a;
	document.getElementById('label_slot_id').innerHTML ='SLOT: ' + c;

}