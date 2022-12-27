<?php 
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "librarianbot";
    
    $conn = mysqli_connect($server, $user, $pass, $database);
    if (!$conn){
        die("Error". mysqli_connect_error());
    }
    $RollNumber = $_GET["RollNumber"];
    $selectQuery=" delete from students where RollNumber='$RollNumber'" ;
    $Query = mysqli_query($conn, $selectQuery);
    if($Query)
    {
        header('location: http://localhost/librarianbot/librarian-allmembers.php');
    }
?>
