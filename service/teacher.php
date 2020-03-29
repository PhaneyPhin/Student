<?php
    include('./connections/connect.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST' || true){
        $type=1;
        if($_GET['type']){
            $type=$_GET['type'];
        }
    
        switch($type){
            case 1:
                getTeacher();
            break;
            case 2:
                insertTeacher();
            break;
            case 3:
                updateTeacher();
            break;
            case 4:
                deleteTeacher();
            break;
            case 5:
                getTeacherByID();
            break;
            case 6:
                update_password();
            break;
            default:
                echo "{code:-1,message:'no action here'}";

        }
    }else{
        echo "{code:-1,message:'no action here'}";
    }
    function getTeacher(){
        $sql="SELECT t.teacher_id,t.first_name,t.last_name,t.card_id,t.structure from teachers t";
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    function getTeacherByID(){
        $teacher_id=e($_POST['teacher_id']);
        $sql="SELECT t.*,l.admin_id as postcode,l.province_en as province,l.amphur_en as amphur,l.tambon_en as tambon from teachers t left join location l on l.admin_id=t.admin_id where  t.teacher_id='$teacher_id'  ";
        // echo $sql;
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    
    function insertTeacher(){
        
       $teacher_id=e($_POST['teacher_id']);
       $first_name=e($_POST['first_name']);
       $last_name=e($_POST['last_name']);
       $card_id=e($_POST['card_id']);
       $date_of_birth=e($_POST['date_of_birth']);
       $address_no=e($_POST['address_no']);
       $address_part=e($_POST['address_part']);
       $admin_id=e($_POST['admin_id']);
       $for_grade=e($_POST['grade']);
       $image=e($_POST['img']);
       $religion=e($_POST['religion']);
       $structure=e($_POST['structure']);
       $sql="insert into teachers (teacher_id,first_name,last_name,card_id,date_of_birth,address_no,address_part,admin_id,for_grade,image,structure,religion) values ";
       $sql.="('$teacher_id','$first_name','$last_name','$card_id','$date_of_birth','$address_no','$address_part','$admin_id','$for_grade','$image','$structure','$religion')";
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
    function updateTeacher(){
       $teacher_id=e($_POST['teacher_id']);
       $first_name=e($_POST['first_name']);
       $last_name=e($_POST['last_name']);
       $card_id=e($_POST['card_id']);
       $date_of_birth=e($_POST['date_of_birth']);
       $address_no=e($_POST['address_no']);
       $address_part=e($_POST['address_part']);
       $admin_id=e($_POST['admin_id']);
       $for_grade=e($_POST['grade']);
       $image=e($_POST['img']);
       $religion=e($_POST['religion']);
       $structure=e($_POST['structure']);
       $sql="update teachers set first_name='$first_name',last_name='$last_name',card_id='$card_id',date_of_birth='$date_of_birth',address_no='$admin_id',address_part='$address_part',admin_id='$admin_id',for_grade='$for_grade',image='$image',religion='$religion',structure='$structure' where teacher_id='$teacher_id'" ;
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
    function deleteTeacher(){
        $teacher_id=e($_POST['teacher_id']);
        $sql="delete from teachers where teacher_id='$teacher_id'";
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
    function update_password(){
        $teacher_id=e($_POST['teacher_id']);
        $password=e($_POST['password']);

        $sql="update teachers set password=SHA1('$password') where teacher_id='$teacher_id'";

        $result=execute($sql);

        if($result){
            echo json_encode([
                'code'=>1,
                'message'=>'ok'
            ]);
        }else{
            echo json_encode([
                'code'=>-1,
                'message'=>"can't update teacher password"
            ]);
        }
    }
?>