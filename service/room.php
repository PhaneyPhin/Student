<?php
    include('./connections/connect.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST' || true){
        $type=1;
        if($_GET['type']){
            $type=$_GET['type'];
        }
    
        switch($type){
            case 1:
                getRoom();
            break;
            case 2:
                insertRoom();
            break;
            case 3:
                updateRoom();
            break;
            case 4:
                deleteRoom();
            break;
            case 5:
                getRoomByID();
            break;
            default:
                echo "{code:-1,message:'no action here'}";

        }
    }else{
        echo "{code:-1,message:'no action here'}";
    }
    function getRoom(){
        $sql="SELECT * from room";
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    function getRoomByID(){
        $room_number=e($_POST['room_id']);
        $sql="select * from room where room_id='$room_id'";
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    function insertRoom(){
       $room_id=e($_POST['room_id']);
       $room_number=e($_POST['room_number']);

       $sql="insert into room (room_id,room_number) values ('$room_id','$room_number')";
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
    function updateRoom(){
        $room_id=e($_POST['room_id']);
        $room_number=e($_POST['room_number']);
 
        $sql="update room set room_number='$room_number' where room_id='$room_id'";
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
    function deleteRoom(){
        $room_id=e($_POST['room_id']);
        $sql="delete from room where room_id='$room_id'";
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