<?php
  session_start();
  include('./service/connections/connect.php');
  $fail=false;
  if(isset($_POST['username'])){
    $username=e($_POST['username']);
    $password=e($_POST['password']);
    $sql="select * from users where username='$username' and password=SHA1('$password')";

    $data=getOfDB($sql);
    $fail=false;
    if(count($data)>0){
      $data=$data[0];
      $_SESSION['username']=$data['username'];
      $_SESSION['user']=$data["first_name"].' '.$data['last_name'];
      $_SESSION['role']='admin';
      $_SESSION['isLogginedIn']=true;
      $_SESSION['isLoggendTeacher']=false;
      // $_SESSION['image']=$data['image'];
      header('Location: ./index.php');
      
  // $_SESSION['image']='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';
    }else{
      $sql="select * from teachers where teacher_id='$username' and password=SHA1('$password')";
      $data=getOfDB($sql);
      if(count($data)>0){
        $data=$data[0];
        $_SESSION['username']=$data['teacher_id'];
        $_SESSION['user']=$data['first_name']." ".$data['last_name'];
        $_SESSION['isLogginedIn']=false;
        header('Location: ./index.php');
        $_SESSION['role']="teacher";
        $_SESSION['isLoggendTeacher']=true;
        $_SESSION['image']=$data['image'];
        header('Location: ./index.php');
      }else{
        $fail=true;
      }
      
    }

  };
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
  <style>
    *{
      font-family: 'Kanit', sans-serif !important;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html">Student Master</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="./login.php" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     
      <!-- /.social-auth-links -->

    
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php
  if($fail){
    ?>
      <script>
        Swal.fire('','invalid username or password','error');
        
      </script>
    <?php
  }
  session_write_close();
?>
</body>
</html>
