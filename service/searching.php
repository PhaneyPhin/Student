<?php
    include('./connections/connect.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST' || true){
        $type=1;
        if($_GET['type']){
            $type=$_GET['type'];
        }
    
        switch($type){
            case 1:
                searchClass();
            break;
            case 2:
                searchTable();
            break;
            case 3:
                searchTeaching();
            break;
            case 4:
                deleteTeaching();
            break;
            case 5:
                getLastTeaching();
            break;
            default:
                echo "{code:-1,message:'no action here'}";

        }
    }else{
        echo "{code:-1,message:'no action here'}";
    }
    function getLastTeaching(){
        $sql="
        SELECT max(c.year+c.term),c.term,c.year from teaching tc
        inner join subject s on s.sub_id=tc.sub_id
        inner join class c on c.class_id=tc.class_id
        order by start_time
        ";
        echo json_encode([
            'code'=>1,
            'data'=>getOfDB($sql)
        ]);
    }
    function searchClass(){
        $year=e($_POST['year']);
        $term=e($_POST['term']);
        $grade=e($_POST['grade']);
        $sql="SELECT class_id, class_name from class where
            (year like '%$year%' or '$year'='') and (term='$term' or '$term'='')
        and (grade='$grade' or '$grade'='0')
                ";
        echo json_encode(['succes'=>true,'sql'=>$sql,'data'=>getOfDB($sql)]);
    }
    function searchTable(){
        $class_id=e($_POST['class_id']);
        $array_tables=[];
        $days=[
            "วันจันทร์",
            "วันอังคาร",
            "วันพุธ",
            "วันพฤหัสบดี",
            "วันศุกร์",
            "วันเสาร์",
            "วันอาทิตย์"
        ];
        foreach($days as $day){
           
            $sql="SELECT tc.start_time,tc.end_time,CONCAT(t.first_name,' ',t.last_name) as teacher_name,s.sub_name from teaching tc
                inner join subject s on s.sub_id=tc.sub_id
                inner join teachers t on t.teacher_id=tc.teacher_id
            
                where tc.day='$day' and tc.class_id='$class_id'
                order by start_time
                ";
            
             $result=getOfDB($sql);
             if(count($result)>0){
                array_push($array_tables,['day'=>$day,'table'=>$result,'count'=>count($result)]);
             }
            
        }
        echo json_encode([
            'code'=>1,
            'data'=>$array_tables
        ]);
    }
    function searchTeaching(){
    
        $teacher_id=e($_POST['teacher_id']);
        $year=e($_POST['year']);
        $term=e($_POST['term']);
        $array_tables=[];
        $days=[
            "วันจันทร์",
            "วันอังคาร",
            "วันพุธ",
            "วันพฤหัสบดี",
            "วันศุกร์",
            "วันเสาร์",
            "วันอาทิตย์"
        ];
        foreach($days as $day){
           
            $sql="SELECT tc.start_time,tc.end_time,c.class_name,s.sub_name from teaching tc
                inner join subject s on s.sub_id=tc.sub_id
                inner join class c on c.class_id=tc.class_id
                where tc.day='$day' and tc.teacher_id='$teacher_id'
                and c.year='$year' and c.term='$term'
                order by start_time
                ";
            
             $result=getOfDB($sql);
             if(count($result)>0){
                array_push($array_tables,['day'=>$day,'table'=>$result,'count'=>count($result)]);
             }
            
        }
        echo json_encode([
            'code'=>1,
            'data'=>$array_tables
        ]);
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