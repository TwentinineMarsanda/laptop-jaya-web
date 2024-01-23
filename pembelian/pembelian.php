
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
$pembelian = new laptop();
$datas = $pembelian->getpembelian();
 ?>


       

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Pembelian</h1>
    <!-- Content Row -->
    <div class="row">

                        
                    <div class="card shadow mb-4 col-md-12">
                        <div class="card-header py-3">
                           
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Jenis Laptop</th>
                                            <th>Jumlah</th>
                                            <th>Total Harga</th>
                                            <th>Tanggal Pemesanan</th>
                                            <th>Nama Pembeli</th>
                                            <th>Tanggal Bayar</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Jenis Laptop</th>
                                            <th>Jumlah</th>
                                            <th>Total Pemesanan</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pembeli</th>
                                            <th>Tanggal Bayar</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while($row = mysqli_fetch_assoc($datas)): ?>
                                            <tr>
                                                <td><?= $row['jenis_laptop'] ; ?></td>
                                                <td><?= $row['jumlah'] ; ?></td>
                                                <td><?= $row['total_harga'] ; ?></td>
                                                <td><?= $row['tanggal'] ; ?></td>
                                                <td><?= $row['nama_pembeli'] ; ?></td>
                                                <td><?= $row['tgl_bayar'] ; ?></td>
                                            </tr>
                                        <?php endwhile ; ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                       
                    </div>

                 
                    

</div>

</div>

            
<?php 

require '../asset/footeradmin.php';?>
