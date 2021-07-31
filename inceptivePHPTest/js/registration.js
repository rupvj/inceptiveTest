 //on change of State dropdown load the city dropdown
 $('#user_state').change(function(e) {

    e.preventDefault();
    $this = $(e.target);
    var stateId = $this.val();

    $.ajax({
        type: "GET",
        url: "rest/api/city/read_by_state.php?stateId="+stateId,
        success: function(response)
        {
            if(response.recordcount>0){

              console.log(response);

              $('#user_city').prop('disabled', false);
              $("#user_city option").remove();

              var Dropdown = $('#user_city');
              Dropdown.append(new Option("Select City", 0));
              $.each(response.records, function (index, item) {
                  Dropdown.append(new Option(item.name, item.id));
              });
            }
       },
       error: function(xhr, status, error) {

        // check status && 
        if(xhr.status === 400){
          
          $('#user_city').prop('disabled', true);
          $("#user_city option").remove();
          $('#user_city').append(new Option("Please Select State...", 0));
          alert("Sorry!! No City Found!!");

        }
      },
   });

  });

   //Insert user data in database
   $('#registraitionForm').submit(function(e) {

      e.preventDefault();
      $this = $(e.target);

      if($('#user_fname').val()!="" || $('#user_lname').val()!="" ||$('#user_email').val()!="" || $('#user_mobile').val()!="" || $('#user_state').val()!="" || $('#user_city').val()!="" || $('#user_password').val()!=""){

        let obj = {
          user_fname : $('#user_fname').val(),
          user_lname : $('#user_lname').val(),
          user_email : $('#user_email').val(),
          user_mobile : $('#user_mobile').val(),
          user_state : $('#user_state').val(),
          user_city : $('#user_city').val(),
          user_password : $('#user_password').val(),

        }
      $.ajax({
          async: false,
          type: "POST",
          url: "rest/api/user/registration.php",
          data: obj,
        
          success: function(response)
          {
              let resp = jQuery.parseJSON( response );
      

              if(resp['success']){
               
                window.location.href = 'home.php';

              }else{

              }
          }
        
    });

      }

      

  });




function validateForm() {
    
  console.log("in contact validate function");
      let form = document.forms["registraitionForm"];
      let txtfName = form.elements.user_fname;
      let txtlName = form.elements.user_lname;
      let txtEmail = form.elements.user_email;
      let txtMobile = form.elements.user_mobile;
      let txtState = form.elements.user_state;
      let txtCity = form.elements.user_city;
      let txtPassword = form.elements.user_password;
      let txtCpassword = form.elements.user_cpassword;

      
       let valid = true;

       if (txtfName.value == "") {
          valid = false;
          txtfnameErr.innerHTML = "Please Enter First Name";
        }else{
          valid = true;
          txtfnameErr.innerHTML = "";
        }

        if (txtlName.value == "") {
          valid = false;
          txtlnameErr.innerHTML = "Please Enter Last Name";
        }else{
          valid = true;
          txtfnameErr.innerHTML = "";
        }

        
        if (txtMobile.value == "") {
          valid = false;
          txtMobileErr.innerHTML = "Please Enter Mobile";
        }else if (txtMobile.value.length != 10) {
          valid = false;
          txtMobileErr.innerHTML = "Please Enter Valid Mobile Number";
        }else{
          valid = true;
          txtMobileErr.innerHTML = "";
        }

        if (txtEmail.value == "") {
          valid = false;
          txtEmailErr.innerHTML = "Please Enter Email";
        }else if (txtEmail.value.length > 55) {
          valid = false;
          txtEmailErr.innerHTML = "Email Must Have Less Than 55 Characters";
        }else if (!txtEmail.value.match("^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$")) {
          valid = false;
          txtEmailErr.innerHTML = "Please Enter Valid Email";
        }else{
          valid = true;
          txtEmailErr.innerHTML = "";
        }

        if (txtState.value == "") {
          valid = false;
          txtStateErr.innerHTML = "Please Select State";
        }else{
          valid = true;
          txtStateErr.innerHTML = "";
        }

        if (txtCity.value == "") {
          valid = false;
          txtCityErr.innerHTML = "Please Select City";
        }else{
          valid = true;
          txtCityErr.innerHTML = "";
        }

        if (txtPassword.value == "") {
          valid = false;
          txtPasswordErr.innerHTML = "Please Enter Password";
        }else{
          valid = true;
          txtPasswordErr.innerHTML = "";
        }

        if (txtCpassword.value == "") {
          valid = false;
          txtCpasswordErr.innerHTML = "Please Enter confirm Password";
        }else{
          valid = true;
          txtCpasswordErr.innerHTML = "";
        }

        if (txtCpassword.value != txtPassword.value) {
          valid = false;
          txtCpasswordErr.innerHTML = "Password and confirm password not match!!";
        }else{
          valid = true;
          txtCpasswordErr.innerHTML = "";
        }
        

        return valid;

}
