<?php

    //database connection
    include("includes/connect.php");

    //Fetch all Statess
    $stateSql = "SELECT * FROM state_tbl";
    $stmt = $con->prepare($stateSql);
    $stmt->execute();
    $stateList = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--bootstrap css-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="js/registration.js"></script>

    <title>Registraion Form</title>
</head>
<body>

<div class="container-scroller">
      <div class="container page-body-wrapper full-page-wrapper border mt-4 bg-loght" >
              
        <h2 class="text-center mb-4 mt-4">Registration</h2>
          <hr>
          <form action="#" name="registraitionForm" id="registraitionForm" method="GET" onsubmit="return validateForm()">
            
            <div class="container">
              <div class="row">
                <div class="col sm 6">
                  <div class="form-group">
                    <label for="user_city"><b>First Name :</b></label>
                    <input type="text" name="user_fname" id="user_fname" maxlength="50" class="form-control" placeholder="" >   
                    <span id="txtfnameErr" class="form-text text-danger"></span>
                  </div>
                </div>
                <div class="col sm 6">
                  <div class="form-group">
                    <label for="user_city"><b>Last Name :</b></label>
                    <input type="text" name="user_lname" id="user_lname" maxlength="50" class="form-control" placeholder="" >   
                    <span id="txtlnameErr" class="form-text text-danger"></span>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col sm 6">
                  <div class="form-group">
                    <label for="user_city"><b>Email :</b></label>
                    <input type="text" name="user_email"  id="user_email"  maxlength="150" class="form-control" placeholder="" >
                    <span id="txtEmailErr" class="form-text text-danger"></span>
                  </div>
                </div>
                <div class="col sm 6">
                  <div class="form-group">
                    <label for="user_city"><b>Mobile :</b></label>
                    <input type="text" maxlength="10" name="user_mobile" id="user_mobile" class="form-control" placeholder="" >
                    <span id="txtMobileErr" class="form-text text-danger"></span>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                      <label for="user_state"><b>State :&nbsp;</b></label>                                   
                      <select class="form-control" name="user_state" id="user_state" <?php if(isset($_REQUEST['edit'])){ echo 'disabled'; } ?>>
                          <option value="">Please Select State...</option>
                          <?php foreach($stateList as $row){?>
                          <option value="<?=$row['state_id']?>" > <?=$row['state_name']?> </option>
                          <?php } ?>
                      </select>
                      <span id="txtStateErr" class="form-text text-danger"></span>
                  </div>
                </div>    
                <div class="col-sm-6">      
                    <div class="form-group">
                        <label for="user_city"><b>City :</b></label>
                        <select class="form-control" name="user_city" id="user_city" disabled>
                        <option value="">Please Select State...</option>
                        </select>
                        <span id="txtCityErr" class="form-text text-danger"></span>
                    </div>
                </div>    
              </div>      

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="user_city"><b>Password :</b></label>
                    <input type="password" name="user_password" id="user_password" maxlength="15" class="form-control" placeholder="" value="">
                    <span id="txtPasswordErr" class="form-text text-danger"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="user_city"><b>Confirm Password :</b></label>
                    <input type="password" name="user_cpassword" id="user_cpassword" maxlength="15" class="form-control" placeholder="">
                    <span id="txtCpasswordErr" class="form-text text-danger"></span>
                  </div>
                </div>  
              </div>

              <div class="form-group">
                <button type="submit" name="btnRegister" id="btnRegister" class="btn btn-primary submit-btn btn-block">Register</button>
                            
              </div>
          </form>
        </div>
      </div>
    </div>

    <!-- container-scroller -->
    
</body>

<!--JQuery link-->
<script src="bootstrap/js/jquery-3.4.1.min.js"></script>
<!--bootstrap js-->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/registration.js"></script>

</html>

<!-- <script>
    $(document).ready( function () {

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
                  console.log("in success");

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
              console.log("in error");
              console.log(error);
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
    });


</script> -->