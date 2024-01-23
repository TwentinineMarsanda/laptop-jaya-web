
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

$id = $_GET['id'];
$lpt = new laptop();
$row = $lpt->geteditlaptop($id); 
if(isset($_POST['submit']))
{
    if($lpt->editlaptop($_POST))
    {
        echo "
        <script>alert('Data Berhasil Diedit');window.location.href = '../laptop/laptop.php';</script>
        ";
    }
}


 ?>


       

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Laptop</h1>
    <!-- Content Row -->
   
        <form  action="" method="post" enctype="multipart/form-data">
            <div class="row">
            
                    <div class="col-md-6">
                        <label for="exampleFormControlTextarea1">Gambar Laptop</label>
                        <input type="hidden" name="id" value="<?= $row['id_laptop'] ; ?>">
                        <input type="hidden" name="gambarlama" value="<?= $row['gambar'] ; ?>">
                        <div class="custom-file">
                            <input type="file" name="gambar" class="custom-file-input" id="inputGroupFile02" >
                            <label class="custom-file-label" for="customFile" >Choose file</label>
                        </div>
                        <img width="200" src="../img/laptop/<?= $row['gambar'] ; ?>" alt="">

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Spesifikasi Laptop</label>
                            <textarea name="spesifikasi" class="form-control" id="exampleFormControlTextarea1" rows="3"  required><?= $row['spesifikasi'] ; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Laptop</label>
                            <input type="text" name="jenis" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $row['jenis_laptop'] ; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Stok Laptop</label>
                            <input type="number" name="stok" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $row['stok'] ; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga Laptop</label>
                            <input type="text" name="harga" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $row['harga'] ; ?>" required>
                        </div>
                        
                        <button type="submit" name="submit" class="btn btn-primary">Edit</button>
                        
                    </div>
            </div>  
        </form>  
    
                 
                    

</div>
<!-- /.container-fluid -->
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