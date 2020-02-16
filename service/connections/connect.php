<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname="student_manage";

$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_query($conn,"SET character_set_results=utf8");
mysqli_query($conn,"SET character_set_client='utf8'");
mysqli_query($conn,"SET character_set_connection='utf8'");
mysqli_query($conn,"collation_connection = utf8_unicode_ci");
mysqli_query($conn,"collation_database = utf8_unicode_ci");
mysqli_query($conn,"collation_server = utf8_unicode_ci");
function getOfDB($sql){
    global $conn;
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $result = mysqli_query($conn, $sql);

    for($rows = array(); $row = mysqli_fetch_assoc($result); $rows[] = $row);
    return ($rows );
    // mysqli_close($conn);
    
}
function execute($sql){
    global $conn;
    // echo $sql;
    $result = mysqli_query($conn, $sql);
    return $result;
}
function e($str){
    global $conn;
    return mysqli_real_escape_string($conn,$str);
}

?>