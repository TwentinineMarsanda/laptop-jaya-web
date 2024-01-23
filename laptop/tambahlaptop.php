
<?php 
session_start();
if(!isset($_SESSION['login']) ||  $_SESSION['status'] != '2')
{
    header("Location:../404.html");
    exit;
}
require '../asset/headeradmin.php';
require '../asset/sidebaradmin.php';
require '../asset/topbar.php';
include '../class_controller.php';
if(isset($_POST['submit']))
{
    $tambah = new laptop();
   
    if( $tambah->tambahlaptop($_POST))
    {
        echo "
        <script>alert('Data Berhasil Ditambahkan');window.location.href = '../laptop/laptop.php';</script>
        ";
    }
}
 ?>


       


<div class="container-fluid">
    
    <h1 class="h3 mb-4 text-gray-800">Tambah Laptop</h1>
   
    <form  action="" method="post" enctype="multipart/form-data">
        <div class="row">
        
                <div class="col-md-6">
                    <label for="exampleFormControlTextarea1">Gambar Laptop</label>
                    <div class="custom-file">
                        <input type="file" name="gambar" class="custom-file-input" id="inputGroupFile02">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Spesifikasi Laptop</label>
                            <textarea name="spesifikasi" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Laptop</label>
                        <input type="text" name="jenis" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Stok Laptop</label>
                        <input type="text" name="stok" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga Laptop</label>
                        <input type="text" name="harga" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                </div>
        </div>  
    </form>  
                 
                    

</div>

</div>

<script type="text/javascript">

    $('.custom-file input').change(function (e) {
        var files = [];
        for (var i = 0; i < $(this)[0].files.length; i++) {
            files.push($(this)[0].files[i].name);
        }
        $(this).next('.custom-file-label').html(files.join(', '));
    });

</script>      
<?php 

require '../asset/footeradmin.php';?>
