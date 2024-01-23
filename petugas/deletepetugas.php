<?php 
include '../class_controller.php';
session_start();
if(!isset($_SESSION['login']) || $_SESSION['status'] != '1')
{
    header("Location:../404.html");
    exit;
}
$id = $_GET['id'];

$petugas = new laptop();
$datas=$petugas->hapuspetugas($id);;
; ?>
