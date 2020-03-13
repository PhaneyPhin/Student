<?php
    include('./connections/connect.php');
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
                addGrade();
            break;
            case 3:
                updateTeacher();
            break;
            case 4:
                deleteStudentInClass();
            break;
            case 5:
                getGradeList();
            break;
            case 6:
                getStudentName();
            break;
            case 7:
                getStudentNoClass();
            break;
            case 8:
                getStudentInClass();
            break;
            default:
                echo "{code:-1,message:'no action here'}";

        }
    }else{
        echo "{code:-1,message:'no action here'}";
    }
    function addGrade(){
        $class_id=e($_POST['class_id']);
        $student_id=e($_POST['student_id']);
        $sub_id=e($_POST['sub_id']);
        $grade_id=e($_POST['grade_id']);
        
        $sql1="DELETE from student_grade where class_id='$class_id' and student_id='$student_id' and sub_id='$sub_id'";
        
        $result1=execute($sql1);
       
        if($result1){
            $result=execute("INSERT into student_grade (student_id,sub_id,grade,class_id) values ('$student_id','$sub_id','$grade_id','$class_id')");
            if($result){
                echo json_encode(['code'=>1,'message'=>'ok']);
            }else{
                echo json_encode(['code'=>-1,'message'=>"can't add grade to table"]);
            }
        }else{
            echo json_encode(['code'=>-1,'message'=>$sql1]);
        }
    }
    function getStudent(){
        $class_id=e($_GET['class_id']);
        $sub_id=e($_GET['sub_id']);
        $sql="select distinct q1.*,(case when q2.grade_id is null then '' else q2.grade_id end) as grade_id from (
            SELECT s.*,c1.class_id,t.sub_id from students s inner join study_class c on s.student_id=c.student_id
            inner join class c1 on c1.class_id=c.class_id
            inner join teaching t on t.class_id=c1.class_id
            where c.class_id='$class_id' and t.sub_id='$sub_id'
            ) q1 left join (
                 select sg.student_id,grade_name,point,gl.id as grade_id from student_grade sg  inner join
                grade_list gl on sg.grade=gl.id 
                where sg.class_id='$class_id' and sg.sub_id='$sub_id'
               
            ) q2
            on q1.student_id=q2.student_id
        ";
        echo json_encode(['succes'=>true,'sql'=>$sql,'data'=>getOfDB($sql)]);
    }
    function getGradeList(){
        $sql="select * from grade_list";
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    function addStudentToClass(){
        $class_id=e($_POST['class_id']);
        $students=json_decode(($_POST['student_id']));
        
        $sql1="DELETE from study_class where class_id='$class_id'";
        $_SESSION['class_id']=$class_id;
        $result1=execute($sql1);
        function map($student_id){
            $class_id=$_SESSION['class_id'];
            return "('$student_id','$class_id')";
        }
        if($result1){
            if(count($students)>0){
                $sql2="insert into study_class (student_id,class_id) values ".join(',',array_map('map',$students));
                $result2=execute($sql2);
                if($result2){
                    echo json_encode(['success'=>true,'message'=>'ok']);
                }else{
                    echo json_encode(['success'=>false,'message'=>$sql2]);
                }
            
            }else{
                echo json_encode(['success'=>true,'message'=>'ok']);
            }
        }else{
            echo json_encode(['success'=>false,'message'=>$sql1]);
        }
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
       $sql="update teachers set first_name='$first_name',last_name='$last_name',card_id='$card_id',date_of_birth='$date_of_birth',address_no='$admin_id',address_part='$address_part',admin_id='$admin_id',for_grade='$for_grade',image='$image',religion='$religion' where teacher_id='$teacher_id'" ;
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
    function deleteStudentInClass(){
        $student_id=e($_POST['student_id']);
        $class_id=e($_POST['class_id']);
        $sql="delete from study_class where class_id='$class_id' and student_id='$student_id'";
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
    function getStudentName(){
        $sql="SELECT student_id,CONCAT(first_name,' ',last_name) as student_name from students";
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    function getStudentNoClass(){
        $year=e($_POST['year']);
        $term=e($_POST['term']);
    
        $sql="select * from students s where s.student_id not in (
            select student_id from study_class sc inner join class c on sc.class_id=c.class_id
            where year='$year' and term='$term'
        )";
        echo json_encode(['success'=>true,'data'=>getOfDB($sql)]);
        
    }
    function getStudentInClass(){
        $class_id=e($_POST['class_id']);

        $sql="select * from students s where s.student_id in (
            select student_id from study_class sc inner join class c on sc.class_id=c.class_id
            where c.class_id='$class_id' 
        )";
        echo json_encode(['success'=>true,'data'=>getOfDB($sql)]);
        
    }
?>