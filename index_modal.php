  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        
      </div>

      <form id='edit_sched_form' action='home.php'class="w3-container" action="/action_page.php">
        <div class="w3-section">
          <label>DATE:</label>
          <label id ='label_date_id'>DATE:</label></br>
          <label>DATE:</label>
          <label id ='label_aircraft_id'><b>AIRCRAFT:</b></label></br>
          <label>SLOT:</label>
          <label id ='label_slot_id'><b>SLOT:</b></label></br></br>
          
          <label><b>Instructor</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Find Username" name="username" required>
          <div class="w3-container ">
            <select id='select_instructor' class="w3-container w3-margin-bottom">
            </select></br>
          </div>

          <label><b>Student</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Find Student" name="psw" required>
          <div class="w3-container ">
            <select id='select_student' class="w3-container w3-margin-bottom">
            </select></br>
          </div>

          <label><b>Purpose:</b></label>
          <select id='select_purpose' class="w3-container w3-margin-bottom">
          </select>
          

        </div>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">CLOSE</button>
        <button onclick=cancelFlightModal(); type="button" class="w3-button w3-red">CANCEL SCHEDULE</button>
        <button onclick=closeEditModal() type="button" class="w3-button w3-red">SAVE</button>
      </div>
      </form>



    </div>
  </div>
