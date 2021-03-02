<?php
session_start();
define('TITLE', 'Work Today');
define('PAGE', 'worktoday');
include('includes/header.php');
include('includes/dbConnection.php');

if (isset($_SESSION['is_adminlogin'])) {
    $aEmail = $_SESSION['aEmail'];
} else {
    echo "<script> location.href='login.php'; </script>";
}
if (isset($_REQUEST['delete'])) {
    $sql = "DELETE FROM assignwork_tb WHERE request_id = {$_REQUEST['id']}";
    if ($conn->query($sql) === TRUE) {
        // echo "Record Deleted Successfully";
        // below code will refresh the page after deleting the record
        echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
        echo "Unable to Delete Data";
    }
}
if (isset($_REQUEST['finish'])) {
    $sql = "UPDATE assignwork_tb
            SET request_state='1'
            WHERE request_id = {$_REQUEST['id']}";
    if ($conn->query($sql) === TRUE) {
        // echo "Success alteration ";
        // below code will refresh the page after deleting the record
        echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
        echo "Unable to modify";
    }
}

?>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


<?php
include('includes/footer.php');
?>

<div class="content">
    <div class="Input">

        <input type="text" name="search_work" id="search_work"
               placeholder="Procurar por nome cliente, número telemóvel ou data"></div>
    <div>

    <div style="overflow-x:auto;" id="resultwork"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    </div>
</div>
    <script>
        $(document).ready(function () {

            load_data();

            function load_data(query) {
                $.ajax({
                    url: "fetch3.php",
                    method: "POST",
                    data: {query: query},
                    success: function (data) {
                        $('#resultwork').html(data);
                    }
                });
            }

            $('#search_work').keyup(function () {
                var searchwork = $(this).val();
                if (searchwork != '') {
                    load_data(searchwork);
                } else {
                    load_data();
                }
            });
        });
    </script>
</div>
</div>
<a class="btn btn-danger box" href="request.php"><i class="fas fa-plus fa-2x"></i></a>
</div>