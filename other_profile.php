<?php
include 'config.php';

$userid = $_POST['userid'];

//  $brief = $_POST['brief'];
try {
    $stmt = $db->prepare("SELECT * FROM user WHERE u_id = :userid ");

    $stmt->execute([
        ':userid' => $userid
    ]);

    if ($stmt->rowCount()) {
        $rows = $stmt->fetchAll();
        $stmt = $db->prepare("SELECT * FROM chart WHERE u_id=:u_id AND like_uid=:userid");
        $stmt->execute(array(":u_id"=>$_POST['u_id'],":userid"=>$_POST['userid']));
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->rowCount() == 1)
        {
            $li='yes';
        }
        else
        {
            $li='no';
        }
        $response["status"] = 1;
        $response["liked"]=$li;
        $response["message"]="Login Succesfull";
        $response["data"]=$rows[0];
        echo json_encode($response);
    }else{
        $response["status"] = 0;
        $response["message"]="user does not exist";
        echo json_encode($response);
    }
} catch (PDOException $e) {

    $response["success"] = 0;
    $response["message"] = "Database Error1. Please Try Again!";
    die(json_encode($response));
}
?>
