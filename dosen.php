<?php 
session_start(); 

if(!isset($_SESSION["login"])) {
  header("Location: registrasi.php");
  exit;
}

include 'functions.php';
// read database dengan cara melakukan query
$hasil = query("SELECT * FROM dosen");
//jika tombol cari ditekan
if(isset($_POST["cari"])) {
  $hasil = caridosen($_POST["keyword"]);
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

    <!-- Data Mahasiswa -->
    <div class="container mt-3">
      <table class="table table-warning">
        <thead>
          <h1>Data Dosen</h1>
          <div class="row">
            <div class="col">
              <a href="tambahDosen.php" type="button" class="btn btn-primary mb-2"> + Tambah Data Dosen </a>
            </div>
            <div class="col">
              <form action="" method="post">
              <label for="cari" class="ms-5"> Cari Data Dosen : </label>
              <input type="text" id="cari" class="ms-1" name="keyword" />
              <button class="btn btn-outline-success ms-1 mb-1" type="submit" name="cari">Cari</button>
              </form>
            </div>
          </div>

          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Dosen</th>
            <th scope="col">Matkul</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Agama</th>
            <th scope="col">No Tlp</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1; ?>
          <?php foreach($hasil as $dosen) { ?>
          <tr>
            <th scope="row"><?php echo $i."."; ?></th>
            <td><?php echo $dosen["nama"] ?></td>
            <td><?php echo $dosen["matkul"] ?></td>
            <td><?php echo $dosen["jenis_kelamin"] ?></td>
            <td><?php echo $dosen["agama"] ?></td>
            <td><?php echo $dosen["no_tlp"] ?></td>
            <td>
            <a class="btn btn-secondary" href="detailDosen.php?id=<?php echo $dosen["id"]; ?>" role="button">Detail</a> |
            <a class="btn btn-danger" href="hapusdosen.php?id=<?php echo $dosen["id"];?>" onclick=" return confirm('yakin?');" role="button">Hapus</a>  |
            <a class="btn btn-success" href="ubahDosen.php?id=<?php echo $dosen["id"]; ?>" role="button">Ubah</a>
            </td>
          </tr>
          <?php $i++ ?>
        <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- Akhir data Mahasiswa -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
