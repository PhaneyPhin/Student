<?php
    include('./connections/connect.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST' || true){
        $type=1;
        if($_GET['type']){
            $type=$_GET['type'];
        }
    
        switch($type){
            case 1:
                getTeaching();
            break;
            case 2:
                insertTeaching();
            break;
            case 3:
                updateTeaching();
            break;
            case 4:
                deleteTeaching();
            break;
            case 5:
                getTeacherByID();
            break;
            default:
                echo "{code:-1,message:'no action here'}";

        }
    }else{
        echo "{code:-1,message:'no action here'}";
    }
    function getTeaching(){
        $sql="SELECT teaching_id,s.sub_id,t.teacher_id,r.room_id,c.class_id,s.sub_name,CONCAT(t.first_name,' ',t.last_name) as teacher_name,c.class_name,day,start_time,end_time,room_number from subject s
                inner join teaching tc on s.sub_id=tc.sub_id
                inner join class c on c.class_id=tc.class_id
                inner join teachers t on t.teacher_id=tc.teacher_id
                inner join room r on r.room_id=tc.room_id
                ";
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    function getTeacherByID(){
        $teacher_id=e($_POST['teacher_id']);
        $sql="SELECT t.*,l.admin_id as postcode,l.province_en as province,l.amphur_en as amphur,l.tambon_en as tambon from teachers t left join location l on l.admin_id=t.admin_id where  t.teacher_id='$teacher_id'  ";
        // echo $sql;
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    function insertTeaching(){
    
       $sub_id=e($_POST['sub_id']);
       $teacher_id=e($_POST['teacher_id']);
       $class_id=e($_POST['class_id']);
       $room_id=e($_POST['room_id']);
       $day=e($_POST['day']);
       $start_time=e($_POST['start_time']);
       $end_time=e($_POST['end_time']);
       $sql="insert into teaching (sub_id,teacher_id,class_id,room_id,day,start_time,end_time) values ('$sub_id','$teacher_id','$class_id','$room_id','$day','$start_time','$end_time')";
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
    function updateTeaching(){
        $teaching_id=e($_POST['teaching_id']);
        $sub_id=e($_POST['sub_id']);
        $teacher_id=e($_POST['teacher_id']);
        $class_id=e($_POST['class_id']);
        $room_id=e($_POST['room_id']);
        $day=e($_POST['day']);
        $start_time=e($_POST['start_time']);
        $end_time=e($_POST['end_time']);
        $sql="
            update teaching set sub_id='$sub_id',
                                teacher_id='$teacher_id',
                                class_id='$class_id',
                                room_id='$room_id',
                                day='$day',
                                start_time='$start_time',
                                end_time='$end_time'
                    where teaching_id='$teaching_id'
        ";
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
    function deleteTeaching(){
        $teaching_id=e($_POST['teaching_id']);
        $sql="delete from teaching where teaching_id='$teaching_id'";
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