<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;
}
require 'librarian-nav.php' ;
?>
<style >
.active{
  background-color: var(--bg-color);
}
.active2{
  background-color: var(--first-color);
}
.active1{
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

$conn = new mysqli($servername, $user, $pass, $dbname);
if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
}
$valueToSearch="";
$rowperpage = 1;
$showError=false;
$showAlert=false;
            $ro = 0;
            if(isset($_POST['reject']))
            {
              $RollNumber = $_POST["reject"];
                $sql = "UPDATE `students` SET `Status` = 'R' WHERE RollNumber='$RollNumber'";
                $Query = mysqli_query($conn, $sql);
                if($Query){
                    $showError="Request Rejected";
                }
            }
            if(isset($_POST['approve']))
            {
                $RollNumber = $_POST["approve"];
                $sql = "UPDATE `students` SET `Status` = 'A' WHERE RollNumber='$RollNumber'";
                $Query = mysqli_query($conn, $sql);
                if($Query){
                  $showAlert="Request Approved!";
                }
            }
            
                
            if(isset($_POST['but_prev']))
            {
                $ro = $_POST['row'];
                $ro -= $rowperpage;
                if( $ro < 0 ){
                    $ro = 0;
                }
            }

            // Next Button
            if(isset($_POST['but_next'])){
                $ro = $_POST['row'];
                $allcount = $_POST['allcount'];
                $val = $ro + $rowperpage;
                if( $val < $allcount ){
                    $ro = $val;
                }
            }
            if((isset($_POST['search'])) && ($_POST['valueToSearch']!=""))
            {
              $valueToSearch = $_POST['valueToSearch'];
              $sql = "SELECT COUNT(*) AS RollNumber FROM students where Status='P' and RollNumber='$valueToSearch'";
              $result = mysqli_query($conn,$sql);
              $fetchresult = mysqli_fetch_array($result);
              $allcount = $fetchresult['RollNumber'];
              if($allcount==0)
              {
                $showError="No Requests found!";
              }
              else
              {
                $sql = "SELECT * FROM students where Status='P' and RollNumber='$valueToSearch' ORDER BY RollNumber ASC limit $ro,".$rowperpage;
              $result = mysqli_query($conn,$sql);
              $sno = $ro + 1;
              }
            }
            else
            {
              $sql = "SELECT COUNT(*) AS RollNumber FROM students where Status='P'";
              $result = mysqli_query($conn,$sql);
              $fetchresult = mysqli_fetch_array($result);
              $allcount = $fetchresult['RollNumber'];

              // selecting rows
              $sql = "SELECT * FROM students where Status='P' ORDER BY RollNumber ASC limit $ro,".$rowperpage;
              $result = mysqli_query($conn,$sql);
              $sno = $ro + 1;
            }
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
  margin: 200px auto;
  margin-bottom: 40px;
  box-shadow: 1px 1px 2px rgba(0,0,0,0.125);
  padding: 30px;
  padding-bottom: 70px;
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
.prev{
  margin:30% 30%;
}
.button {
  border-radius: 7px;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 15px;
  padding: 10px 10px;
  width: 50px;
  transition: all 0.5s;
  cursor: pointer;
  float:left;
  margin-left:100px;
  width:140px;
}
.button:hover span:after {
  opacity: 1;
  right: 0;
  border:none;
}
.button:active {
  border:none;
}
.button1 {
    background-color: #0C5DF4;
}
.button2{
  background-color:#0AD76F;
}
.button3{
  background-color:#ff0000;
}
.alert {
  padding: 20px;
  background-color: #f44336; /* Red */
  color: white;
  margin-left:5%;
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
.search{
    background-color: #0C5DF4;
    height:45px;
    border-radius:50%;
    border: none;
    color: #FFFFFF;
    text-align: center;
    font-size: 15px;
    padding: 10px 10px;
    width: 50px;
    transition: all 0.5s;
    margin-right:2%;
    cursor: pointer;
}
input[type=text] {
    
    margin-bottom:50px;
    margin-right:10px;
    width: 200px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 18px;
    background-color: white;
    background-image: url('searchicon.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 11px 20px 11px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
    }
    .fix{
        margin-top:-70px;
        margin-bottom:90px;
        margin-right:10px;
    }
</style>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Profile</title>
</head>
<?php
    if($showError){ ?>
   <div class="alert red">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <?php echo $showError; ?>
  </div>
    <?php ;
  } 
  if($showAlert){ ?>
    <div class="alert green">
     <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
     <?php echo $showAlert; ?>
   </div>
     <?php ;
   } 
  ?>
<a href="librarian-allmembers.php"><button style="margin-top:10px;width:150px;" class="button button1">All Members</button></a>
<form action="" method="post">
<div class="fix">
      <button type="submit" method="POST" name="search" class="search" style="float:right;"><ion-icon name="search" class="nav__icon"></button>
      <input type="text" name="valueToSearch" placeholder="Search..." value="<?php echo $valueToSearch ;?>" style="float:right;">
</div>
</form>
<body>

    <?php
        if ($result->num_rows > 0) {
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
    ?>
                    

    <div class="wrapper">
        <div class="title">
            <?php echo $rollnumber;?><br>
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
            
            

            <form method="post" action="">
              <input type="hidden" name="row" value="<?php echo $ro; ?>">
              <input type="hidden" name="allcount" value="<?php echo $allcount; ?>">
              <?php if($ro!=0){ ?>

                <button type="submit" name="but_prev" class="button button1" style="margin-left:0px;width:40px;" value="Previous"><ion-icon name="arrow-back-circle-sharp" class="nav__icon"></button>               
              <?php } else {?>
              <div style="width=40px;"></div>
              <?php } ?>
              
              <button type="submit" name="reject" class="button button3" style="<?Php if($ro==0){ 
                                                                                            echo "margin-left:60px;";
                                                                                                  }                   
                                                                                            else{
                                                                                              echo "margin-left:20px;";
                                                                                              }?>" value="<?php echo $rollnumber;?>">Reject</button>               
              <button type="submit" name="approve" class="button button2" style="margin-left:30px;"value="<?php echo $rollnumber;?>">Approve</button>               
              
              <?php if($ro!=$allcount-1){ ?>
                <button type="submit" name="but_next" class="button button1" style="margin-left:20px;width:40px;" value="Next"><ion-icon name="arrow-forward-circle-sharp" class="nav__icon"></button>               
              <?php } else {?>
                <div style="width=40px;background-color:black;">  </div>
              <?php } ?>
            </form> 
        </div>
    </div>
    
<?php

    }
} 

$conn->close();
?>
</body>

</html>
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>  