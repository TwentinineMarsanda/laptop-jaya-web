
<?php 
session_start();
if(!isset($_SESSION['login']) ||  $_SESSION['status'] != '3')
{
    header("Location:../404.html");
    exit;
}
require '../asset/headeradmin.php';
require '../asset/sidebaradmin.php';
require '../asset/topbar.php';
include '../class_controller.php';
$id = $_GET['id'];
$laptop = new laptop();
$datas = $laptop->getlaptopbeli($id);
if(isset($_POST['submit']))
{
    if($laptop->beli($_POST))
    {
        echo "
        <script>alert('Pembelian Berhasil, Silakan Lakukan pembayaran ke toko');window.location.href = '../pembeli/pesanan.php';</script>
        ";
    }
}
 ?>


       

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Pesanan</h1>
    <!-- Content Row -->
    <form  action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <?php while($row = mysqli_fetch_assoc($datas)): ?>
                <div class="col-md-6">
                    <input type="hidden" name="id" value="<?= $row['id_laptop'] ?>">
                    <input type="hidden" name="harga" value="<?= $row['harga'] ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Laptop</label>
                        <input required readonly name="jenis" class="form-control" id="exampleInputEmail1"  placeholder="<?= $row['jenis_laptop'] ; ?>/ <?= $row['harga'] ; ?>" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Beli</label>
                        <input required type="number" min="1" name="jumlah" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email Pembeli</label>
                        <input required readonly name="email" class="form-control" id="exampleInputEmail1" value="<?php echo $_SESSION['email'] ; ?>" aria-describedby="emailHelp">
                    </div>
                    
                </div>
           <?php endwhile ; ?>
                
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