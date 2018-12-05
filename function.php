<?php
include 'config.php';

function isUserExists($db,$phone) {
$stmt = $db->prepare("SELECT * FROM user WHERE phone = :phone");
    $stmt->execute([
        ':phone' => $phone
    ]);
        if ($stmt->rowCount()) {

           return 1;

        }
}
  function sendsms($recipient_no,$rand_no){

          // Send otp to user via SMS
          $message = 'Dear User, OTP for mobile number verification is '.$rand_no.'. Thanks CodexWorld';
       //   $send = sendSMS('Mapfind', $recipient_no, $message);
      $result = mail($recipient_no,"from submission",  $message, "arinzeaco@gmail.com");

      if($result ){
              $response["status"] = 1;
              $response["message"]="Login Succesfull";
              echo json_encode($response);
          }else{
              $response["status"] = 0;
              $response["message"]="Failed";
              echo json_encode($response);
          }
}

function update($db,$id,$image){

    if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["image"]["name"];
        $filetype = $_FILES["image"]["type"];
        $filesize = $_FILES["image"]["size"];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $ima="http://192.168.40.101/avatar/";
        //$ima="http://192.168.43.87/better/";
        $final_link=$ima."image/" .$id."_8.".$ext;
        $query = "INSERT INTO user ( post_id, image_url ) VALUES ( $id, '$final_link' )";
        $stmt   = $db->prepare($query);
        $result = $stmt->execute();
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
        if(in_array($filetype, $allowed)){
            move_uploaded_file($_FILES["image8"]["tmp_name"], "image/" .$id."_8.".$ext);
            echo "Your file was uploaded successfully.";
        } else{
            echo "Error: There was a problem uploading your file. Please try again.";
        }
    }
}
?>