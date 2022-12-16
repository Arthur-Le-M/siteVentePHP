<?php 
session_start();

$id=$_GET['id'];
if(isset($_SESSION['cart'])){
    $_SESSION['cart'][] = $id;
}
else{
    $_SESSION['cart'] = [];
    $_SESSION['cart'][] = $id;
}

header('Location: index.php');
?>
?>