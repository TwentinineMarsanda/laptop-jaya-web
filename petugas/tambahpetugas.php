
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

if(isset($_POST['submit']))
{
    if($petugas->tambahpetugas($_POST))
    {
        echo "
        <script>alert('Data Berhasil Ditambahkan');window.location.href = '../petugas/petugas.php';</script>
        ";
    }
}
 ?>


       

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Kelas</h1>
    <!-- Content Row -->
    <form  action="" method="post" enctype="multipart/form-data">
        <div class="row">
        
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jenis Role</label>
                        <select name="role" class="form-control" id="exampleFormControlSelect1" required>
                            <option value="">Pilih Jenis Role</option>
                            <option value="1">Super Admin</option>
                            <option value="2">Admin</option>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="text" name="pass1" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                        
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Konfirm Password</label>
                        <input type="text" name="pass2" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
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