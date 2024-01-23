<?php 
include '../class_controller.php';
session_start();
if(!isset($_SESSION['login']) ||  $_SESSION['status'] != '3')
{
    header("Location:../404.html");
    exit;
}
$id = $_GET['id'];

$laptop = new laptop();
$datas = $laptop->batalpesanan($id);

; ?>
