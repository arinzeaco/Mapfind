<?php
include 'config.php';

$u_id = $_POST['u_id'];
try {
    $query =" SELECT * FROM user WHERE u_id IN 
            (SELECT like_uid FROM chart WHERE u_id=:u_id)";
    $query_params = array(
        ':u_id' => $u_id
    );


        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch (PDOException $ex) {


        $response["success"] = 0;
        $response["message"] = "Database Error1. Please Try Again!";
        die(json_encode($response));

    }
$validated_info = false;
$rows = $stmt->fetchAll();

if ($rows) {
    $response["success"] = 1;
    $response["message"] = "Post Available!";

    foreach ($rows as $row) {
        $response["posts"]   = $rows;
       // array_push($response["posts"], $rows);
    }
    echo json_encode($response);
} else {
    $response["success"] = 2;
    $response["message"] = "Failed";
    die(json_encode($response));
}
