<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>JYI</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <style>

    .bx-wrapper img {
            width: 100%;
            display: block;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="index.php" class="navbar-brand">
                    <img src="dist/img/jyilogo.png" alt="jyilogo Logo" class="brand-image img-circle elevation-3" style="opacity:.8"> 

                
                  <span class="#"> โรงเรียนจริยอิสลามศึกษาอนุสรณ์ </span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">



                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a href="login.php" class="navbar-brand">
                         <img src="dist/img/lg01.png" alt="lg01 Logo" class="#" style="opacity:.8">  

                  <!--      <a class="brand-text fonts brand-image" href="login.php"> -->
                          <!--  Login  -->
                        </a>

                    </li>
                    <!-- Notifications Dropdown Menu -->

                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
  
        <div class="content-wrapper">
            <div class="bxslider">
                <?php
                   include('./service/connections/connect.php');

                   $sql="select * from slider";
                   $data=getOfDB($sql);

                   foreach($data as $slider){
                ?>
                <div><img src="<?=$slider['image']?>"></div>
               
                <?php
                   }
                ?>
            </div>
            <div class="row">
                <?php
                    $contents=getOfDB("select * from contents");
                    foreach($contents as $content){
                        $url=false;
                        if($content['type']>3){
                            $url=true;
                           $content['type']=$content['type']-3;
                        }
                        
                        switch($content['type']){
                            case 1:
                            ?>
                              <div class="col-sm-6">
                                <?=$url?'<a href='.$content['url'].'>':''?>
                                <div class="card">
                                    <div class="card-header">
                                        <?=$content['topic']?>
                                    </div>
                                    <div class="card-body">
                                        <img src="<?=$content['image']?>" style="width:100%">
                                        <p>
                                            <?=$content['description']?>
                                        </p>
                                    </div>
                                </div>
                                <?=$url?'</a>':''?>
                            </div>
                            <?php
                            break;
                            case 2:
                                ?>
                                  <div class="col-sm-6">
                                  <?=$url?'<a href='.$content['url'].'>':''?>
                                    <div class="card">
                                        <div class="card-header">
                                            <?=$content['topic']?>
                                        </div>
                                        <div class="card-body">
                                            <p>
                                                <?=$content['description']?>
                                            </p>
                                            <img src="<?=$content['image']?>" style="width:100%">
                                            
                                        </div>
                                    </div>
                                    <?=$url?'</a>':''?>
                                </div>
                                <?php 
                                break;
                                case 3:
                                    ?>
                                      <div class="col-sm-6">
                                      <?=$url?'<a href='.$content['url'].'>':''?>
                                        <div class="card">
                                            <div class="card-header">
                                                <?=$content['topic']?>
                                            </div>
                                            <div class="card-body">
                                               <?=$content['data_html']?>
                                                <script>

                                                    console.log(<?=json_encode($content)?>)
                                                </script>
                                            </div>
                                        </div>
                                        <?=$url?'</a>':''?>
                                    </div>
                                    <?php 
                                    break;
                                   
                        }
                ?>
              
                <?php
                          
                        }
                ?>
            </div>
        </div>
      

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                
       โรงเรียนจริยอิสลามอนุสรณ์ ต. บ่อทอง  อ. หนองจิก จ. ปัตตานี

            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2019-2020 <a href="https://adminlte.io">JYI</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <script src="dist/js/jquery.bxslider.min.js"></script>
    <script>
                $(function(){
                    $('.bxslider').bxSlider({
                        auto: true,
                        autoControls: true,
                        stopAutoOnClick: true,
                        pager: true,
                    });
                    });
            </script>
</body>

</html>