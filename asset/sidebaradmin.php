
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">


<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laptop"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Laptop Jaya</div>
</a>


<hr class="sidebar-divider my-0">

<?php if($_SESSION['status'] == '2') { ?>
    
    <li class="nav-item">
        <a class="nav-link" href="../admin/dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    
    <hr class="sidebar-divider">
    
    <li class="nav-item">
        <a class="nav-link" href="../laptop/laptop.php">
            <i class="fas fa-fw fa-laptop"></i>
            <span>Data Laptop</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../pembelian/pembelian.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Pembelian</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../pembelian/pemesanan.php">
            <i class="fas fa-fw fa-book"></i>
            <span>Data Pemesanan</span></a>
    </li>
<?php } 
else if($_SESSION['status'] == '1') {?>
    <li class="nav-item">
        <a class="nav-link" href="../petugas/petugas.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Petugas</span></a>
    </li>
<?php }else if($_SESSION['status'] == '3') {?>
    <li class="nav-item">
        <a class="nav-link" href="../pembeli/Laptop.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Laptop</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../pembeli/pesanan.php">
            <i class="fas fa-fw fa-book"></i>
            <span>Data Pesanan</span></a>
    </li>
<?php }; ?>





<hr class="sidebar-divider">
 
</ul>
