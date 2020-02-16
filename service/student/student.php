<?php
    include('../connections/connect.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST' || true){
        $type=1;
        if($_GET['type']){
            $type=$_GET['type'];
        }
    
        switch($type){
            case 1:
                getStudent();
            break;
            case 2:
                insertStudent();
            break;
            case 3:
                updateStudent();
            break;
            case 4:
                deleteStudent();
            break;
            case 5:
                getStudentByID();
            break;
            default:
                echo "{code:-1,message:'no action here'}";

        }
    }else{
        echo "{code:-1,message:'no action here'}";
    }
    function getStudent(){
        $sql="SELECT * from students";
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    function getStudentByID(){
        $student_id=e($_POST['student_id']);
        $sql="SELECT s.*,l.admin_id as postcode,l.province_en as province,l.amphur_en as amphur,l.tambon_en as tambon from students s left join location l on l.admin_id=s.admin_id where  s.student_id='$student_id'  ";
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    function insertStudent(){
       $student_id=e($_POST['student_id']);
       $first_name=e($_POST['first_name']);
       $last_name=e($_POST['last_name']);
       $card_id=e($_POST['card_id']);
       $date_of_birth=e($_POST['date_of_birth']);
       $address_no=e($_POST['address_no']);
       $address_part=e($_POST['address_part']);
       $admin_id=e($_POST['admin_id']);
       $grade=e($_POST['grade']);
       $image=e($_POST['img']);
       $religion=e($_POST['religion']);

       $sql="insert into students (student_id,first_name,last_name,card_id,date_of_birth,address_no,address_part,admin_id,grade,image,religion) values ";
       $sql.="('$student_id','$first_name','$last_name','$card_id','$date_of_birth','$address_no','$address_part','$admin_id','$grade','$image','$religion')";
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
    function updateStudent(){
       $student_id=e($_POST['student_id']);
       $first_name=e($_POST['first_name']);
       $last_name=e($_POST['last_name']);
       $card_id=e($_POST['card_id']);
       $date_of_birth=e($_POST['date_of_birth']);
       $address_no=e($_POST['address_no']);
       $address_part=e($_POST['address_part']);
       $admin_id=e($_POST['admin_id']);
       $grade=e($_POST['grade']);
       $image=e($_POST['img']);
       $religion=e($_POST['religion']);

       $sql="update students set first_name='$first_name',last_name='$last_name',card_id='$card_id',date_of_birth='$date_of_birth',address_no='$admin_id',address_part='$address_part',admin_id='$admin_id',grade='$grade',image='$image',religion='$religion' where student_id='$student_id'" ;
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
    function deleteStudent(){
        $student_id=e($_POST['student_id']);
        $sql="delete from students where student_id='$student_id'";
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