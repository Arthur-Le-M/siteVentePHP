<?php 
session_start();
$cart = $_SESSION['cart'];
print(json_encode($cart));
?>