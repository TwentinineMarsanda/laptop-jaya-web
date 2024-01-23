<?php
require "koneksi.php";

class laptop extends database {

    function __construct()
    {
        parent::__construct();
    }

    function registrasi($data){
    
        $email = stripslashes( $data['email']);
        $password = mysqli_real_escape_string($this->con,$data['pass1']);
        $password2 = mysqli_real_escape_string($this->con,$data['pass2']);
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
    
        $result = mysqli_query($this->con,"SELECT email FROM user WHERE email ='$email'");
    
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
    
            mysqli_query($this->con,$query);
            echo "
            <script>alert('Berhasil Register, Silakan Login');window.location.href = 'index.php';</script>
            ";
    
        }
        return mysqli_affected_rows($this->con);
    }

    function login($data)
    {
      
        $email = $data['email'];
        $password = $data['password'];

        $result  = mysqli_query($this->con, "SELECT * FROM user WHERE email = '$email'");
        
        if(mysqli_num_rows($result) === 1 )
        {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password,$row['password']))
            {
                $status = $row['status'];
                $email = $row['email'];
                $_SESSION['login'] = true;
                $_SESSION['status'] = $status;
                $_SESSION['email'] = $email;

                if( $status == '1')
                {
                    header("Location:petugas/petugas.php");
                }
                else if( $status == '2')
                {
                    header("Location:admin/dashboard.php");
                }
                else if( $status == '3')
                {
                    header("Location:pembeli/laptop.php");
                }
            
                exit;
            }
            else
            {
                echo "
                <script>alert('Maaf Password Salah');window.location.href = 'index.php';</script>
                ";
                exit;
            }
        }
        else
        {
            echo "
            <script>alert('Maaf Username Salah');window.location.href = 'index.php';</script>
            ";
            exit;
        }
    }
    
    /*Laptop  */
    function hitunglaptop()
    {
        $query = "SELECT * FROM laptop ";
        $result = mysqli_query($this->con,$query);
        $laptop = mysqli_num_rows($result);
       
        return $laptop;
    }
    function hitungpesanan()
    {
        $query2 = "SELECT * FROM pemesanan WHERE status = '0' ";
        $result2 = mysqli_query($this->con,$query2);
        $pesanan = mysqli_num_rows($result2);
        return $pesanan;
    }
    function hitungpembelian()
    {
        $query2 = "SELECT * FROM pembelian ";
        $result2 = mysqli_query($this->con,$query2);
        $pembelian = mysqli_num_rows($result2);
        return $pembelian;
    }
    function getlaptop(){
        $qry = mysqli_query($this->con, "SELECT * FROM laptop");
        while($datas = mysqli_fetch_assoc($qry)){
            $data[] = $datas;
        }
        return $data;
    }

    function tambahlaptop($data)
    {
        global $koneksi;
        $jenis = htmlspecialchars($data['jenis']);
        $harga = htmlspecialchars($data['harga']);
        $stok = htmlspecialchars($data['stok']);
        $spesifikasi = htmlspecialchars($data['spesifikasi']);

        /* Upload Gambar */
        $gambar = $this->upload();
        if (!$gambar)
        {
            return false;
        }

        /* Insert Data */
        $query = "INSERT INTO laptop VALUES('','$jenis','$harga','$spesifikasi','$gambar','$stok')";
        mysqli_query($this->con,$query);
        return mysqli_affected_rows($this->con);
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

    function hapuslaptop($id)
    {
        
        $query = "DELETE FROM laptop WHERE id_laptop = '$id'";
        $hapus = mysqli_query($this->con,$query);
        if($hapus)
        {   
            echo "
                <script>alert('Data Berhasil Dihapus');window.location.href = '../laptop/laptop.php';</script>
                ";
        }
    }

    function geteditlaptop($id)
    {
        $qry = mysqli_query($this->con, "SELECT * FROM laptop WHERE id_laptop = '$id'");
        $row = mysqli_fetch_assoc($qry);
        return $row;
    }

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
            $gambar = $this->upload();
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

        mysqli_query($this->con,$query);
        return mysqli_affected_rows($this->con);
    }

    function getlaptoppembeli(){
        $qry = mysqli_query($this->con, "SELECT * FROM laptop where stok >= '1'");
        return $qry;
    }
    function getlaptopbeli($id){
        $qry = mysqli_query($this->con, "SELECT * FROM  laptop WHERE id_laptop = '$id'");
        return $qry;
    }

    function beli($data)
    {
        $jenis = htmlspecialchars($data['id']);
        $harga = htmlspecialchars($data['harga']);
        $jumlah = htmlspecialchars($data['jumlah']);
        $nama = $_SESSION['email'];
        $tanggal = date('d-m-Y');

        /* Kurangi stok */
        $query = "SELECT * FROM laptop WHERE id_laptop = '$jenis'";
        $result = mysqli_query($this->con,$query);
        $row = mysqli_fetch_assoc($result);
        $sisastok = $row['stok'] - $jumlah;

        $query = "UPDATE laptop SET
                    stok = '$sisastok'
                    WHERE id_laptop = '$jenis'";
        mysqli_query($this->con,$query);

        /* Insert Data */
        $query = "INSERT INTO pemesanan VALUES('','$jenis','$harga','$jumlah','$tanggal','$nama','0')";
        mysqli_query($this->con,$query);
        return mysqli_affected_rows($this->con);
    }

    function getpesananpembeli(){
        $email = $_SESSION['email'];
        $qry = mysqli_query($this->con, "SELECT * FROM pemesanan
        JOIN laptop ON pemesanan.id_laptop = laptop.id_laptop 
        WHERE pemesanan.nama_pembeli = '$email' ORDER BY id_pemesanan DESC");
        return $qry;
    }

    function batalpesanan($id)
    {   
        // tampil pesanan
        $qry =  mysqli_query($this->con,"SELECT * FROM pemesanan WHERE id_pemesanan = '$id'");
        $data = mysqli_fetch_assoc($qry);
        $id_laptop = $data['id_laptop'];
        $jumlah_beli = $data['jumlah'];
        //tampil laptop
        $qry1 =  mysqli_query($this->con,"SELECT * FROM laptop WHERE id_laptop = '$id_laptop'");
        $laptop = mysqli_fetch_assoc($qry1);
        $stok = $laptop['stok'];
        $stokbaru = $jumlah_beli + $stok;

         $qryu = "UPDATE laptop SET
         stok = '$stokbaru'
         WHERE id_laptop = '$id_laptop'";

         $update = mysqli_query($this->con,$qryu);

        $query = "DELETE FROM pemesanan WHERE id_pemesanan = '$id' AND status = '0'";
        $hapus = mysqli_query($this->con,$query);
        if($hapus)
        {   
            echo "
                <script>alert('Pesanan Dibatalkan');window.location.href = '../pembeli/laptop.php';</script>
                ";
        }
        echo "
        <script>alert('Gagal Menghapus Pesanan');window.location.href = '../pembeli/laptop.php';</script>
        ";
    }
    function getpembelian(){
        $qry = mysqli_query($this->con, "SELECT * FROM pembelian
                             JOIN pemesanan ON pembelian.id_pemesanan = pemesanan.id_pemesanan 
                             INNER JOIN laptop ON pemesanan.id_laptop = laptop.id_laptop;");
        return $qry;
    }

    function getpemesanan(){
        $qry = mysqli_query($this->con, "SELECT *,laptop.jenis_laptop FROM pemesanan
        JOIN laptop ON pemesanan.id_laptop = laptop.id_laptop
        WHERE status = '0'");
        return $qry;
        
    }
    function getvalidpesanan($id){
        $qry = mysqli_query($this->con, "SELECT *,laptop.jenis_laptop FROM pemesanan 
        INNER JOIN laptop ON pemesanan.id_laptop = laptop.id_laptop WHERE id_pemesanan = '$id'");

        return $qry;
        
    }

    function validasipemesanan($data)
    {
        $id = htmlspecialchars($data['id']);
        $total = htmlspecialchars($data['total']);
        $email = htmlspecialchars($data['email']);
        $tanggal = date('d-m-Y');

        /* Update */
        $qryu = "UPDATE pemesanan SET
        status = '1',
        total_harga = '$total'
        WHERE id_pemesanan = '$id'";
                mysqli_query($this->con,$qryu);
        /* Tambah Data */
        $query = "INSERT INTO Pembelian VALUES('','$email','$id','$tanggal')";

        mysqli_query($this->con,$query);
        return mysqli_affected_rows($this->con);
    }
    function getpetugas(){
        $qry = mysqli_query($this->con, "SELECT * FROM user WHERE status = '1' or status = '2'");

        return $qry;
        
    }
    
    function tambahpetugas($data)
    {

        $email = stripslashes( $data['email']);
        $role = stripslashes( $data['role']);
        $password = mysqli_real_escape_string($this->con,$data['pass1']);
        $password2 = mysqli_real_escape_string($this->con,$data['pass2']);
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

        $result = mysqli_query($this->con,"SELECT email FROM user WHERE email ='$email'");

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

            mysqli_query($this->con,$query);

        }
        return mysqli_affected_rows($this->con);
    }

    function geteditpetugas($id)
    {
        $query = "SELECT * FROM user WHERE id_user = '$id'";
        $result = mysqli_query($this->con,$query);
        return $result;
    }


        
    function editpetugas($data)
    {
        $id = htmlspecialchars($data['id']);
        $email = stripslashes( $data['email']);
        $role = stripslashes( $data['role']);

        /* Update Data */
        $query = "UPDATE user SET
                email = '$email',
                status = '$role'
                WHERE id_user = '$id'";

        mysqli_query($this->con,$query);
        return mysqli_affected_rows($this->con);
    }    

    function hapuspetugas($id)
    {
        
        $query = "DELETE FROM user WHERE id_user = '$id'";
        $hapus = mysqli_query($this->con,$query);
        if($hapus)
        {   
            echo "
                <script>alert('Data Berhasil Dihapus');window.location.href = '../petugas/petugas.php';</script>
                ";
        }
    }
    


}



?>