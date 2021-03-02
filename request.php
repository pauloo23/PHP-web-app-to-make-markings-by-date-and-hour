<?phpheader('Content-Type: text/html; charset=utf-8');
session_start();
define('TITLE', 'Novo trabalho');
define('PAGE', 'request');
include('includes/header.php'); 
include('includes/dbConnection.php');

 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
?>

<?php 
  include('assignworkform.php');
  include('includes/footer.php'); 
  $conn->close();
?>