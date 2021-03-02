<?php
session_start();
define('TITLE', 'Clientes');
define('PAGE', 'technician');
include('includes/header.php'); 
include('includes/dbConnection.php');

 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
 
if(isset($_REQUEST['delete'])){
  $sql = "DELETE FROM technician_tb WHERE empid = {$_REQUEST['id']}";
  if($conn->query($sql) === TRUE){
    // echo "Record Deleted Successfully";
    // below code will refresh the page after deleting the record
    echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
      echo "Unable to Delete Data";
    }
  }
?>
<div class="content">
  <!--Table-->
  <p class=" bg-dark text-white p-2">Lista de clientes</p>    <div class="Input">

        <input type="text" name="searchclient" id="searchclient"
               placeholder="Procurar por nome cliente ou número telemóvel " >
  <div style="overflow-x:auto;" id="resultclient"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    </div>

      <script>
        $(document).ready(function () {

            load_data();

            function load_data(query) {
                $.ajax({
                    url: "fetchclient.php",
                    method: "POST",
                    data: {query: query},
                    success: function (data) {
                        $('#resultclient').html(data);
                    }
                });
            }

            $('#searchclient').keyup(function () {
                var searchclient = $(this).val();
                if (searchclient != '') {
                    load_data(searchclient);
                } else {
                    load_data();
                }
            });
        });
    </script>
 
</div>
</div>
<div><a class="btn btn-danger box" href="insertemp.php"><i class="fas fa-plus fa-2x"></i></a>
</div>
</div>

<?php
include('includes/footer.php'); 
?>