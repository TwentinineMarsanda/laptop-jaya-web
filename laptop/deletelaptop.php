<?php 
  include '../class_controller.php';
session_start();
if(!isset($_SESSION['login']) ||  $_SESSION['status'] != '2')
{
    header("Location:../404.html");
    exit;
}
$id = $_GET['id'];
$delete = new laptop();
$delete->hapuslaptop($id)
; ?>
