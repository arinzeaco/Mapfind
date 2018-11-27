<?php
include 'config.php';

$u_id = $_POST['u_id'];
try {

    $query = "UPDATE user SET avatar=:avatar
	           Where u_id=:u_id";

    $stmt = $db->prepare($query);
    $stmt->execute([
        ':u_id' => $u_id,
        ':avatar' => ''
    ]);
    $response["status"] = 1;
    $response["message"]="Image removed";
    echo json_encode($response);

} catch (PDOException $e) {

    $response["success"] = 0;
    $response["message"] = "Database Error1. Please Try Again!";
    die(json_encode($response));
}
?>
