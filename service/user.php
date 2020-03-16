<?php
    session_start();
    include('./connections/connect.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST' || true){
        $type=1;
        if($_GET['type']){
            $type=$_GET['type'];
        }
    
        switch($type){
            case 1:
                getUser();
            break;
            case 2:
                insertUser();
            break;
            case 3:
                updateUser();
            break;
            case 4:
                deleteUser();
            break;
            case 5:
                getUserByID();
            break;
            case 6:
                checkUser();
            break;
            default:
                echo "{code:-1,message:'no action here'}";

        }
    }else{
        echo "{code:-1,message:'no action here'}";
    }
    function getUser(){
        $sql="SELECT * from users";
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    function getUserByID(){
        $username=e($_POST['username']);
        $sql="select * from users where sub_id='$username'";
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    function insertUser(){
       $username=e($_POST['username']);
       $password=e($_POST['password']);
       $first_name=e($_POST['first_name']);
       $last_name=e($_POST['last_name']);
      

       $sql="insert into users (username,password,first_name,last_name) values ('$username',SHA1('$password'),'$first_name','$last_name')";
       $result=execute($sql);
       if($result){
           echo json_encode([
               'code'=>1,
               'message'=>'ok'
           ]);
       }else{
           echo json_encode([
            'code'=>-1,
            'message'=>$sql
        ]);
       }
    }
    function updateUser(){
        $username=e($_POST['username']);
        $password=e($_POST['password']);
        $first_name=e($_POST['first_name']);
        $last_name=e($_POST['last_name']);
        $update_password=e($_POST['update_password']);
        if($update_password){
            $sql="update users set password=SHA1('$password'),first_name='$first_name',last_name='$last_name' where username='$username'";
        }else{
            $sql="update users set first_name='$first_name',last_name='$last_name' where username='$username'";
        }
        
        $result=execute($sql);
        if($result){
            if($_SESSION['username']==$username){
                $_SESSION['user']=$first_name.' '.$last_name;
            }
            echo json_encode([
                'code'=>1,
                'message'=>'ok'
            ]);
        }else{
            echo json_encode([
             'code'=>-1,
             'message'=>$sql
         ]);
        }
    }
    function deleteUser(){
        $username=e($_POST['username']);
        $sql="delete from users where username='$username'";
        $result=execute($sql);
        if($result){
            echo json_encode([
                'code'=>1,
                'message'=>'ok'
            ]);
        }else{
            echo json_encode([
                'code'=>-1,
                'message'=>$sql
            ]);
        }
    }
    function checkUser(){
        $username=e($_POST['username']);
        $sql="select * from users where username='$username'";
        if(count(getOfDB($sql))>0){
            echo 'false';
        }else{
            echo 'true';
        }
    }
?>