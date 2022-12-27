<!DOCTYPE html> 
<html> 
	
<head> 
	<title> 
		How to call PHP function 
		on the click of a Button ? 
	</title> 
</head> 

<body style="text-align:center;"> 
	
	<h1 style="color:green;"> 
		GeeksforGeeks 
	</h1> 
	
	<h4> 
		How to call PHP function 
		on the click of a Button ? 
	</h4> 
	
	<?php
		if(array_key_exists('button1', $_POST)) { 
			button1(); 
		} 
		else if(array_key_exists('button2', $_POST)) { 
			button2(); 
		} 
		function button1() { 
			echo "This is Button1 that is selected"; 
		} 
		function button2() { 
			echo "This is Button2 that is selected"; 
        } 
        if(isset($_POST['button']))
        {
            echo $_POST['button'];
        }
	?> 

	<form method="post"> 
        <button type="submit" name="button" class="button" value="Button2"><ion-icon name="arrow-up-circle" class="nav__icon"></button>
        <button type="submit" name="button" class="button" value="Button1" ><ion-icon name="eye" class="nav__icon"></ion-icon></button>
         
	</form> 
</head> 

</html> 
