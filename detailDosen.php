<?php 
session_start(); 

if(!isset($_SESSION["login"])) {
  header("Location: registrasi.php");
  exit;
}

include 'functions.php';
$id = $_GET["id"];
$query = ("SELECT * FROM dosen WHERE id = $id");
$result = mysqli_query($conn, $query);
$dosen = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Project CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
  </head>
  <style>
    body{
      background: rgba(0, 128, 0, 0.3) /* Green background with 30% opacity */
    }
    .container {
      background: rgba(0, 28, 0, 0.3); /* Green background with 30% opacity */
      padding-bottom: 20px;
      padding-top: 20px;
    }
  </style>
  <body>
   <div class="container mt-5">
    <center>
    <div class="element">
      <h3> Detail Dosen </h3>
      <hr>
      <p> Nama : <?php echo $dosen["nama"]; ?></p>
      
      <p> Matkul : <?php echo $dosen["matkul"]; ?></p>
      
      <p> Jenis Kelamin : <?php echo $dosen["jenis_kelamin"]; ?></p>
      
      <p> Agama : <?php echo $dosen["agama"]; ?></p>
      
      <p> No Tlp : <?php echo $dosen["no_tlp"]; ?></p>
      <img src="img/<?php echo $dosen["gambar"]; ?>" width="80" alt="">
      </div>
      <a class="btn btn-primary mt-2" href="dosen.php" role="button">Kembali</a>
   </div>
   </center>
  </body>
</html>
