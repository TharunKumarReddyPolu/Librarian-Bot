<?php 
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true ){
    header("location: index.php");
    exit;
}

require 'librarian-nav.php' ;
require './table.php';
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