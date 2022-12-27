
<?php	
		$login = false;
		$showError = false;
		if(array_key_exists('button1', $_POST)) { 
            button1(); 
        } 
        else if(array_key_exists('button2', $_POST)) { 
            button2(); 
        } 
        function button1() { 

		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
		$server = "localhost";
		$user = "root";
		$pass = "";
		$database = "librarianbot";
		
		$conn = mysqli_connect($server, $user, $pass, $database);
		if (!$conn)
		{
			die("Error". mysqli_connect_error());
		}
			$username = $_POST["username"];
			$password = $_POST["password"]; 
			// $sql = "Select * from users where username='$username' AND password='$password'";
			$sql = "Select * from students where RollNumber='$username' or Email='$username' or Mobile='$username'";
			$result = mysqli_query($conn, $sql);
			$num = mysqli_num_rows($result);
			if ($num == 1)
			{
				while($row=mysqli_fetch_assoc($result))
				{
					if (password_verify($password, $row['Password']))
					{ 
						if($row['Status']=="A")
						{
						$login = true;
						session_start();
						$_SESSION['loggedin'] = true;
						$_SESSION['username'] = $row['RollNumber'];
						header("location: student-home.php");
						}
						else if($row['Status']=="P")
						{
							$showError = "Your Request is pending, please contact Librarian!";
						?>
							<div class="alert">
								<span class="closebtn" href="index.php" onclick="this.parentElement.style.display='none';">&times;</span>
								<strong>Access Denied! </strong> <?php echo $showError; ?>
							</div>
					<?php 
						}
						else if($row['Status']=="R")
						{
							$showError = "Your Request is Rejected, please contact Librarian!";
						?>
							<div class="alert">
								<span class="closebtn" href="index.php" onclick="this.parentElement.style.display='none';">&times;</span>
								<strong>Access Denied! </strong> <?php echo $showError; ?>
							</div>
						<?php 
						}
					} 
					else
					{
						$showError = "Invalid Credentials";
						?>
				<div class="alert">
					<span class="closebtn" href="index.php" onclick="this.parentElement.style.display='none';">&times;</span>
					<strong>Error!</strong> <?php echo $showError; ?>
				</div>
		<?php 
						}
					}  
				} 
			else
			{
				$showError = "Invalid Credentials";
		?>
		<div class="alert">
			<span class="closebtn" href="index.php" onclick="this.parentElement.style.display='none';">&times;</span>
			<strong>Error!</strong> <?php echo "No Records Found!"; ?>
  		</div>
		<?php ;
		}
		}
        } 
        function button2() { 
            if($_SERVER["REQUEST_METHOD"] == "POST")
			{
			$server = "localhost";
			$user = "root";
			$pass = "";
			$database = "librarianbot";
			
			$conn = mysqli_connect($server, $user, $pass, $database);
			if (!$conn)
			{
				die("Error". mysqli_connect_error());
			}
			
				$username = $_POST["username"];
				$password = $_POST["password"]; 
				// $sql = "Select * from users where username='$username' AND password='$password'";
				$sql = "Select * from librarians where FacultyId='$username' or Email='$username' or Mobile='$username'";
				$result = mysqli_query($conn, $sql);
				$num = mysqli_num_rows($result);
				if ($num == 1)
				{
					while($row=mysqli_fetch_assoc($result))
					{
						if (password_verify($password, $row['Password']))
						{ 
							$login = true;
							session_start();
							$_SESSION['loggedin'] = true;
							$_SESSION['username'] = $row['FacultyId'];
							header("location: librarian-home.php");
						} 
						else
						{
							$showError = "Invalid Credentials";
							?>
					<div class="alert">
						<span class="closebtn" href="index.php" onclick="this.parentElement.style.display='none';">&times;</span>
						<strong>Error!</strong> <?php echo $showError; ?>
					</div>
			<?php 
							}
						}  
					} 
				else
				{
					$showError = "Invalid Credentials";
			?>
			<div class="alert">
				<span class="closebtn" href="index.php" onclick="this.parentElement.style.display='none';">&times;</span>
				<strong>Error!</strong> <?php echo "No Records Found!"; ?>
			</div>
		<?php ;
		}
		}
        } 
?>

<style>

	@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');
	
	* {
		box-sizing: border-box;
	}
	
	body {
		background: #f6f5f7;
		display: flex;
		justify-content: center;
		align-items: center;
		flex-direction: column;
		font-family: 'Montserrat', sans-serif;
		height: 100vh;
		margin: 0px 0 0px;
		background-image:url("assets/regbg.png");
		background-size: cover;
	}
	
	h1 {
		margin: 0;
	}
	
	h2 {
		text-align: center;
	}
	
	p {
		font-size: 14px;
		font-weight: 100;
		line-height: 20px;
		letter-spacing: 0.5px;
		margin: 20px 0 30px;
	}
	
	span {
		font-size: 12px;
	}
	
	a {
		color: #000000;
		font-size: 14px;
		text-decoration: none;
		margin: 15px 0;
	}
	
	.button {
		border-radius: 20px;
		border: 1px solid#12192C;
		background-color:#12192C;
		color: #FFFFFF;
		font-size: 12px;
		font-weight: bold;
		padding: 12px 30px;
		letter-spacing: 1px;
		text-transform: uppercase;
		transition: transform 80ms ease-in;
		cursor:pointer;
		width:40%;
	}
	
	.button:active {
		transform: scale(0.95);
	}
	
	.button:focus {
		outline: none;
	}
	
	.button.ghost {
		background-color: transparent;
		border-color: #FFFFFF;
	}
	
	form {
		background-color: #FFFFFF;
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: column;
		padding: 0 50px;
		height: 100%;
		text-align: center;
	}
	
	input {
		background-color: #eee;
		border: none;
		padding: 12px 15px;
		margin: 8px 0;
		width: 100%;
	}
	.butto{
		border-radius: 20px;
		border: 1px solid#12192C;
		background-color:#ffffff;
		text-align:center;
		color: #000000;
		font-size: 12px;
		font-weight: bold;
		padding: 12px 30px;
		letter-spacing: 1px;
		text-transform: uppercase;
		transition: transform 80ms ease-in;
		cursor:pointer;
		width:60%;
	}
	.container {
		background-color: #fff;
		border-radius: 10px;
		  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
				0 10px 10px rgba(0,0,0,0.22);
		position: relative;
		overflow: hidden;
		width: 768px;
		max-width: 100%;
		min-height: 480px;
	}
	
	.form-container {
		position: absolute;
		top: 0;
		height: 100%;
		transition: all 0.6s ease-in-out;
	}
	
	.sign-in-container {
		left: 0;
		width: 50%;
		z-index: 2;
	}
	
	.container.right-panel-active .sign-in-container {
		transform: translateX(100%);
	}
	
	.sign-up-container {
		left: 0;
		width: 50%;
		opacity: 0;
		z-index: 1;
	}
	
	.container.right-panel-active .sign-up-container {
		transform: translateX(100%);
		opacity: 1;
		z-index: 5;
		animation: show 0.6s;
	}
	
	@keyframes show {
		0%, 49.99% {
			opacity: 0;
			z-index: 1;
		}
		
		50%, 100% {
			opacity: 1;
			z-index: 5;
		}
	}
	
	.overlay-container {
		position: absolute;
		top: 0;
		left: 50%;
		width: 50%;
		height: 100%;
		overflow: hidden;
		transition: transform 0.6s ease-in-out;
		z-index: 100;
	}
	
	.container.right-panel-active .overlay-container{
		transform: translateX(-100%);
	}
	
	.overlay {
		background:		#4B0082 ;
		background: -webkit-linear-gradient(to right,		#4B0082 ,		#4B0082 );
		background: linear-gradient(to right, 		#4B0082 , 		#4B0082 );
		background-repeat: no-repeat;
		background-size: cover;
		background-position: 0 0;
		color: #FFFFFF;
		position: relative;
		left: -100%;
		height: 100%;
		width: 200%;
		  transform: translateX(0);
		transition: transform 0.6s ease-in-out;
	}
	
	.container.right-panel-active .overlay {
		  transform: translateX(50%);
	}
	
	.overlay-panel {
		position: absolute;
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: column;
		padding: 0 40px;
		text-align: center;
		top: 0;
		height: 100%;
		width: 50%;
		transform: translateX(0);
		transition: transform 0.6s ease-in-out;
	}
	
	.overlay-left {
		transform: translateX(-20%);
	}
	
	.container.right-panel-active .overlay-left {
		transform: translateX(0);
	}
	
	.overlay-right {
		right: 0;
		transform: translateX(0);
	}
	
	.container.right-panel-active .overlay-right {
		transform: translateX(20%);
	}
	.alert {

		display:block;
		position:absolute;
		width:100%;
		padding: 20px;
		background-color: rgba(239, 0, 0, 0.5); /* Red */
		color: white;
		margin-bottom:150px;
		top:0%;
	}
	.green{
	background-color: rgba(0, 239, 0, 0.5);;
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


	</style>
	
	
	
	<html>
		<div class="container" id="container">
			<div class="form-container sign-up-container">
				<form  method="POST">
					<img src="assets/vig.png" width="300" heigth="100">
					<h1>Librarian Portal</h1>
					<br>
					<input type="username" placeholder="FacultyId / Email / Phone" name="username" required/>
					<input type="password" placeholder="Password" name="password" required/>
					<a href="#">Forgot your password?</a>
          			<input type="submit" name="button2" class="button" value="Sign In" /> 
				</form>
			</div>
			<div class="form-container sign-in-container">
				<form  method="POST">
					<img src="assets/vig.png" width="300" heigth="100">
					<h1>Student Portal</h1>
					<br>
					<input type="username" placeholder="RollNumber / Email / Phone" name="username" required/>
					<input type="password" placeholder="Password" name="password" required/>
					<a href="#">Forgot your password?</a>
					<input type="submit" name="button1" class="button" value="Sign In" /> 
					<button type="button" onclick="window.location.href='student-registration.php'" class="butto button" >Register</button>				
				</form>
			</div>
			<div class="overlay-container">
				<div class="overlay">
					<div class="overlay-panel overlay-left">
						<h1>Hello, Librarian!</h1>
						<p>Are You a Student?<br>Sign In Here</p>
						<button class="ghost button" id="signIn">Sign In</button>
					</div>
					<div class="overlay-panel overlay-right">
						<h1>Hello, Friend!</h1>
						<p>Are You a Librarian?<br>Sign In Here</p>
						<button class="ghost button" id="signUp">Sign In</button>
					</div>
				</div>
			</div>
		</div>
		
	</html>
	
	
	<script>
		const signUpButton = document.getElementById('signUp');
		const signInButton = document.getElementById('signIn');
		const container = document.getElementById('container');
		
		signUpButton.addEventListener('click', () => {
			container.classList.add("right-panel-active");
		});
		
		signInButton.addEventListener('click', () => {
			container.classList.remove("right-panel-active");
		});
		
	</script>