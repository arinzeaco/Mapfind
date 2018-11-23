<?php
include 'config.php';

$u_id = $_POST['u_id'];
$like_uid=$_POST['like_uid'];
$liked=$_POST['liked'];
//  $brief = $_POST['brief'];
try {
    if($_POST['liked']=='yes'){
        $query = "DELETE FROM chart Where u_id=:u_id AND like_uid=:like_uid";
    }else    if($_POST['liked']=='no'){
        $query = "INSERT INTO chart ( u_id, like_uid ) VALUES ( :u_id, :like_uid ) ";

    }
    $stmt = $db->prepare($query);

    $stmt->execute([
        ':u_id' => $u_id,
        ':like_uid' => $like_uid
    ]);
if($liked=='yes'){
    $val='no';
}else{
    $val='yes';
}
        $response["status"] = 1;
        $response["val"] = $val;
        $response["message"]="Login Succesfull";
        echo json_encode($response);
} catch (PDOException $e) {

    $response["success"] = 0;
    $response["message"] = "Database Error1. Please Try Again!";
    die(json_encode($response));
}
?>


