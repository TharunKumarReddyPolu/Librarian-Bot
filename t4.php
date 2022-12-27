<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "librarianbot";
$showError=false;
$conn = mysqli_connect($server, $user, $pass, $database);
if (!$conn){
    die("Error". mysqli_connect_error());
}
$FacultyId = $_GET["FacultyId"];
$showAlert = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $im=0;
    
    $fullname = $_POST["fullname"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    if(!empty($_FILES['image']['tmp_name']) && file_exists($_FILES['image']['tmp_name'])) 
    {
        $image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $im=1;
    }    
    $mobile = $_POST["mobile"];
    $branch = $_POST["branch"];
    $yearofjoining = $_POST["yearofjoining"];
    $yearofstudy = $_POST["yearofstudy"];
    $dob = $_POST["dob"];
    if($im==1)
    {
        $sql = "UPDATE `Librarians` SET `FullName` = '$fullname', `Gender` = '$gender',`DateOfBirth` = '$dob', `Branch` = '$branch',`YearOfStudy` = '$yearofstudy', `YearOfJoining` = '$yearofjoining', `Mobile` = '$mobile', `Email` = '$email', `Image`='$image' WHERE `librarians`.`FacultyId` = '$FacultyId' ";
    }
    else
    {
        $sql = "UPDATE `Librarians` SET `FullName` = '$fullname', `Gender` = '$gender',`DateOfBirth` = '$dob', `Branch` = '$branch',`YearOfStudy` = '$yearofstudy', `YearOfJoining` = '$yearofjoining', `Mobile` = '$mobile', `Email` = '$email' WHERE `librarians`.`FacultyId` = '$FacultyId' ";
    }
    $result = mysqli_query($conn, $sql);
    if ($result)
    {
        $showAlert = true;
    }  
}
$selectQuery=" select * from librarians where FacultyId='$FacultyId'" ;
$Query = mysqli_query($conn, $selectQuery);
$row = mysqli_fetch_assoc($Query);
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
                    <form action="" method="POST" enctype="multipart/form-data" onSubmit = "return checkPassword(this)">
                        <img src="assets/vig.png" width="300" heigth="100">
                        <h1>UPDATE LIBRARIAN</h1>
                        
                        <h3>(<?php echo $row['FacultyId']; ?>)</h3>
                        <br>
                        <input type="name" placeholder="Full Name" name="fullname" value="<?php echo $row['FullName']; ?>" required>

                        <select class="gender_select input" name="gender" value="Male" required>
                            <?php if($row['Gender']=="Male"){ ?>
                                <option value="">Gender</option>
                                <option value="Male" selected>Male</option>
                                <option value="Female">Female</option>
                            <?php } else{?>
                                <option value="">Gender</option>
                                <option value="Male" >Male</option>
                                <option value="Female" selected>Female</option>
                                <?php } ?>
                        </select>
                        <div>
                          <p class="pb" >DOB</p> 
                          <input class="pa" type="date" id="birthday" value="<?php echo $row['DateOfBirth']; ?>" name="dob" style="max-width:90%;float:left;" required>
                        </div>
                        <select class="gender_select input" value="<?php echo $row['Branch']; ?>" name="branch" required>
                            <option value="">Branch</option>
                            <option value="ECE" selected>ECE</option>
                            <option value="CSE">CSE</option>
                        </select>
                        <input placeholder="Year Of Joining" value="<?php echo $row['YearOfJoining']; ?>" name="yearofjoining" required/>
                        <input placeholder="Year Of Study" value="<?php echo $row['YearOfStudy']; ?>" name="yearofstudy" required/>                        
                        <div>
                          <p class="pb" >Photo</p> 
                          <input class="pa" type="file" name="image" style="max-width:90%;float:left;"/>
                        </div>
                        <input type="email" placeholder="Mail ID" value="<?php echo $row['Email']; ?>" name="email" required/>
                        <p class ="pc" style="padding:10px 15px;">+91</p> 
                        <input class="pd" type="name" placeholder="Mobile Number" value="<?php echo $row['Mobile']; ?>"name="mobile" maxlength = "10" style="max-width:92%;float:left;" required/>
                        <br><br>
                        <button type="submit" >UPDATE</button>
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