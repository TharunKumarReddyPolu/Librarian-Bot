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
.active3{
  background-color: var(--first-color);
}
.active1{
  background-color: var(--bg-color);
}
.active2{
  background-color: var(--bg-color);
}
.active4{
  background-color: var(--bg-color);
}
</style>

<?php
$showAlert = false;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "librarianbot";
$valueToSearch = "";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['bookinsert'])){
    $bookname = $_POST["BookName"];
    $bookid = $_POST["BookId"];
    $bookcode = $_POST["BarCode"];
    $custody="Librarian";
    $sql1 = "INSERT INTO books (BookId,BookName,BarCode,Custody) VALUES ('$bookid','$bookname','$bookcode','$custody')";
    
    $result = mysqli_query($conn, $sql1);
    if ($result){
        $showAlert = true;
    }  
    
}
if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `books` WHERE CONCAT(`BookId`, `BookName`, `Custody`, `DateOfLent`) LIKE '%".$valueToSearch."%'";
    $result = mysqli_query($conn, $query);
    
}
 else {
    $query = "SELECT * FROM `books`";
    $result = mysqli_query($conn, $query);
}
$result = $conn->query($query);


  // output data of each row
  
    ?>  

<style>
* {
  font-family: sans-serif; /* Change your font family */
}
body{
  background: #ffffff;
  padding: 0 0px;
}
.content-table {
  border-collapse: collapse;
  margin: 50px 10%;
  font-size: 1em;
  border-radius: 15px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
  width:85%;
  }

.content-table thead tr {
  background-color: #12192C;
  color: #ffffff;
  text-align: left;
  font-weight: bold;
  padding:40px 10px;
}
.content-table tbody tr:hover {
  background-color: #f3f3f3;
  color: #000000;
  text-align: left;
  padding:40px 10px;
}


.content-table thead tr th{
	padding:15px 15px 10px 10px;
}
.one{
	width:100px;
}
.two{
	width:80px;
}
.content-table th,
.content-table td {
  padding: 17px 10px;
}

.content-table tbody tr {
  border-bottom: 1px solid #dddddd;
}

.content-table tbody tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

.content-table tbody tr:last-of-type {

  border-bottom: 2px solid #12192C;
}

.content-table tbody tr.active-row {
  font-weight: bold;
  color: #12192C;
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
  margin-right: 0px;
  margin-left:0px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
	.button1 {
    background-color: #0C5DF4;
    }
	.button2 {
    background-color: #FF1212;
    }
	.button3 {
		background-color: #ffd500;
		color:#000000;
    }
.due{
  background-color:#ff0000;
}
.nodue{
  background-color:#00ff00;
}
.wrapper{
  max-width: 500px;
  width: 100%;
  background: #fff;
  border-radius:10px;
  margin: 20px auto;
  box-shadow: 1px 1px 2px rgba(0,0,0,0.5);
  padding: 30px;
  border:1px solid #000000;
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
  border: 2px solid #2E4053;
  background:  #12192C;
  color: #fff;
  cursor: pointer;
  border-radius: 3px;
  outline: none;
}

.wrapper .form .inputfield .btn:hover{
  background: #12192C ;
  border: 2px solid #2E4053;
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
  margin-left:80px;
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

.regbtn{
  width: 100%;
   padding: 8px 10px;
  font-size: 15px; 
  border: 2px solid #2E4053;
  background:  #ffffff;
  color: #2E4053;
  cursor: pointer;
  border-radius: 3px;
  outline: none;
  text-align:center;
  text-decoration:none;

}
.regbtn:hover{
  width: 100%;
   padding: 8px 10px;
  font-size: 15px; 
  border: 2px solid #2E4053;
  background:  #2E4053;
  color: #ffffff;
  cursor: pointer;
  border-radius: 3px;
  outline: none;
  text-align:center;
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

.search{
    background-color: #0C5DF4;
    height:45px;
    border-radius:50%;
    margin-top:50px;
    border: 0px;
}
.searchbar[type=text] {
    margin-top:50px;
    margin-left:70%;
    margin-right:10px;
    margin-bottom:50px;
    position:block;
    width: 250px;
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
</style>




<html>
<?php
    if($showAlert){ ?>
   <div class="alert green">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    BOOK INSERTED!
  </div>
    <?php ;
  } 
  ?>

<div class="wrapper">
    <form action="tab.php" method="POST">
        <div class="title">
          ADD BOOK
        </div>
        <div class="form">
          
          <div class="inputfield">
              <label>BOOK ID</label>
              <input type="text" class="input" name="BookId" required>
          </div>


          <div class="inputfield">
              <label>BOOK NAME</label>
              <input type="text" class="input" name="BookName" required>
          </div>  

          <div class="inputfield">
              <label>BAR CODE</label>
              <input type="text" class="input" name="BarCode" required>
          </div>

          <div class="inputfield">
            <input type="submit" name="bookinsert" value="ADD BOOK" class="btn">
          </div>
        </div>
    </form>	    
</div>	
<form action="tab.php" method="post">
  <div>
      <input class="searchbar" type="text" name="valueToSearch" placeholder="Search..." value="<?php echo $valueToSearch ;?>" style="float:left;">
      <button type="submit" method="POST" name="search" class="button search" style="float:left;"><ion-icon name="search" class="nav__icon"></button>
  </div>
</form>
<table class="content-table">
  <thead>
    <tr>
        <th>Book Id</th>
        <th>Book Name</th>
        <th>Custody</th>
        <th>Date Of Lent</th>
        <th>Days</th>
        <th>Date of submission</th>
        <th>Status</th>
    </tr>
  </thead>
  <tbody>
  <?php
    while($row = $result->fetch_assoc()) {
        $fine_per_day = 3;
        $to_date = time();
        $total_fine = 0;
        //echo $to_date;
        $from_date = strtotime($row['DateOfLent']);
        $day_diff = $to_date - $from_date;
        $fine_days = floor($day_diff/(60*60*24));
        $Total_days = $fine_days;
        if($fine_days>15){
            $fine_days = $fine_days - 15;
            $total_fine = $fine_days * $fine_per_day;
        }
        else{
        $total_fine = 0;
        }
        if($Total_days<0)
        {
            $Total_days=0;
        }
  ?>
      <tr>
        <td><?php echo $row['BookId']; ?></td>
        <td><?php echo $row['BookName']; ?></td>
        <td><?php echo $row['Custody']; ?></td>
        <td><?php echo date('Y-m-d', strtotime($row['DateOfLent'])); ?></td>
        <?php if($row['Custody']!="Librarian"){
          ?>
        
        <td><?php echo $Total_days; ?></td>
        <td><?php echo date('Y-m-d', strtotime($row['DateOfLent']."+15 day")); ?></td>
        <?php if($Total_days>15){ ?>
          <td><div class="button button1 due" ><ion-icon  name="logo-usd" class="nav__icon"><div> </td>      
            <?php }
                  else{ ?>
          <td><div class="button button1 nodue"><ion-icon  name="checkmark-done-sharp" class="nav__icon"><div> </td> 
            <?php }
        ?> 
          <?php } 
          else {
            
          ?>
          <td>-</td>
        <td>-</td>
        <td><div class="button button1 nodue"><ion-icon  name="checkmark-done-sharp" class="nav__icon"><div> </td> 
          <?php
          }
          ?>
    </tr>
    <?php
    }
      if ($result->num_rows == 0)  {
          ?>
        <tr>
            <td><?php echo "0 results"; ?></td>
        </tr>
      <?php  
      }
      $conn->close();
    ?>
  </tbody>
</table>
</html>
<script>
function confirm(a) 
{
        var txt;
        var person = prompt("Please enter your rollnumber:");
        if (person == a) 
        {
          alert ("ARE YOU SURE TO DELETE RECORD '"+a+" '"); 
          return true;
        } else 
        {
          alert ("You entered wrong rollnumber");
          return false;
        }
         
}
</script>
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>  