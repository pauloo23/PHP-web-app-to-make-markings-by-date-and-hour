<!DOCTYPE html>
<html lang="en">

<head><meta charset="utf-8" />
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">

 <title>
  <?php echo TITLE ?>
 </title>
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sidebar.css">

 <!-- Font Awesome CSS -->
 <link rel="stylesheet" href="../css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
 <!-- Custom CSS -->
 <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/input_text.css">
        <link rel="stylesheet" href="../css/grid.scss">
</head>
<body>



<!--header area start-->
<header style="background:black;">

    <label class="menu"for="check">
        <i class="fas fa-bars"  id="sidebar_btn"></i>
    </label>

    <div class="right_area">
        <a href="../logout.php" class="logout_btn" style="padding-top: 10px;">Logout</a>
    </div>

</header>
<!--header area end-->
<!--mobile navigation bar start-->

<div class="mobile_nav">
    <div class="nav_bar">
        <img src="https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fwebneel.com%2Fdaily%2Fsites%2Fdefault%2Ffiles%2Fimages%2Fdaily%2F06-2013%2F21-beautiful-women-photography.preview.jpg&f=1&nofb=1" class="mobile_profile_image" alt="">
        <i class="fa fa-bars nav_btn"></i>
    </div>
    <div class="mobile_nav_items">    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <a class=" <?php if(PAGE == 'dashboard') { echo 'active'; } ?> " href="dashboard.php"><i class="fa fa-home fa-fw"></i><span>Página Inicial</span></a>
        <a class=" <?php if(PAGE == 'worktoday') { echo 'active'; } ?>" href="worktoday.php"><i class="fa fa-book fa-fw"></i><span> Marcações de Hoje</span></a>
        <a class="<?php if(PAGE == 'work') { echo 'active'; } ?>" href="work.php"><i class="fa fa-book fa-fw"></i><span>Marcações</span></a>
        <a class=" <?php if(PAGE == 'workdone') { echo 'active'; } ?>" href="workdone.php"><i class="fas fa-check-circle fa-1x"></i><span>Trabalhos Completados</span></a>
        <a class="<?php if(PAGE == 'request') { echo 'active'; } ?>" href="request.php"><i class="fa fa-plus-square"></i><span> Efetuar Marcação</span></a>
        <a class=" <?php if(PAGE == 'assets') { echo 'active'; } ?>" href="assets.php"><i class="fas fa-database"></i><span>Inventário</span></a>        <a class=" <?php if(PAGE == 'assets') { echo 'active'; } ?>" href="technician.php"><i class="fas fa-users"></i><span>Clientes</span></a>
        <a class="<?php if(PAGE == 'changepass') { echo 'active'; } ?>" href="changepass.php"><i class="fa fa-cog fa-fw"></i><span>Definições</span></a>
    </div>
</div>
 <!--mobile navigation bar end-->
 <!--sidebar start-->
 <div class="sidebar" style="height:100%; position:left; overflow:hidden; margin-top: 0px; background:black;">
     <div class="profile_info">
         <img src="https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fwebneel.com%2Fdaily%2Fsites%2Fdefault%2Ffiles%2Fimages%2Fdaily%2F06-2013%2F21-beautiful-women-photography.preview.jpg&f=1&nofb=1" class="profile_image" alt="">
         <h4>Rosa</h4>
     </div>
     <a class=" <?php if(PAGE == 'dashboard') { echo 'active'; } ?> " href="dashboard.php">
     <i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp;
         Página Inicial
     </a>
     <a class=" <?php if(PAGE == 'worktoday') { echo 'active'; } ?>" href="worktoday.php">
        <i class="fa fa-book fa-fw" aria-hidden="true"></i>&nbsp;
         Marcações de Hoje
     </a>
     <a class="<?php if(PAGE == 'work') { echo 'active'; } ?>" href="work.php">
        <i class="fa fa-book fa-fw" aria-hidden="true"></i>&nbsp;
         Marcações
     </a>
     <a class=" <?php if(PAGE == 'workdone') { echo 'active'; } ?>" href="workdone.php">
         <i class="fas fa-check-circle fa-1x"></i>
         Trabalhos Completos
     </a>
     <a class="<?php if(PAGE == 'request') { echo 'active'; } ?>" href="request.php">
         <i class="fa fa-plus-square" aria-hidden="true"></i>


         Efetuar Marcação
     </a>
     <a class=" <?php if(PAGE == 'assets') { echo 'active'; } ?>" href="assets.php">
         <i class="fas fa-database"></i>
         Inventário
     </a>        <a class=" <?php if(PAGE == 'assets') { echo 'active'; } ?>" href="technician.php">
         <i class="fas fa-users"></i>
         Clientes
     </a>
     <a style =""class="<?php if(PAGE == 'changepass') { echo 'active'; } ?>" href="changepass.php">
       <i class="fa fa-cog fa-fw" aria-hidden="true"></i>&nbsp; 
         Definições
     </a>


        
 </div>
 <!--sidebar end-->


<script type="text/javascript">
    $(document).ready(function(){
        $('.nav_btn').click(function(){
            $('.mobile_nav_items').toggleClass('active');
        });
    });
</script>