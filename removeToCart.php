<?php
$id = $_GET['id'];
session_start();

if(isset($_SESSION['cart'])){
    unset($_SESSION['cart'][array_search($id, $_SESSION['cart'])]);
    sort($_SESSION['cart']);
}
header('Location: cart.php');
?>