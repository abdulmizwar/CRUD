<?php 
// koneksi ke database 
$conn =  mysqli_connect("localhost","root","","portofolio1");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
return $rows;
}

function tambahmahasiswa($data){
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $tahun_akademik = htmlspecialchars($data["tahun_akademik"]);
    $query = "INSERT INTO mahasiswa 
    VALUES 
    ('','$nama','$nim','$jurusan','$tahun_akademik')
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function tambahdosen($data) {
global $conn;
$nama = htmlspecialchars($data["nama"]);
$matkul = htmlspecialchars($data["matkul"]);
$jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
$agama = htmlspecialchars($data["agama"]);
$no_tlp = htmlspecialchars($data["no_tlp"]);
    //upload gambar 
    $gambar = upload();
    // jika gambar tidak di masukan
    if(!$gambar) {
        return false;
    }

$query = "INSERT INTO dosen 
            VALUES 
            ('','$nama', '$matkul', '$jenis_kelamin', '$agama', '$no_tlp','$gambar')
";
mysqli_query($conn, $query);
return $conn;
}


function hapusmahasiswa($id){
    global $conn;
    $query = "DELETE FROM mahasiswa WHERE id = $id
    ";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function hapusdosen($id){
    global $conn;
    $query = "DELETE FROM dosen WHERE id = $id
    ";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}


function ubahmahasiswa($data){
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $tahun_akademik = htmlspecialchars($data["tahun_akademik"]);
    
    $query = "UPDATE mahasiswa 
                SET 
                nama = '$nama',
                nim = '$nim',
                jurusan = '$jurusan',
                tahun_akademik = '$tahun_akademik'
                WHERE id = $id
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function ubahdosen($data){
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $matkul = htmlspecialchars($data["matkul"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $agama = htmlspecialchars($data["agama"]);
    $no_tlp = htmlspecialchars($data["no_tlp"]);
    $gambarLama = $data["gambarLama"];

    if($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }


    $query = "UPDATE dosen 
                SET 
                nama = '$nama',
                matkul = '$matkul',
                jenis_kelamin = '$jenis_kelamin',
                agama = '$agama',
                no_tlp = $no_tlp, 
                gambar = '$gambar'                               
                WHERE id = $id
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function caridosen($data){
    $query  = "SELECT * FROM dosen 
                WHERE 
                nama LIKE '%$data%' OR
                matkul LIKE '%$data%' OR 
                jenis_kelamin LIKE '%$data%' OR 
                agama LIKE '%$data%' OR 
                no_tlp LIKE '%$data%'
    ";
    return query($query);
}

function carimahasiswa($data){
    $query  = "SELECT * FROM mahasiswa 
                WHERE 
                nama LIKE '%$data%' OR
                nim LIKE '%$data%' OR 
                jurusan LIKE '%$data%' OR 
                tahun_akademik LIKE '%$data%'
    ";
    return query($query);
}

function upload() {
    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $tmp_name = $_FILES["gambar"]["tmp_name"];
    $error = $_FILES["gambar"]["error"];

    // cek ada gambar yang di upload gk 
    if($error === 4) {
       echo" <script>
       alert('pilih gambar terlebih dahulu');
        </script> ";
        return false;
    }

    // cek apakah yang diupload gambar apa bukan 
    // membuat exktensi file yang dapat di gunakan dalam upload gambar
    $ekstensiFileValid = ['jpg','jpeg','png'];
    //memecah nama file dan ekstensi dari file tersebut
    $ekstensiGambar = explode('.',$namaFile);
    // mengambil ekstensi file yang di upload dan teks dari ekstensi diubah menjadi kecil semua
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    // cek jika gambar yang diupload itu sesuai dengan ekstensi yang ada atau tidak
    if(!in_array($ekstensiGambar, $ekstensiFileValid)) {
        echo" 
        <script>
            alert('yang anda upload bukan gambar!');
        </script> ";
         return false;
    }
     // cek apakah gambar yang diupload itu lebih dari 2 mb 
     if($ukuranFile > 2000000 ) {
        echo" 
        <script>
            alert('file yang anda upload ukurannya lebih dari 2 MB!');
        </script> ";
         return false;
    }
    //mencegah nama file yang di yang upload itu sama dengan nama file yang lainnya 
        //generate nama file baru 
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

    // lolos pengecekan, gambar siap di upload 
    move_uploaded_file($tmp_name, 'img/'. $namaFileBaru);
    return $namaFileBaru;
}

function register($data) {
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $password2 = mysqli_real_escape_string($conn,$data["password2"]);

     // cek username nya sama atau tidak 
     $result = mysqli_query($conn,"SELECT username FROM users WHERE username = '$username'");
     if(mysqli_fetch_assoc($result)) {
         echo" 
         <script>
             alert('username yang dimasukan sudah ada!');
         </script> ";
         return false;
     }
 
     // cek konfirmasi password 
     if($password !== $password2) {
         echo" 
         <script>
             alert('password yang anda masukan tidak sesuai');
         </script> ";
         return false;
     } 
     // enkripsi password 
     $password = password_hash($password, PASSWORD_DEFAULT);
     // TAMBAHKAN KE DALAM DATABASE 
     mysqli_query($conn, "INSERT INTO users VALUES ('','$username','$password')");
     return mysqli_affected_rows($conn);
}

?>


