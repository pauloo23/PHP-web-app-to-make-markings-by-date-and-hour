<?php    
session_start();
define('TITLE', 'Sell Product');
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
  if(($_REQUEST['cname'] == "") || ($_REQUEST['pname'] == "") || ($_REQUEST['pquantity'] == "") || ($_REQUEST['psellingcost'] == "") || ($_REQUEST['totalcost'] == "") || ($_REQUEST['selldate'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    // Assigning User Values to Variable for update
    $pid = $_REQUEST['pid'];
    $pava = ($_REQUEST['pava'] - $_REQUEST['pquantity']);

    // Assigning User Values to Variable for insert
    $custname = $_REQUEST['cname'];
    $cpname = $_REQUEST['pname'];
    $cpquantity = $_REQUEST['pquantity'];
    $cpeach = $_REQUEST['psellingcost'];
    $cptotal = $_REQUEST['totalcost'];
    $cpdate = $_REQUEST['selldate'];
    $sqlin = "INSERT INTO customer_tb(custname, cpname, cpquantity, cpeach, cptotal, cpdate) VALUES ('$custname','$cpname', '$cpquantity', '$cpeach', '$cptotal', '$cpdate')";
    if($conn->query($sqlin) == TRUE){
      // below function captures inserted id
      $genid = mysqli_insert_id($conn);
      session_start();
      $_SESSION['myid'] = $genid;
      echo "<script> location.href='productsellsuccess.php'; </script>";
    } 
    // Updating Assest data for available product after sell
    $sql = "UPDATE assets_tb SET pava = '$pava' WHERE pid = '$pid'";
    $conn->query($sql);
  }
}
 ?>
<div class="content"
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Emissão de venda de produto</h3>
  <?php
 if(isset($_REQUEST['issue'])){
  $sql = "SELECT * FROM assets_tb WHERE pid = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
  <form action="" method="POST">
    <div class="form-group">
      <label for="pid">Identificador de Produto</label>
      <input type="text" class="form-control" id="pid" name="pid" value="<?php if(isset($row['pid'])) {echo $row['pid']; }?>"
        readonly>
    </div>
    <div class="form-group">
      <label for="cname">Nome do Cliente</label>
      <input type="text" class="form-control" id="cname" name="cname">
    </div>

    <div class="form-group">
      <label for="pname">Nome do produto</label>
      <input type="text" class="form-control" id="pname" name="pname" value="<?php if(isset($row['pname'])) {echo $row['pname']; }?>">
    </div>
    <div class="form-group">
      <label for="pava">Quantidade disponível</label>
      <input type="text" class="form-control" id="pava" name="pava" value="<?php if(isset($row['pava'])) {echo $row['pava']; }?>"
        readonly onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="pquantity">Quantidade</label>
      <input type="text" class="form-control" id="pquantity" name="pquantity" >
    </div>
    <div class="form-group">
      <label for="psellingcost">Preço de cada</label>
      <input type="text" class="form-control" id="psellingcost" name="psellingcost" value="<?php if(isset($row['psellingcost'])) {echo $row['psellingcost']; }?>">
    </div>
    <div class="form-group">
      <label for="totalcost">Valor Total</label>
      <input type="text" class="form-control" id="totalcost" name="totalcost">
    </div>
    <div class="form-group col-md-4">
      <label for="inputDate">Data</label>
      <input type="date" class="form-control" id="inputDate" name="selldate">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="psubmit" name="psubmit">Submit</button>
      <a href="assets.php" class="btn btn-secondary">Close</a>
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