<?php
include 'config.php';

    $u_id = $_POST['u_id'];
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["image"]["name"];
        $filetype = $_FILES["image"]["type"];
        $filesize = $_FILES["image"]["size"];

// Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
      //  $ima = "http://192.168.1.102/maphpandroid/";
        $ima = "http://192.168.1.100/maphpandroid/";
        $final_link = $ima . "avatar/" . $u_id .".". $ext;
        $query =  "UPDATE user SET avatar=:avatar Where u_id=:u_id";
        $stmt = $db->prepare($query);
        $stmt->execute([
            ':u_id' => $u_id,
            ':avatar' =>$final_link,
        ]);
        if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid image.");

            move_uploaded_file($_FILES["image"]["tmp_name"], "avatar/" . $u_id. ".". $ext);

            $response["status"] = 1;
            $response["data"]= $final_link;
            $response["message"]="Login Succesfull";
            echo json_encode($response);
        } else {
            $response["status"] = 0;
            $response["message"]="Failed To Change";
            echo json_encode($response);


}
?>