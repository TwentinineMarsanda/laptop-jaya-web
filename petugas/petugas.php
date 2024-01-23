
<?php 
session_start();
if(!isset($_SESSION['login']) || $_SESSION['status'] != '1')
{
    header("Location:../404.html");
    exit;
}
require '../asset/headeradmin.php';
require '../asset/sidebaradmin.php';
require '../asset/topbar.php';
include '../class_controller.php';
$petugas = new laptop();
$datas=$petugas->getpetugas($_POST);;
 ?>


       

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Admin</h1>
    <!-- Content Row -->
    <div class="row">

                         <!-- DataTales Example -->
                    <div class="card shadow mb-4 col-md-12">
                        <div class="card-header py-3">
                            <a class="btn btn-primary mt-3" href="../petugas/tambahpetugas.php" role="button">Tambah Admin</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while($row = mysqli_fetch_assoc($datas)): ?>
                                            <tr>
                                                <td><?= $row['email'] ; ?></td>
                                                <td>
                                                    <?php if($row['status'] =='1' ){ ?>
                                                        Super Admin
                                                    <?php } else if($row['status'] =='2' ){ ; ?>
                                                        Admin
                                                    <?php  } ?>
                                                    
                                                    
                                                </td>
                                                <td width='180'>
                                                     <a class="btn btn-success" href="../petugas/editpetugas.php?id=<?= $row['id_user'] ; ?>" role="button">Edit</a>

                                                     <a class="btn btn-danger" href="../petugas/deletepetugas.php?id=<?= $row['id_user'] ; ?>" role="button">Hapus</a>
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

            
<?php 

require '../asset/footeradmin.php';?>