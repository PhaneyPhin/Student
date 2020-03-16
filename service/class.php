<?php
    include('./connections/connect.php');
    session_start();
    if($_SERVER['REQUEST_METHOD'] === 'POST' || true){
        $type=1;
        if($_GET['type']){
            $type=$_GET['type'];
        }
    
        switch($type){
            case 1:
                getClass();
            break;
            case 2:
                insertClass();
            break;
            case 3:
                updateClass();
            break;
            case 4:
                deleteClass();
            break;
            case 5:
                getClassByID();
            break;
            default:
                echo "{code:-1,message:'no action here'}";

        }
    }else{
        echo "{code:-1,message:'no action here'}";
    }
    function getClass(){
      
        if($_SESSION['isLoggendTeacher']){
            $sql="SELECT c.* from class c
                    inner join teaching t on c.class_id=t.class_id
                    where t.teacher_id='".$_SESSION['username']."'
                ";
        }else{
            $sql="SELECT * from class 
                ";
        }
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    function getClassByID(){
        $class_id=e($_POST['class_id']);
        $sql="select * from class where class_id='$class_id'";
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    function insertClass(){
       $year=e($_POST['year']);
       $term=e($_POST['term']);
       $grade=e($_POST['grade']);
       $class_name=e($_POST['class_name']);

       $sql="insert into class (year,term,grade,class_name) values ('$year','$term','$grade','$class_name')";
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
    function updateClass(){
        $class_id=e($_POST['class_id']);
        $year=e($_POST['year']);
        $term=e($_POST['term']);
        $grade=e($_POST['grade']);
        $class_name=e($_POST['class_name']);
        $sql="update class set year='$year',term='$term',grade='$grade',class_name='$class_name' where class_id='$class_id'";
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
    function deleteClass(){
        $class_id=e($_POST['class_id']);
        $sql="delete from class where class_id='$class_id'";
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
    session_write_close();
?>