
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
$laptop = new laptop();
$datas = $laptop->getlaptop();
 ?>


       

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Laptop</h1>
    <!-- Content Row -->
    <div class="row">

                         <!-- DataTales Example -->
                    <div class="card shadow mb-4 col-md-12">
                        <div class="card-header py-3">
                            <a class="btn btn-primary mt-3" href="../laptop/tambahlaptop.php" role="button">Tambah Laptop</a>
                        </div>
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
                                        <?php foreach ($datas as $row): ?>
                                            <tr>
                                                <td><?= $row['jenis_laptop'] ; ?></td>
                                                <td><?= $row['harga'] ; ?></td>
                                                <td><?= $row['spesifikasi'] ; ?></td>
                                                <td><?= $row['stok'] ; ?></td>
                                                <td><img width="100" src="../img/laptop/<?= $row['gambar'] ; ?>" alt=""></td>
                                                <td width='180'>
                                                     <a class="btn btn-success" href="../laptop/editlaptop.php?id=<?= $row['id_laptop'] ; ?>" role="button">Edit</a>

                                                     <a class="btn btn-danger" href="../laptop/deletelaptop.php?id=<?= $row['id_laptop'] ; ?>" role="button">Hapus</a>
                                                     <div class="load"></div>
                                                </td>
                                            </tr>
                                        <?php endforeach ; ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                       
                    </div>

                 
                    

</div>
<!-- /.container-fluid -->
</div>

            
<?php 

require '../asset/footeradmin.php';?>