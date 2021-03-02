<?php
session_start();
define('TITLE', 'Adicionar Cliente');
define('PAGE', 'technician');
include('includes/header.php'); 
include('includes/dbConnection.php');

 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
if(isset($_REQUEST['empsubmit'])){
 // Checking for Empty Fields
 if(($_REQUEST['empName'] == "") || ($_REQUEST['empMobile'] == "") || ($_REQUEST['empEmail'] == "")){
  // msg displayed if required field missing
  $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
 } else {
   // Assigning User Values to Variable
   $eName = $_REQUEST['empName'];
   $eMobile = $_REQUEST['empMobile'];
   $eEmail = $_REQUEST['empEmail'];
   $sql = "INSERT INTO technician_tb (empName, empMobile, empEmail) VALUES ('$eName', '$eMobile', '$eEmail')";
   if($conn->query($sql) == TRUE){
    // below msg display on form submit success
    $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Added Successfully </div>';
   } else {
    // below msg display on form submit failed
    $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add </div>';
   }
 }
 }
?>
<div class="content">
  <h3 class="text-center">Adicionar novo Cliente</h3>
  <form action="" method="POST">
    <div class="form-group">
      <label for="empName">Nome</label>
      <input type="text" class="form-control" id="empName" name="empName">
    </div>
   
    <div class="form-group">
      <label for="empMobile">Número Telemóvel</label>
      <input type="text" class="form-control" id="empMobile" name="empMobile" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="empEmail">Email</label>
      <input type="email" class="form-control" id="empEmail" name="empEmail">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-success" id="empsubmit" name="empsubmit">Adicionar</button>
      <a href="technician.php" class="btn btn-danger">Fechar</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
<!-- Only Number for input fields -->
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }
</script>
<?php
include('includes/footer.php'); 
?>