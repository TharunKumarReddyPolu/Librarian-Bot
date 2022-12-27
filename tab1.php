<?php 
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true ){
    header("location: index.php");
    exit;
}
require 'student-nav.php' ;
?>

<style >
.active{
  background-color: var(--bg-color);
}
.active2{
  background-color: var(--first-color);
}
.active3{
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
if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `students` WHERE CONCAT(`FullName`, `RollNumber`, `Mobile`, `Email`) LIKE '%".$valueToSearch."%'";
    $result = mysqli_query($conn, $query);
    
}
 else {
    $query = "SELECT * FROM `students`";
    $result = mysqli_query($conn, $query);
}


    ?>  

<style>
* {
  font-family: sans-serif; /* Change your font family */
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
.content-table thead tr th:first-of-type{
	width:60px;
}
.content-table thead tr th:last-of-type{
	width:100px;
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
  padding: 10px 10px;
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
  border:none;
}
.button:active {
  border:none;
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
.search{
    background-color: #0C5DF4;
    height:45px;
    border-radius:50%;
    margin-top:200px;
    border: 0px;
}
input[type=text] {
    margin-top:200px;
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
    Details are Updated!
  </div>
    <?php ;
  } 
  ?>
<form action="tab1.php" method="post">
<div>
    <input type="text" name="valueToSearch" placeholder="Search..." style="float:left;">
    <button type="submit" method="POST" name="search" class="button search" style="float:left;"><ion-icon name="search" class="nav__icon"></button>
</div>
</form>
<table class="content-table">
  <thead>
    <tr>
        <th>SNO</th>
        <th>Name</th>
        <th>RollNumber</th>
        <th>Mobile</th>
        <th>Email</th>
        <th class="two">Update</th>
        <th class="two">View</th>
        <th class="one">Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php
    while($row = $result->fetch_assoc()) {
?>
      <tr>
        <td><?php echo $k; ?></td>
        <td><?php echo $row['FullName']; ?></td>
        <td><?php echo $row['RollNumber']; ?></td>
        <td><?php echo $row['Mobile']; ?></td>
        <td><?php echo $row['Email']; ?></td>
        <td><a href="librarian-updatemember.php?RollNumber=<?php echo $row['RollNumber'];?>" ><button class="button button1"><ion-icon name="arrow-up-circle" class="nav__icon"></button></a></td>
        <td><button class="button button3"><ion-icon name="eye" class="nav__icon"></ion-icon></button></td>
        <td><a href="librarian-deletemember.php?RollNumber=<?php echo $row['RollNumber'];?>" onclick = "return confirm('<?php echo $row['RollNumber'];?>','<?php echo $_SESSION['username'];?>')"><button  class="button button2" ><ion-icon name="trash-bin" class="nav__icon" ></ion-icon></button></a></td>
      </tr>
    <?php
      $k=$k+1;
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
    function confirm(a,b) 
    {
            var txt;
            var person = prompt("Please enter your rollnumber:");
            if (person == b) 
            {
              alert ("ARE YOU SURE TO DELETE RECORD '"+a+" '"); 
              return true;
            } 
            else if(person===null)
            {
              return false;
            }
            else if (person != b)
            {
              alert ("You entered wrong rollnumber");
              return false;
            }
            else
            {
                return false;
            }
    }
</script>
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>  