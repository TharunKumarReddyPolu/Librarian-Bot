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
.active2{
  background-color: var(--bg-color);
}
.active1{
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
$k=1;
$K=0;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$RollNumber=$_SESSION['username'];
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  
    ?>  

<style>
* {
  font-family: sans-serif; /* Change your font family */
}

.content-table {
  border-collapse: collapse;
  margin: 250px 10%;
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
  border-top: 2px solid #12192C;
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
</style>




<html>
<?php
    if($showAlert){ ?>
   <div class="alert green">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    Details are Updated!
  </div>
    <?php ;
  } 
  ?>
<table class="content-table">
  <thead>
    <tr>
        <th>Book Id</th>
        <th>Book Name</th>
        <th>Custody</th>
        <th>Date Of Lent</th>
        <th>Days</th>
        <th>Date of submission</th>
        <th>Fine</th>
        <th>PayFine</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $total_fine=0;
    while($row = $result->fetch_assoc()) {
        $fine_per_day = 3;
        $to_date = time();
        $fine=0;
        //echo $to_date;
        $from_date = strtotime($row['DateOfLent']);
        $day_diff = $to_date - $from_date;
        $fine_days = floor($day_diff/(60*60*24));
        $Total_days = $fine_days;
        if($fine_days>15){
            $fine_days = $fine_days - 15;
            $fine = $fine_days * $fine_per_day;
            $total_fine+=$fine;
        }
        else{
        $fine = 0;
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
        <td><?php echo $Total_days; ?></td>
        <td><?php echo date('Y-m-d', strtotime($row['DateOfLent']."+15 day")); ?></td>
        <td><?php echo $fine ?></td>
        
      <?php if($Total_days>15){ ?>
          <td><button class="button button1">Pay Fine</button> </td>      
            <?php }
                  else{ ?>
          <td> </td> 
            <?php }
        ?> 
    </tr>
    <?php
      $k=$k+1;
      }
      } else {
        echo "0 results";
      }
      $conn->close();
    ?>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo $total_fine ?></td>
        
      <?php if($total_fine>0){ ?>
          <td><button class="button button1">Pay Fine</button> </td>      
            <?php }
                  else{ ?>
          <td> </td> 
            <?php }
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