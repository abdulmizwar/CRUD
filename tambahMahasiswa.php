<?php 
session_start(); 

if(!isset($_SESSION["login"])) {
  header("Location: registrasi.php");
  exit;
}

//menghubungkan dengan dengan halaman functions.php
include 'functions.php';
if(isset($_POST["submit"])) {
  if(tambahmahasiswa($_POST) > 0 ) {
    echo "
    <script>  
    alert('data berhasil ditambahkan!');
    document.location.href = 'mahasiswa.php';
    </script>
    ";
  } else {
    echo "
    <script>  
    alert('data tidak berhasil ditambahkan!');
    document.location.href = 'mahasiswa.php';
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
              <a class="nav-link text-white" href="mahasiswa.php">Home</a>
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
        <h1>Tambah Data Mahasiswa</h1>
      </div>
      <div class="input-data">
        <form action="" method="post">
        <div class="row">
          <div class="col-md-3">
            <label for="nama"> Nama : </label>
            <input type="text" size="50" id="nama" name="nama" required autocomplete="off" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label for="nim"> Nim : </label>
            <input type="text" size="50" id="nim" name="nim" required autocomplete="off" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label for="jurusan"> Jurusan : </label>
            <input type="text" size="50" id="jurusan" name="jurusan" required autocomplete="off" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label for="tahun_akademik"> Tahun Akademik : </label>
            <input type="text" size="50" id="tahun_akademik" name="tahun_akademik" required autocomplete="off"/>
          </div>
        </div>
      </div>
      <div class="raw mt-2 pb-2">
        <button  class="btn btn-primary" type="submit" name="submit" >Tambah</button>
      </div>
      </form>
    </div>
    <!-- Akhir Tambah data dosen -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
