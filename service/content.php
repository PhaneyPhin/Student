<?php
    include('./connections/connect.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST' || true){
        $type=1;
        if($_GET['type']){
            $type=$_GET['type'];
        }
    
        switch($type){
            case 1:
                getContent();
            break;
            case 2:
                insertContent();
            break;
            case 3:
                updateContent();
            break;
            case 4:
                deleteContent();
            break;
            case 5:
                getContentType();
            break;
            default:
                echo "{code:-1,message:'no action here'}";

        }
    }else{
        echo "{code:-1,message:'no action here'}";
    }
    function getContent(){
        $sql="SELECT c.*,ct.name as type_name from contents c inner join content_type ct on c.type=ct.id";
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    function getContentType(){
        $sql="select * from content_type";
        echo json_encode(['succes'=>true,'data'=>getOfDB($sql)]);
    }
    function insertContent(){
       $image=e($_POST['image']);
       $topic=e($_POST['topic']);
       $description=e($_POST['description']);
       $url=e($_POST['url']);
       $data_html=e($_POST['data_html']);
       $type=e($_POST['type']);
       $sql="insert into contents (topic,image,description,url,data_html,type) values ('$topic','$image','$description','$url','$data_html','$type')";
       $result=execute($sql);
       if($result){
           echo json_encode([
               'code'=>1,
               'message'=>'ok',
               'image'=>$image
           ]);
       }else{
           echo json_encode([
            'code'=>-1,
            'message'=>$sql
        ]);
       }
    }
    function updateContent(){
        $id=e($_POST['id']);
        $image=e($_POST['image']);
        $topic=e($_POST['topic']);
        $description=e($_POST['description']);
        $url=e($_POST['url']);
        $data_html=e($_POST['data_html']);
        $type=e($_POST['type']);
        $sql="update contents set image='$image',topic='$topic',description='$description',url='$url',data_html='$data_html',type='$type' where id='$id'";
        $result=execute($sql);
        if($result){
            echo json_encode([
                'code'=>1,
                'message'=>'ok',
                'image'=>$image
            ]);
        }else{
            echo json_encode([
             'code'=>-1,
             'message'=>$sql
         ]);
        }
     }
    function deleteContent(){
        $id=e($_POST['id']);

        $sql="delete from contents where id='$id'";
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