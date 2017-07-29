  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        
      </div>

      <form class="w3-container" action="/action_page.php">
        <div class="w3-section">
          <label id ='label_date_id'>DATE:</label></br>
          <label id ='label_aircraft_id'><b>AIRCRAFT:</b></label></br>
          <label id ='label_slot_id'><b>SLOT:</b></label></br></br>
          
          <label><b>Instructor</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="usrname" required>
          <label><b>Student</b></label>
          <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="psw" required>
          <label><b>Purpose: </b></label>
          <select>
            <option value="volvo">Volvo</option>
            <option value="saab">Saab</option>
            <option value="mercedes">Mercedes</option>
            <option value="audi">Audi</option>
          </select>
          

        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">SAVE</button>
        
      </div>

    </div>
  </div>
