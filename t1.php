<?php
$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "librarianbot"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}
?>

<style>
.container{
 border:1px solid darkgrey;
 border-radius:3px;
 padding:5px;
 width: 60%;
 margin: 0 auto;
}

/* Table */
#emp_table {
 border:3px solid lavender;
 border-radius:3px;
}

/* Table header */
.tr_header{
 background-color:dodgerblue;
}
.tr_header th{
 color: white;
 padding: 10px 0px;
 letter-spacing: 1px;
}

/* Table rows and columns */
#emp_table td{
 padding:10px;
}
#emp_table tr:nth-child(even){
 background-color:lavender;
 color:black;
}

/* */
#div_pagination{
 width:100%;
 margin-top:5px;
 text-align:center;
}

.button{
 border-radius:3px;
 border:0px;
 background-color:mediumpurple;
 color:white;
 padding:10px 20px;
 letter-spacing: 1px;
}

.divnum_rows{
 display: inline-block;
 text-align: right;
 width: 30%;
}
</style>

<!doctype html>
<html>
    <head>
        <link href="style.css" type="text/css" rel="stylesheet">
        <?php

            $rowperpage = 1;
            $row = 0;
            
            if(isset($_POST['but_prev']))
            {
                $row = $_POST['row'];
                $row -= $rowperpage;
                if( $row < 0 ){
                    $row = 0;
                }
            }

            // Next Button
            if(isset($_POST['but_next'])){
                $row = $_POST['row'];
                $allcount = $_POST['allcount'];

                $val = $row + $rowperpage;
                if( $val < $allcount ){
                    $row = $val;
                }
            }
            if(isset($_POST['delete']))
            {
                $RollNumber = $_POST["delete"];
                $sql = "UPDATE `students` SET `Status` = 'A' WHERE RollNumber='$RollNumber'";
                $Query = mysqli_query($con, $sql);
                if($Query){
                    echo $RollNumber;
                }
            }

        ?>
    </head>
    <body>
    <div id="content">
        <table width="100%" id="emp_table" border="0">
            <tr class="tr_header">
                <th>S.no</th>
                <th>Name</th>
                <th>Salary</th>
            </tr>
            <?php
            // count total number of rows
            $sql = "SELECT COUNT(*) AS RollNumber FROM students where Status='P'";
            $result = mysqli_query($con,$sql);
            $fetchresult = mysqli_fetch_array($result);
            $allcount = $fetchresult['RollNumber'];

            // selecting rows
            $sql = "SELECT * FROM students  ORDER BY RollNumber ASC limit $row,".$rowperpage;
            $result = mysqli_query($con,$sql);
            $sno = $row + 1;
            while($fetch = mysqli_fetch_array($result)){
                $name = $fetch['FullName'];
                $salary = $fetch['Gender'];
                ?>
                <tr>
                    <td ><?php echo $sno; ?></td>
                    <td ><?php echo $name; ?></td>
                    <td ><?php echo $salary; ?></td>
                </tr>
                <form method="post" action="">
                <input type="submit" class="button" name="delete" value="<?php echo $fetch['RollNumber'];?>">
                </form>
            <?php
                $sno ++;
            }
            ?>
        </table>
        <form method="post" action="">
            <div id="div_pagination">
                <input type="hidden" name="row" value="<?php echo $row; ?>">
                <input type="hidden" name="allcount" value="<?php echo $allcount; ?>">
                <input type="submit" class="button" name="but_prev" value="Previous">
                <input type="submit" class="button" name="but_next" value="Next">
            </div>
        </form>
    </div>
    </body>
</html>
