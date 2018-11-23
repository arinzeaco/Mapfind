<?php
include './function.php';
$carrier='txtlocal.co.uk';
$phone= $_POST['phone'].'@'.$carrier;
$u_id = $_POST['u_id'];
$verification_code = $_POST['verification_code'];
$verified= $_POST['verified'];
try {
    if( isUserExists($db,$phone)==1){
        $response["status"] = 1;
        $response["message"]="Number already in used";
        echo json_encode($response);
        return;
    }
    else {
       $verification_code= rand(10000, 99999);
            $query = "INSERT INTO mobile_numbers (u_id,mobile_number,verification_code,verified) VALUES (:u_id,:phone,:verification_code,:verified)";
            $stmt = $db->prepare($query);


       // sendsms($phone,$verification_code);
            $stmt->execute([
                ':u_id' => $u_id,
                ':phone' => $phone,
                ':verification_code' => $verification_code,
                ':verified' => $verified
            ]);
            $response["status"] = 1;
            $response["message"] = "Welcome to snap find";
            echo json_encode($response);

    }
} catch (PDOException $e) {

    $response["success"] = 0;
    $response["message"] = "Database Error1. Please Try Again!";
    die(json_encode($response));
}
?>
