<?php
    include('./connections/connect.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST' || true){
        $type=1;
        if($_GET['type']){
            $type=$_GET['type'];
        }
    
        switch($type){
            case 1:
                getSubject();
            break;
            case 2:
                insertSubject();
            break;
            case 3:
                updateSubject();
            break;
            case 4:
                deleteSubject();
            break;
            case 5:
                getSubjectByID();
            break;
            default:
                echo "{code:-1,message:'no action here'}";

        }
    }else{
        echo "{code:-1,message:'no action here'}";
    }
    function getSubject(){
        $sql="SELECT * from subject";
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    function getSubjectByID(){
        $sub_id=e($_POST['subject_id']);
        $sql="select * from subject where sub_id='$sub_id'";
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    function insertSubject(){
       $sub_id=e($_POST['sub_id']);
       $sub_name=e($_POST['sub_name']);
       $credit=e($_POST['credit']);
       $sql="insert into subject (sub_id,sub_name,credit) values ('$sub_id','$sub_name','$credit')";
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
    function updateSubject(){
        $sub_id =e($_POST['sub_id']);
        $sub_name=e($_POST['sub_name']);
        $credit=e($_POST['credit']);
        $sql="update subject set sub_name='$sub_name',credit='$credit' where sub_id='$sub_id'";
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
    function deleteSubject(){
        $sub_id=e($_POST['sub_id']);
        $sql="delete from subject where sub_id='$sub_id'";
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
?>