<?php
  session_start();
  
  if(isset($_GET['logout'])){
    $_SESSION['isLogginedIn']=false;
    $_SESSION['isLoggendTeacher']=false;
    // session_destroy();
   
  }
  
  if(!$_SESSION['isLogginedIn']&&!$_SESSION['isLoggendTeacher']){
    header('Location: ./viewer.php');
    exit;
  }


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Student Manage</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
  <!-- <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css"> -->
  <style>
    .nav-link{
      cursor: pointer;
    }
    *{
      font-family: 'Kanit', sans-serif;
    }
    .modal-content{
           border-radius: 0px;
    }

    .table{
      width:100% !important;
    }
    .modal-header {
      display: -ms-flexbox;
      display: flex;
      -ms-flex-align: start;
      align-items: flex-start;
      -ms-flex-pack: justify;
      justify-content: space-between;
      padding: 1.5rem;
      border-bottom: 1px solid #e9ecef;
      border-top-left-radius: 0rem;
      border-top-right-radius: 0rem;
      background: #17a2b8;
      color: white;
  }
    .close{
      color:rgba(255,255,255,0.7);
    }
    .close:hover{
      color:white;
    }
    .modal-header h4{
      font-size: 16pt;
      font-weight: bold;
    }
    .my-footer{
      float:right;
    }
    .link{
      cursor:pointer;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-info ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
     
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user"></i>
         
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?=$_SESSION['role']?></span>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item">
            <i class="fas fa-user mr-2"></i><?=$_SESSION['user']?>
           
          </a>
          <div class="dropdown-divider"></div>
          <a href="?logout=1" class="dropdown-item">
            <i class="fas fa-power-off mr-2"></i> Logout
          </a>
         
        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4 nav-child-indent">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Student Master</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$_SESSION['user']?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a data-href="./dashboard.php" class="nav-link active">
                  <i class="fas fa-tachometer-alt nav-icon"></i>
                  <p>หน้าสรุปข้อมูล</p>
                </a>
              </li>
         <?php
         if($_SESSION['isLogginedIn']){
         ?>
           <li class="nav-item has-treeview ">
            <a class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                ข้อมูลทั่วไป
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a data-href="./student.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูลนักเรียน</p>
                </a>
              </li>
              <li class="nav-item">
                <a data-href="./teacher.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูลอาจารย์</p>
                </a>
              </li>
              <li class="nav-item">
                <a data-href="./subject.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูลวิชา</p>
                </a>
              </li>
              <li class="nav-item">
                <a data-href="./room.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูลห้องเรียน</p>
                </a>
              </li>
              
            </ul>
          </li>
         
         
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                จัดการข้อมูลการศึกษา
                <i class="fas fa-angle-left right"></i>
           
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a data-href="./study/class.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูลกลุ่มนักเรียน</p>
                </a>
              </li>
              <li class="nav-item">
                <a data-href="./study/teaching.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูลตารางเรียน</p>
                </a>
              </li>
          
            </ul>
          </li>
          <?php
        }
         ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                ดูรายการข้อมูล
                <i class="fas fa-angle-left right"></i>
           
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a data-href="./searching/table-study.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ตารางเรียน</p>
                </a>
              </li>
              <li class="nav-item">
                <a data-href="./searching/table-teaching.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ตารางสอน</p>
                </a>
              </li>
          
            </ul>
          </li>
          <?php
            if($_SESSION['isLoggendTeacher']){
              ?>
                 <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                ข้อมูลการศึกษา
                <i class="fas fa-angle-left right"></i>
           
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a data-href="./study/class.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูลกลุ่มนักศึกษา</p>
                </a>
              </li>
              <li class="nav-item">
                <a data-href="./study/view-grade.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ตัดเกรดตามวิชา</p>
                </a>
              </li>
             
            </ul>
          </li>
              <?php
            }
          ?>
         
          <?php
            if($_SESSION['isLogginedIn']){
            ?>
               <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                จัดการหน้าเว็บ content
                <i class="fas fa-angle-left right"></i>
           
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a data-href="./slider.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>รูป slider</p>
                </a>
              </li>
              <li class="nav-item">
                <a data-href="./content.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูลเพิ่มเติ่ม</p>
                </a>
              </li>
             
            </ul>
          </li>
            <?php
            }
          ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="content-wrapper">
    
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2020 <a href="http://adminlte.io">Sudent Master</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- <script src="plugins/summernote/summernote-bs4.min.js"></script> -->
<script>
  var service={
    url:'/student/service/'
  }
  $(document).ready(function(){
    $('.nav-link').click(function(){
      console.log($(this).data('href'))
      if($(this).data('href')){
        $('#content-wrapper').load($(this).data('href'));
        $('.nav-link').removeClass('active');
        $(this).addClass('active')
      }
    })
    $('#content-wrapper').load('./dashboard.php');
    $('.has-treeview').click(function(){
      var menu= $('.has-treeview');
      // menu.removeClass('menu-open');
      menu.removeClass('active');
      for(var i=0;i<menu.length;i++){
        $($($('.has-treeview')[i]).children()[0]).removeClass('active');
        // $($('.has-treeview')[i]).removeClass('menu-open');
      }
    //  alert(11);
      // $(this).addClass('menu-open');
      $($(this).children()[0]).addClass('active');
    })
  });
  function postData(url,data){
      return $.ajax({
            url: '/student/'+url,
            type: "post",
            dataType: "json",
            data: data
      })
  }
</script>
</body>
</html>
<?php
  session_write_close();
?>