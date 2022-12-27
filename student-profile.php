<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;
}

require 'student-nav.php' ;
?>
<style >
.active{
  background-color: var(--bg-color);
}
.active1{
  background-color: var(--first-color);
}
.active2{
  background-color: var(--bg-color);
}
.active3{
  background-color: var(--bg-color);
}
.active4{
  background-color: var(--bg-color);
}
</style>


<?php
$servername = "localhost";
$user = "root";
$pass = "";
$dbname = "librarianbot";

// Create connection
$conn = new mysqli($servername, $user, $pass, $dbname);
// Check connection
if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
}
$roll=$_SESSION['username'];
$sql="select * from students where RollNumber='$roll'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) 
      {
        $fullname=$row["FullName"];
                  $branch=$row["Branch"];
                  $gender=$row["Gender"];
                  $image=$row['Image'];
                  $rollnumber=$row["RollNumber"];
                  $yearofjoining=$row["YearOfJoining"];
                  $yearofstudy=$row["YearOfStudy"];
                  $email=$row["Email"];
                  $mobile=$row["Mobile"];
                  $dob=$row["DateOfBirth"];
      }
} 
else 
{
  echo "0 results";
}
$conn->close();
?>






<style>
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Montserrat', sans-serif;
}
body{
  background: #fff;
  padding: 0 0px;
}
.wrapper{
  max-width: 500px;
  width: 100%;
  background: #f1f1f1;
  border-radius:10px;
  margin: 20px auto;
  box-shadow: 1px 1px 2px rgba(0,0,0,0.125);
  padding: 30px;
}

.wrapper .title{
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 25px;
  color: #566573;
  text-transform: uppercase;
  text-align: center;
}

.wrapper .form{
  width: 100%;
}

.wrapper .form .inputfield{
  margin-bottom: 15px;
  display: flex;
  align-items: center;
}

.wrapper .form .inputfield label{
   width: 200px;
   color: #566573;
   margin-right: 10px;
  font-size: 14px;
}

.wrapper .form .inputfield .input,
.wrapper .form .inputfield .textarea{
  width: 100%;
  outline: none;
  border: 1px solid #d5dbd9;
  font-size: 15px;
  padding: 8px 10px;
  border-radius: 3px;
  transition: all 0.3s ease;
}

.wrapper .form .inputfield .textarea{
  width: 100%;
  height: 125px;
  resize: none;
}

.wrapper .form .inputfield .custom_select{
  position: relative;
  width: 100%;
  height: 37px;
}

.wrapper .form .inputfield .custom_select:before{
  content: "";
  position: absolute;
  top: 12px;
  right: 10px;
  border: 8px solid;
  border-color: #566573 transparent transparent transparent;
  pointer-events: none;
}

.wrapper .form .inputfield .custom_select select{
  -webkit-appearance: none;
  -moz-appearance:   none;
  appearance:        none;
  outline: none;
  width: 100%;
  height: 100%;
  border: 0px;
  padding: 8px 10px;
  font-size: 15px;
  border: 1px solid #566573;
  border-radius: 3px;
}


.wrapper .form .inputfield .input:focus,
.wrapper .form .inputfield .textarea:focus,
.wrapper .form .inputfield .custom_select select:focus{
  border: 1px solid #566573;
}

.wrapper .form .inputfield p{
   font-size: 14px;
   color: #757575;
}
.wrapper .form .inputfield .check{
  width: 15px;
  height: 15px;
  position: relative;
  display: block;
  cursor: pointer;
}
.wrapper .form .inputfield .check input[type="checkbox"]{
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}
.wrapper .form .inputfield .check .checkmark{
  width: 15px;
  height: 15px;
  border: 1px solid #566573;
  display: block;
  position: relative;
}
.wrapper .form .inputfield .check .checkmark:before{
  content: "";
  position: absolute;
  top: 1px;
  left: 2px;
  width: 5px;
  height: 2px;
  border: 2px solid;
  border-color: transparent transparent #fff #fff;
  transform: rotate(-45deg);
  color:#566573;
  display: none;
}
.wrapper .form .inputfield .check input[type="checkbox"]:checked ~ .checkmark{
  background: #566573;
}

.wrapper .form .inputfield .check input[type="checkbox"]:checked ~ .checkmark:before{
  display: block;
  color:#566573;
}

.wrapper .form .inputfield .btn{
  width: 100%;
   padding: 8px 10px;
  font-size: 15px; 
  border: 0px;
  background:  #566573;
  color: #fff;
  cursor: pointer;
  border-radius: 3px;
  outline: none;
}

.wrapper .form .inputfield .btn:hover{
  background: #283747 ;
}

.wrapper .form .inputfield:last-child{
  margin-bottom: 0;
}

@media (max-width:420px) {
  .wrapper .form .inputfield{
    flex-direction: column;
    align-items: flex-start;
  }
  .wrapper .form .inputfield label{
    margin-bottom: 5px;
  }
  .wrapper .form .inputfield.terms{
    flex-direction: row;
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
.image{
    padding-bottom:20px;
    text-align:center;
    
}

/* When moving the mouse over the close button */
.closebtn:hover {
  color: black;
}
</style>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Profile</title>
</head>
<body>

<div class="wrapper">
    <div class="title">
        YOUR PROFILE<br>
    </div>

    <hr class="title"style="width:100%;text-align:left;margin-left:0; padding-botton:100px">
        
    <div class="form">
            <div class="image">
                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($image ).'" width="150" height="180" >' ?>
            </div> 
            <hr class="title"style="width:100%;text-align:left;margin-left:0; padding-botton:100px">
            <div class="inputfield">
                <label>Name</label>
                <?php echo $fullname;?>
            </div>  
            
            <div class="inputfield">
                <label>Roll Number</label>
                <?php echo $rollnumber;?>
            </div>

            <div class="inputfield">
                <label>Gender</label>
                <?php echo $gender;?>
            </div> 

            <div class="inputfield">
                <label>Date Of Birth</label>
                <?php echo $dob;?>
            </div>

            <div class="inputfield">
                <label>Branch</label>
                <?php echo $branch;?>
            </div>

            <div class="inputfield">
                <label>Year of joining</label>
                <?php echo $yearofjoining;?>
            </div>

            <div class="inputfield">
                <label>Year of study</label>
                <?php echo $yearofstudy;?>
            </div>

            <div class="inputfield">
                <label>Email Address</label>
                <?php echo $email;?>
            </div>

            <div class="inputfield">
                <label>Mobile</label>
                <?php echo $mobile;?>
            </div>
</div>	

</body>

</html>