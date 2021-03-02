<?phpheader('Content-Type: text/html; charset=utf-8');
session_start();
define('TITLE', 'Adicionar novo Produto');
define('PAGE', 'assets');
include('includes/header.php'); 
include('includes/dbConnection.php');

 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
if(isset($_REQUEST['psubmit'])){
 // Checking for Empty Fields
 if(($_REQUEST['pname'] == "") || ($_REQUEST['pdop'] == "") || ($_REQUEST['pava'] == "")  || ($_REQUEST['poriginalcost'] == "") || ($_REQUEST['psellingcost'] == "")){
  // msg displayed if required field missing
  $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
 } else {
  // Assigning User Values to Variable
  $pname = $_REQUEST['pname'];
  $pdop = $_REQUEST['pdop'];
  $pava = $_REQUEST['pava'];
  $poriginalcost = $_REQUEST['poriginalcost'];
  $psellingcost = $_REQUEST['psellingcost'];
   $sql = "INSERT INTO assets_tb (pname, pdop, pava, ptotal, poriginalcost, psellingcost) VALUES ('$pname', '$pdop','$pava', '$pava', '$poriginalcost', '$psellingcost')";
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

  <h3 class="text-center">Adicionar novo produto</h3>
  <form action="" method="POST">
    <div class="form-group">
      <label for="pname">Nome do produto</label>
      <input type="text" class="form-control" id="pname" name="pname">
    </div>
    <div class="form-group">
      <label for="pdop">Data da Compra</label>
      <input type="date" class="form-control" id="pdop" name="pdop">
    </div>
    <div class="form-group">
      <label for="pava">Quantidade disponível</label>
      <input type="text" class="form-control" id="pava" name="pava" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="poriginalcost">Preço de custo</label>
      <input type="text" class="form-control" id="poriginalcost" name="poriginalcost" ">
    </div>
    <div class="form-group">
      <label for="psellingcost">Preço de venda</label>
      <input type="text" class="form-control" id="psellingcost" name="psellingcost" >
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-success" id="psubmit" name="psubmit">Guardar</button>
      <a href="assets.php" class="btn btn-danger">Fechar</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
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