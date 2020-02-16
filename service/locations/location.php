<?php
    include('../connections/connect.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST' || true){
        $type=1;
        if($_GET['type']){
            $type=$_GET['type'];
        }
    
        switch($type){
            case 1:
                getprovince();
            break;
            case 2:
                getamphur();
            break;
            case 3:
                gettambon();
            break;
            case 4:
                getpostcode();
            break;
            default:
                echo "{code:-1,message:'no action here'}";

        }
    }else{
        echo "{code:-1,message:'no action here'}";
    }
    function getprovince(){
        $sql="select distinct province_th,province_en from location";
        echo json_encode(getOfDB($sql));
    }
    function getamphur(){
        $province= e($_GET['province']);
        $sql="select distinct amphur_en,amphur_th from location where province_en='$province'";
        echo json_encode(getOfDB($sql));

    }
    function gettambon(){
        $province= e($_GET['province']);
        $amphur=e($_GET['amphur']);
        $sql="select distinct tambon_en,tambon_th from location where province_en='$province' and amphur_en='$amphur'";
        echo json_encode(getOfDB($sql));

    }
    function getpostcode(){
        $province= e($_GET['province']);
        $amphur=e($_GET['amphur']);
        $tambon=e($_GET['tambon']);
        $sql="select distinct admin_id,postcode from location where province_en='$province' and amphur_en='$amphur' and tambon_en='$tambon'";
        echo json_encode(getOfDB($sql));

    }
?>