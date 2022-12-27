<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $server = "localhost";
  $user = "root";
  $pass = "";
  $database = "librarianbot";
  
  $conn = mysqli_connect($server, $user, $pass, $database);
  if (!$conn){
      die("Error". mysqli_connect_error());
  }

    $fullname = $_POST["fullname"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $image = addslashes(file_get_contents($_FILES["image"]['tmp_name']));
    $rollnumber = $_POST["rollnumber"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $branch = $_POST["branch"];
    $yearofjoining = $_POST["yearofjoining"];
    $yearofstudy = $_POST["yearofstudy"];
    // $exists=false;
    // Check whether this username exists
    $existSql = "SELECT * FROM `students` WHERE RollNumber = '$rollnumber' or Email = '$email' or Mobile = '$mobile'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        $showError = "RollNumber / Email / Mobile Number Already Exists";
    }
    else{
        // $exists = false; 
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            //$sql = "INSERT INTO students (FullName, RollNumber, Age, Branch, YearOfJoining, Gender, 'Password', Email, Mobile) VALUES ('$fullname','$rollnumber','$age','$branch','$yearofjoining','$gender','$password','$email','$mobile')";
            $sql = "INSERT INTO students (FullName, RollNumber, Gender,DateOfBirth,Branch,YearOfJoining,YearOfStudy,Mobile,Email,Password,Image,Status) VALUES ('$fullname','$rollnumber','$gender','$dob','$branch','$yearofjoining','$yearofstudy','$mobile','$email','$hash','$image','P')";
            $result = mysqli_query($conn, $sql);
            if ($result){
                $showAlert = "Your Request is Submitted!";
            }  
        }
        else{
            $showError = "Passwords do not match";            
        }
    }
}
?>



<style>
    body{
        margin:0px 0px 0px 0px;
        background-size: 100% 100%;
        background-repeat: no-repeat;
        width:100%;
        background-image:url(assets/regbg.png);
    }
    
    .row{
      margin:5% auto;
      max-width:900px;
        border:2px solid black;
        border-radius:5px;
        background-color:#ffffff;
    }

    .bord{
        position:block;
        margin:5% 5% 5% 5%;
        border:2px solid black;
        vertical-align:center;
    }
    button {
		border-radius: 20px;
		border: 1px solid #12192C;
		background-color:#12192C;
		color: #FFFFFF;
		font-size: 12px;
		font-weight: bold;
		padding: 12px 45px;
		letter-spacing: 1px;
		text-transform: uppercase;
		transition: transform 80ms ease-in;
		cursor:pointer;
	}
	
	button:active {
		transform: scale(0.95);
	}
	
	button:focus {
		outline: none;
	}
	
	button.ghost {
		background-color: transparent;
		border-color: #FFFFFF;
	}
  form {
		background-color: #FFFFFF;
		display: block;
		align-items: center;
		justify-content: center;
		flex-direction: column;
		padding: 50px 50px;
		text-align: center;
	}
	
	input {
		background-color: #eee;
		border: none;
		padding: 12px 15px;
		margin: 8px 0;
		width: 100%;
	}
  .pb{
    float: left;
    background-color: #eee;
    border: none;
    padding: 13px 15px;
    margin: 8px 0;
    max-width:10%;
    color:	#696969;
  }
  .pc{
    float: left;
    background-color: #eee;
    border: none;
    padding: 13px 15px;
    margin: 8px 0;
    max-width:10%;
    color:	#696969;
  }
  @media screen and (max-width: 899px) {
    
    .pa{
      width:85.74%;
    }
  }
  @media screen and (max-width: 900px) {
    .pb{
    padding: 13px 8px;
      width:20%;
    }
    }
    @media screen and (max-width: 899px) {
     
    .pc{
      padding:10px 8px;
    }
  }
  @media screen and (max-width: 899px) {
    
    .pd{
      width:85%;
    }
  }
    .alert {
        padding: 20px;
        background-color: #f44336; /* Red */
        color: white;
        margin-bottom: 15px;
    }
    .green{
        background-color: #27AE60;
        color: black;
    }

    /* The close button */
    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    /* When moving the mouse over the close button */
    .closebtn:hover {
        color: black;
    }
    .p1{
        float:left;
        margin-left:20%;
        margin-top:0px;
    }
    .p2{
        float:left;
        margin-top:0px;
        margin-left:20%;
        margin-right:50px;
    }
    /* Add a green text color and a checkmark when the requirements are right */
    .valid {
    color: green;
    }

    .valid:before {
    position: relative;
    left: -35px;
    content: "✔";
    }

    /* Add a red text color and an "x" when the requirements are wrong */
    .invalid {
    color: red;
    }

    .invalid:before {
    position: relative;
    left: -35px;
    content: "✖";
    }

#message {
  display:none;
}
#cmessage {
  display:none;
}
.gender_select{
    background-color: #eee;
    color: black;
		border: none;
		padding: 12px 15px;
		margin: 8px 0;
		width: 100%;
}
</style>
<html>
    <body>

    <?php
    if($showAlert){ ?>
   <div class="alert green">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <?php echo $showAlert;?>
  </div>
    <?php ;
  } 
  ?>
    <?php if($showError){ ?>
    <div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <strong>Error!</strong> <?php echo $showError; ?>
  </div>
  <?php ;
    }
    ?>
        <div class="row">
                <div class="bord">
                    <form action="student-registration.php" method="POST" enctype="multipart/form-data" onSubmit = "return checkPassword(this)">
                        <img src="assets/vig.png" width="300" heigth="100">
                        <h1>Student Registration</h1>
                        <input type="name" placeholder="Full Name" name="fullname" required>
                        <input type="username" placeholder="RollNumber" name="rollnumber" required/>
                        <select class="gender_select input" name="gender" required>
                            <option value="">Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <div>
                          <p class="pb" >DOB</p> 
                          <input class="pa" type="date" id="birthday" name="dob" style="max-width:90%;float:left;" required>
                        </div>
                        <select class="gender_select input" name="branch" required>
                            <option value="">Branch</option>
                            <option value="ECE">ECE</option>
                            <option value="CSE">CSE</option>
                        </select>
                        <input placeholder="Year Of Joining" name="yearofjoining" required/>
                        <input placeholder="Year Of Study" name="yearofstudy" required/>                        
                        <div>
                          <p class="pb" >Photo</p> 
                          <input class="pa" type="file" name="image" style="max-width:90%;float:left;"/>
                        </div>
                        <input type="email" placeholder="Mail ID" name="email" required/>
                        <p class ="pc" style="padding:10px 15px;">+91</p> 
                        <input class="pd" type="name" placeholder="Mobile Number" name="mobile" maxlength = "10" style="max-width:92%;float:left;" required/>
                        <input type="password" placeholder="Password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        <div id="message">
                            <p id="letter" class="invalid p1">A lowercase letter</p>
                            <p id="capital" class="invalid p1">A capital (uppercase) letter</p>
                            <p id="number" class="invalid p2" >A number</p>
                            <p id="length" class="invalid p2">Minimum 8 characters</p>
                        </div>
                        <div id="cmessage">
                            <p id="match" class="invalid ">Passwords Matched</p>
                        </div>
                        <input type="password" placeholder="Confirm Password" id="cpassword" name="cpassword" required/>
                        <br><br>
                        <button type="submit" >REGISTER</button>
                    </form>
                </div>    
        </div>
    </body>
</html>

<script>
var myInput = document.getElementById("password");
var cmyInput = document.getElementById("cpassword");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");
var match = document.getElementById("match");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}
// When the user clicks on the password field, show the message box
cmyInput.onfocus = function() {
  document.getElementById("cmessage").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
cmyInput.onblur = function() {
  document.getElementById("cmessage").style.display = "none";
}


// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
cmyInput.onkeyup = function() {
	if(myInput.value.localeCompare(cmyInput.value)==0)
	{
		match.classList.remove("invalid");
		match.classList.add("valid");
	}
	else{
		match.classList.remove("valid");
		match.classList.add("invalid");
	}
}
function checkPassword(form) {
	password1 = form.password.value; 
    password2 = form.cpassword.value; 
	if (password1 != password2) { 
        alert ("\nPassword did not match: Please try again...") 
        return false; 
    } 
    else{ 
        return true; 
    } 
}
</script>