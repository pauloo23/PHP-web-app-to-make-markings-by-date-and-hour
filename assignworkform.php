<?php    
if(session_id() == '') {
  session_start();
 
}
if(isset($_SESSION['is_adminlogin'])){
 $aEmail = $_SESSION['aEmail'];
} else {
 echo "<script> location.href='login.php'; </script>";
}
 if(isset($_REQUEST['view'])){
  $sql = "SELECT * FROM submitrequest_tb WHERE request_id = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }    
    
 //  Assign work Order Request Data going to submit and save on db assignwork_tb table
 if(isset($_REQUEST['assign'])){
    

     // Checking for Empty Fields
  if(($_REQUEST['request_info'] == "") || ($_REQUEST['requestdesc'] == "") || ($_REQUEST['requestername'] == "") || ($_REQUEST['requesteremail'] == "")|| ($_REQUEST['inputdate'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';

  } else {
    // Assigning User Values to Variable

    $rinfo = $_REQUEST['request_info'];
    $rdesc = $_REQUEST['requestdesc'];
    $rname = $_REQUEST['requestername'];
    $remail = $_REQUEST['requesteremail'];
    $remail2 = $_REQUEST['requesteremail2'];

    $sql = "SELECT empMobile from technician_tb WHERE empName = '$rname'";    $result = $conn->query($sql);    $row = mysqli_fetch_row($result);    $rmobile = $row[0];


    $rdate = $_REQUEST['inputdate'];
    $rduration = $_REQUEST['requesterduration'];
    $remail = $remail . $remail2;        if($rmobile == "") {
            $rmobile = 999999999;
            }
    echo $remail;
    try {
    $sql = "INSERT INTO assignwork_tb ( request_info, request_desc, requester_name, requester_hour, requester_mobile,assign_date, requester_duration) VALUES ( '$rinfo','$rdesc', '$rname','$remail', '$rmobile', '$rdate','$rduration')";
} catch(Exception $ex) {
   echo $ex;
}




      if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Trabalho adicionado com sucesso! </div>';
    echo "<script> location.href='work.php'; </script>";
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Falha ao adicionar trabalho! </div>';   
    }
  }
  }
  
 // Assign work Order Request Data going to submit and save on db assignwork_tb table [END]
 ?>
<div class="content" style="padding-top: 5vh;">
  <!-- Main Content area Start Last -->
  <form action="" method="POST">
    <h5 class="text-center">Efetuar nova marcação</h5>
    <div class="form-group">
      <label for="request_id">Identificador</label>
      <input  type="text" class="form-control" id="request_id" name="request_id" value="<?php if(isset($row['request_id'])) {echo $row['request_id']; }?>" readonly>
    </div>
    <div class="form-group">
      <label for="request_info">Tipo Trabalho*</label>
      <input type="text" class="form-control" id="request_info" name="request_info" value="">
    </div>
    <div class="form-group">
      <label for="requestdesc">Descrição</label>
      <input type="text" class="form-control" id="requestdesc" name="requestdesc" value="<?php if(isset($row['request_desc'])) { echo $row['request_desc']; } ?>">
    </div>
    <div class="form-group">
      <label for="requestername">Nome Cliente</label>
   <?php$s = mysqli_query($conn, "Select * from technician_tb order by empName");
   ?>
   <select id="requestername" class="form-control" name="requestername" value="<?php if(isset($row['requester_name'])) {echo $row['requester_name']; }?>">
   <?php
   while($r = mysqli_fetch_array($s))
   {
   ?>
   <option><?php echo $r['empName']; ?> </option>
   
   <?php
   }
   ?>
   </select>
    </div>   



    <div class="form-group from-row row">
    
    <div class="col-sm">
      
        <label for="requesteremail">Hora</label>
      
      <select id="requesteremail" class="form-control" name="requesteremail" value="<?php if(isset($row['requester_hour'])) {echo $row['requester_hour']; }?>">
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
         <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
    </select>
    </div>
    
      
      
      <div class="col-sm">
     
        <label for="requesteremail">Minutos</label>
        <select id="requesteremail2" class="form-control" name="requesteremail2" value="<?php if(isset($row['requester_hour'])) {echo $row['requester_hour']; }?>">
        <option value=":00">00</option>
        <option value=":05">05</option>
        <option value=":10">10</option>
        <option value=":15">15</option>
        <option value=":20">20</option>
         <option value=":25">25</option>
        <option value=":30">30</option>
        <option value=":35">35</option>
        <option value=":40">40</option>
        <option value=":45">45</option>
        <option value=":50">50</option>
         <option value=":55">55</option>
    </select>
      </div>
      
   
        <div class="col-sm">
            
            <label for="requestermobile">Duração em minutos</label>
             <select id="requesterduration" class="form-control" name="requesterduration" value="<?php if(isset($row['requester_duration'])) {echo $row['requester_duration']; }?>"
        <option value="0">Select initial</option>
        <option value="15">15</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
    </select>
        </div>
       

        <div class="col-sm3">
        <label for="inputDate">Data</label>
        <input type="date" class="form-control" id="inputDate" name="inputdate">
      </div>
     </div>
    <div class="form-group">
    <div class="float-right">
      <button type="submit" class="btn btn-success " name="assign">Guardar</button>
      <button type="reset" class="btn btn-secondary ">Reset</button>
    </div>
  </form>
  <!-- below msg display if required fill missing or form submitted success or failed -->
  <?php if(isset($msg)) {echo $msg; } ?>
</div> <!-- Main Content area End Last -->

<!-- Only Number for input fields -->
<script>

</script>