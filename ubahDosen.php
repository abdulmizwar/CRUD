<?php 
session_start(); 

if(!isset($_SESSION["login"])) {
  header("Location: registrasi.php");
  exit;
}

//menghubungkan dengan halaman functions.php
include 'functions.php';
$id = $_GET["id"];
$query = "SELECT * FROM dosen WHERE id= $id";
$row = mysqli_query($conn, $query);
$dosen = mysqli_fetch_assoc($row);

if(isset($_POST["submit"])) {
  if(ubahdosen($_POST) > 0 ) {
    echo "
    <script>  
    alert('data berhasil diubah!');
    document.location.href = 'dosen.php';
    </script>
    ";
  } else {
    echo "
    <script>  
    alert('data tidak berhasil diubah!');
    document.location.href = 'dosen.php';
    </script>
    ";
  }
}
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
    .logout{
      margin-left: 800px;
    }
  </style>
  <body>
    <!-- Navbar menu -->
    <nav class="navbar navbar-expand-lg bg-dark">
      <div class="container">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-white" href="dosen.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="dosen.php">Dosen</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="mahasiswa.php">Mahasiswa</a>
            </li>
            <div class="logout">
              <a class="btn btn-danger text-white" href="logout.php">Logout</a>
            </div>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Akhir Navbar Menu -->

    <!-- Tambah data  Dosen -->
    <div class="container mt-3 bg-info">
      <div class="judul">
        <h1>Ubah Data Dosen</h1>
      </div>
      <form action="" method="post" enctype="multipart/form-data">
      <div class="input-data">
        <div class="row">
          <div class="col-md-3">
            <input type="hidden" name="id" value="<?php echo $dosen["id"]; ?>">
            <input type="hidden" name="gambarLama" value="<?php echo $dosen["gambar"]; ?>">
            <label for="nama"> Nama : </label>
            <input type="text" size="50" id="nama" name="nama" value="<?php echo $dosen["nama"]; ?>" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label for="matkul"> Matkul : </label>
            <input type="text" size="50" id="matkul" name="matkul" value="<?php echo $dosen["matkul"]; ?>"/>
          </div>
        </div>
        <div class="jenis-kelamin mt-2">
        <h4> Jenis Kelamin ? </h4>
        </div>
        <div class="row mt-2 ms-2">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin1" checked value="pria">
            <label class="form-check-label" for="jenis_kelamin1">
              Pria
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="wanita">
            <label class="form-check-label" for="jenis_kelamin2">
              wanita
            </label>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-3">
            <label for="agama"> Agama : </label>
            <input type="text" size="50" id="agama" name="agama" value="<?php echo $dosen["agama"]; ?>" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label for="no_tlp"> No Tlp : </label>
            <input type="text" size="50" id="no_tlp" name="no_tlp" value="<?php echo $dosen["no_tlp"]; ?>" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <p>Gambar :</p>
            <img src="img/<?php echo $dosen["gambar"];?>" width="100" class="mb-2">
            <input type="file" id="gambar" name="gambar">
          </div>
        </div>
      </div>
      <div class="raw mt-2 pb-2">
        <button type="submit" class="btn btn-primary" name="submit">Ubah</button>
      </div>
      </form>
    </div>
    <!-- Akhir Tambah data dosen -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
