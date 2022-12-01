<?php 
session_start();
if(isset($_SESSION["login"])) {
  header("Location: mahasiswa.php");
  exit;
}

include 'functions.php';
if(isset($_POST["register"])) {
    if(register($_POST) > 0 ) {
        echo "
        <script>
        alert('data user berhasil di tambahkan');
        </script>
        ";
    } else {
        echo "
        <script>
        alert('data user tidak berhasil di tambahkan');
        </script>
        ";
    }
}
if(isset($_POST["login"])) {
  $username = $_POST["usernameLogin"];
  $password = $_POST["passwordLogin"];

  // cek username sama atau tidak dengan isi didalam database
  $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'"); 
  
  if(mysqli_num_rows($result) === 1 ) {
	$row = mysqli_fetch_assoc($result);
	if(password_verify($password, $row["password"])) {
		$_SESSION["login"] = true;  
		header("Location: mahasiswa.php ");
		exit;
	} else {
		echo "
		<script> 
		alert('password dan username anda salah!');
		</script>
		";
	}
  } 
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form action="" method="post">
					<label for="chk" aria-hidden="true">Registrasi</label>
					<input type="text" name="username" placeholder="User name" required="">
					<input type="password" name="password" placeholder="password" required="">
					<input type="password" name="password2" placeholder="konfirmasi password" required="">
					<button type="submit" name="register">register</button>
				</form>
			</div>
			<div class="login">
				<form action="" method="post">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="text" name="usernameLogin" placeholder="Username" required="">
					<input type="password" name="passwordLogin" placeholder="Password" required="">
					<button type="submit" name="login">Login</button>
				</form>
			</div>
	</div>
</body>
</html>