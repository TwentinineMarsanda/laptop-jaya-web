
<html>
<script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../alert/dist/sweetalert2.all.min.js"></script>
</html>
<?php 
require 'koneksi.php';



function registrasi($data){
    global $koneksi;

    $email = stripslashes( $data['email']);
    $password = mysqli_real_escape_string($koneksi,$data['pass1']);
    $password2 = mysqli_real_escape_string($koneksi,$data['pass2']);
    $hash = hash('sha256', '123456789abcdefghijklmnopq');
   
    //cek konfirm pass

    if($password != $password2)
    {
        echo "
        <script>alert('Konfirm Password Tidak Sesuai');</script>
        ";
        return false;
    }

    //Cek Email

    $result = mysqli_query($koneksi,"SELECT email FROM user WHERE email ='$email'");

    if(mysqli_fetch_assoc($result))
    {
       
        echo "
        <script>alert('Email Sudah Pernah Digunakan');</script>
        ";
        return false;
    }
    else{

          //enkripsi password
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $status = '3';
        
        $query = "INSERT INTO user VALUES('','$email','$pass','$status')";

        mysqli_query($koneksi,$query);
        echo "
        <script>alert('Berhasil Register, Silakan Login');window.location.href = 'index.php';</script>
        ";

    }
    return mysqli_affected_rows($koneksi);
}
/* Tambah Data */
 function tambahlaptop($data)
{
    global $koneksi;
    $jenis = htmlspecialchars($data['jenis']);
    $harga = htmlspecialchars($data['harga']);
    $stok = htmlspecialchars($data['stok']);
    $spesifikasi = htmlspecialchars($data['spesifikasi']);

    /* Upload Gambar */
    $gambar = upload();
    if (!$gambar)
    {
        return false;
    }

    /* Insert Data */
    $query = "INSERT INTO laptop VALUES('','$jenis','$harga','$spesifikasi','$gambar','$stok')";
    mysqli_query($koneksi,$query);
    return mysqli_affected_rows($koneksi);
}


function tambahpembelian($data)
{
    global $koneksi;
    $jenis = htmlspecialchars($data['jenis']);
    $total = htmlspecialchars($data['total']);
    $jumlah = htmlspecialchars($data['jumlah']);
    $nama = htmlspecialchars($data['nama']);
    $tanggal = date('d-m-Y');

    /* Kurangi stok */
    $query = "SELECT * FROM laptop WHERE id_laptop = '$jenis'";
    $result = mysqli_query($koneksi,$query);
    $row = mysqli_fetch_assoc($result);
    $sisastok = $row['stok'] - $jumlah;

    $query = "UPDATE laptop SET
                stok = '$sisastok'
                WHERE id_laptop = '$jenis'";
    mysqli_query($koneksi,$query);

    /* Insert Data */
    $query = "INSERT INTO pembelian VALUES('','$jenis','$total','$jumlah','$tanggal','$nama','1')";
    mysqli_query($koneksi,$query);
    return mysqli_affected_rows($koneksi);
}



function beli($data)
{
    global $koneksi;
    $id = htmlspecialchars($data['id']);
    $jumlah = htmlspecialchars($data['jumlah']);
    $email = htmlspecialchars($data['email']);
    $tanggal = date('d-m-Y');



    /* Insert Data */
    $query = "INSERT INTO pembelian VALUES('','$id','','$jumlah','$tanggal','$email','0')";
    mysqli_query($koneksi,$query);
    return mysqli_affected_rows($koneksi);
}

function tambahpetugas($data){
    global $koneksi;

    $email = stripslashes( $data['email']);
    $role = stripslashes( $data['role']);
    $password = mysqli_real_escape_string($koneksi,$data['pass1']);
    $password2 = mysqli_real_escape_string($koneksi,$data['pass2']);
    $hash = hash('sha256', '123456789abcdefghijklmnopq');
   
    //cek konfirm pass

    if($password != $password2)
    {
        echo "
        <script>alert('Konfirm Password Tidak Sesuai');</script>
        ";
        return false;
    }

    //Cek Email

    $result = mysqli_query($koneksi,"SELECT email FROM user WHERE email ='$email'");

    if(mysqli_fetch_assoc($result))
    {
       
        echo "
        <script>alert('Email Sudah Pernah Digunakan');</script>
        ";
        return false;
    }
    else{

          //enkripsi password
        $pass = password_hash($password, PASSWORD_DEFAULT);
        
        $query = "INSERT INTO user VALUES('','$email','$pass','$role')";

        mysqli_query($koneksi,$query);

    }
    return mysqli_affected_rows($koneksi);
}
/* Akhir Tambah */

/* Edit Data */
function editlaptop($data)
{
    global $koneksi;
    $id = htmlspecialchars($data['id']);
    $jenis = htmlspecialchars($data['jenis']);
    $harga = htmlspecialchars($data['harga']);
    $spesifikasi = htmlspecialchars($data['spesifikasi']);
    $gambarlama = htmlspecialchars($data['gambarlama']);
    $stok = htmlspecialchars($data['stok']);
    $eror = $_FILES['gambar']['error'];

    if($eror == 4)
    {
        $gambar = $gambarlama;
    }
    else
    {
        if(file_exists('../img/laptop/'.$gambarlama))
        {
            unlink('../img/laptop/'.$gambarlama);
        }
        $gambar = upload();
    }
    /* Upload Gambar */
    
    if (!$gambar)
    {
        return false;
    }
    /* Insert Data */
    $query = "UPDATE laptop SET
              jenis_laptop = '$jenis',
              harga = '$harga',
              spesifikasi = '$spesifikasi',
              gambar = '$gambar',
              stok = '$stok'
              WHERE id_laptop = '$id'";

    mysqli_query($koneksi,$query);
    return mysqli_affected_rows($koneksi);
}
function editpembelian($data)
{
    global $koneksi;
    $id = htmlspecialchars($data['id']);
    $total = htmlspecialchars($data['total']);
    $jumlah = htmlspecialchars($data['jumlah']);
    $nama = htmlspecialchars($data['nama']);
    $tanggal = htmlspecialchars($data['tanggal']);

    /* Update Data */
    $query = "UPDATE pembelian SET
             
              total_harga = '$total',
              jumlah = '$jumlah',
              tanggal = '$tanggal',
              nama_pembeli = '$nama'
              WHERE id = '$id'";

    mysqli_query($koneksi,$query);
    return mysqli_affected_rows($koneksi);
}


function validasipemesanan($data)
{
    global $koneksi;
    $id = htmlspecialchars($data['id']);
    $jenis = htmlspecialchars($data['idlap']);
    $jumlah = htmlspecialchars($data['jumlah']);
    $total = htmlspecialchars($data['total']);
    /* Kurangi stok */
    $query = "SELECT * FROM laptop WHERE id_laptop = '$jenis'";
    $result = mysqli_query($koneksi,$query);
    $row = mysqli_fetch_assoc($result);
    $sisastok = $row['stok'] - $jumlah;

    $query = "UPDATE laptop SET
                stok = '$sisastok'
                WHERE id_laptop = '$jenis'";
    mysqli_query($koneksi,$query);

    /* Update Data */
    $query = "UPDATE pembelian SET
              total_harga = '$total',
              status = '1'
              WHERE id = '$id'";

    mysqli_query($koneksi,$query);
    return mysqli_affected_rows($koneksi);
}


function editpetugas($data)
{
    global $koneksi;
    $id = htmlspecialchars($data['id']);
    $email = stripslashes( $data['email']);
    $role = stripslashes( $data['role']);

    /* Update Data */
    $query = "UPDATE user SET
              email = '$email',
              status = '$role'
              WHERE id_user = '$id'";

    mysqli_query($koneksi,$query);
    return mysqli_affected_rows($koneksi);
}

function upload()
{
    $nama_file = $_FILES['gambar']['name'];
    $ukuran_file = $_FILES['gambar']['size'];
    $eror = $_FILES['gambar']['error'];
    $tmpsementara = $_FILES['gambar']['tmp_name'];

    /* Cek Apakah yang diupload adalah gambar */
    
    $ekstensivalid = ['jpg','png','jpeg'];
    $ekstensigambar = explode('.',$nama_file);
    $ekstensigambar = strtolower(end($ekstensigambar));

    if(!in_array($ekstensigambar,$ekstensivalid))
    {
        
        echo "
        <script>alert('Ekstensi Gambar Anda Tidak Sesuai');</script>
        ";
        return false;
    }
    /* Cek Ukuran Gambar */
    if($ukuran_file > 4000000)
    {
        
        echo "
        <script>alert('Ukuran Gambar Terlalu Besar');</script>
        ";
        return false;
    }
    /* Pengecekan Nama Gambar */
    $namabaru = uniqid();
    $namabaru.= '.';
    $namabaru.= $ekstensigambar;
    /* Upload Gambar */

    move_uploaded_file($tmpsementara,'../img/laptop/'. $namabaru);

    return $namabaru;

}

?>
