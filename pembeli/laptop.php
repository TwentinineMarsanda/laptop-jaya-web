
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
$laptop = new laptop();
$datas = $laptop->getlaptoppembeli();
 ?>


       

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Stok Laptop</h1>
    <!-- Content Row -->
    <div class="row">

                         <!-- DataTales Example -->
                    <div class="card shadow mb-4 col-md-12">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Jenis Laptop</th>
                                            <th>Harga</th>
                                            <th>Spesifikasi</th>
                                            <th>Stok</th>
                                            <th>Gambar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Jenis Laptop</th>
                                            <th>Harga</th>
                                            <th>Spesifikasi</th>
                                            <th>Stok</th>
                                            <th>Gambar</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while($row = mysqli_fetch_assoc($datas)): ?>
                                            <tr>
                                                <td><?= $row['jenis_laptop'] ; ?></td>
                                                <td><?= $row['harga'] ; ?></td>
                                                <td><?= $row['spesifikasi'] ; ?></td>
                                                <td><?= $row['stok'] ; ?></td>
                                                <td><img width="100" src="../img/laptop/<?= $row['gambar'] ; ?>" alt=""></td>
                                                <td>
                                                    <a class="btn btn-primary" href="../pembeli/beli.php?id=<?= $row['id_laptop'] ; ?>" role="button">Pesan</a>
                                                     <div class="load"></div>
                                                </td>
                                            </tr>
                                        <?php endwhile ; ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                       
                    </div>

                 
                    

</div>
<!-- /.container-fluid -->
</div>

            
<?php require '../asset/footeradmin.php';?>