<?php
include './function.php';

$phone= $_POST['phone'];
$u_id = $_POST['u_id'];
try {
    if( isUserExists($db,$phone)==1){
        $response["status"] = 0;
        $response["message"]="Number already in used";
        echo json_encode($response);
        return;
    }
    else {

        $query = "UPDATE user SET phone=:phone Where u_id=:u_id";

            $stmt = $db->prepare($query);
            $stmt->execute([
                ':u_id' => $u_id,
                ':phone' => $phone
            ]);
            $response["status"] = 1;
            $response["message"] = "phone number has been changed";
            echo json_encode($response);

    }
} catch (PDOException $e) {

    $response["success"] = 0;
    $response["message"] = "Database Error1. Please Try Again!";
    die(json_encode($response));
}
?>
