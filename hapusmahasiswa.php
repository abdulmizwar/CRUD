<?php 
session_start(); 

if(!isset($_SESSION["login"])) {
  header("Location: registrasi.php");
  exit;
}

include 'functions.php';
$id = $_GET["id"]; 
if(hapusmahasiswa($id) > 0 ) {
    echo "
        <script>  
        alert('data berhasil dihapus!');
        document.location.href = 'mahasiswa.php';
        </script>
        ";
} else {
    echo "
        <script>  
        alert('data tidak berhasil dihapus!');
        document.location.href = 'mahasiswa.php';
        </script>
        ";
}
?>