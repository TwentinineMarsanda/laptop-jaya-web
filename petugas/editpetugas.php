
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


$id = $_GET['id'];
$petugas = new laptop();
$datas=$petugas->geteditpetugas($id);;
if(isset($_POST['submit']))
{
    if($petugas->editpetugas($_POST))
    {
        echo "
        <script>alert('Data Berhasil Diedit');window.location.href = '../petugas/petugas.php';</script>
        ";
    }
}


 ?>


       

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Admin</h1>
    <!-- Content Row -->
    <?php while($row = mysqli_fetch_assoc($datas)): ?>
        <form  action="" method="post" enctype="multipart/form-data">
            <div class="row">
            
            <div class="col-md-6">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $row['id_user']?>">
                        <label for="exampleFormControlSelect1">Jenis Role</label>
                        <select name="role" class="form-control" id="exampleFormControlSelect1" required>

                                <?php if($row['status'] == '2') { ?>
                                    <option value="2">Admin</option>
                                    <option value="1">Super Admin</option>
                                <?php } 
                                else if($row['status'] == '1') {?>
                                    <option value="1">Super Admin</option>
                                    <option value="2">Admin</option>
                                <?php 
                                }; ?>
                            
      
                            
                        </select>
                    </div>
                        
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"required value="<?= $row['email']?>">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>  
        </form>  
    <?php endwhile ; ?>
    
                 
                    

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