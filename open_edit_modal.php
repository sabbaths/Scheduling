  <div id="openAddEditModal" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('openAddEditModal').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        
      </div>

      <form id='edit_sched_form' action='home.php'class="w3-container" action="/action_page.php">
      <div class="w3-section">
        

          <label id='id_label'><b>ID</b></label>
          <input id='id_input' class="w3-input w3-border w3-margin-bottom" type="text" placeholder="ID" name="username" required>
          
          <label id='first_label'><b>Registration</b></label>
          <input id='first_input' class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Registration" name="username" required>

          <label id='second_label'><b>Basic Empty Weight</b></label>
          <input id='second_input' class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Basic Empty Weight" name="psw" required>

          <label id='third_label'><b>Moment</b></label>
          <input id='third_input' class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Moment" name="psw" required>

          <label id='fourth_label'><b>Moment</b></label>
          <input id='fourth_input' class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Moment" name="psw" required>

          <label id='fifth_label'><b>Moment</b></label>
          <input id='fifth_input' class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Moment" name="psw" required>

        </div>

        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
          <button onclick="document.getElementById('openAddEditModal').style.display='none'" type="button" class="w3-button w3-red">CLOSE</button>
          <button id='btn_save_modal' onclick=closeAddEditModal('add_ac_view') type="button" class="w3-button w3-red">SAVE</button>
        </div>
      </form>

    </div>
  </div>
