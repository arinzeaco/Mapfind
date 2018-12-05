<?php 
include 'config.php';

		$u_id = $_POST['u_id'];
  		$name=$_POST['name'];
		$email =$_POST['email'];
        $avatars = $_POST['avatars'];
        $phone = $_POST['phone'];
	  //  $brief = $_POST['brief'];
       try {
            $stmt = $db->prepare("SELECT * FROM user WHERE u_id = :u_id");
		
            $stmt->execute([
                ':u_id' => $u_id
            ]);
 
            if ($stmt->rowCount()) {
                $row = $stmt->fetchAll();
				

   
	      $response["status"] = 1;
		  $response["message"]="Login Succesfull";
		  $response["data"]=$row[0];
          echo json_encode($response);
    
     
            }else{
                $query="INSERT INTO user (u_id,email,name,avatar,phone) VALUES (:u_id,:email,:name,:avatars,:phone)";
                $stmt = $db->prepare($query);
                $stmt->execute([
                    ':u_id' => $u_id,
                    ':email' => $email,
                    ':name' => $name,
                    ':avatars' =>$avatars,
                    ':phone' =>$phone
                ]);

                $stmt = $db->prepare("SELECT * FROM user WHERE u_id = :u_id");

                $stmt->execute([
                    ':u_id' => $u_id
                ]);

                if ($stmt->rowCount()) {
                    $row = $stmt->fetchAll();


                    $response["status"] = 1;
                    $response["data"] = $row[0];
                    $response["message"] = "Login Succesfull to snap find";
                    echo json_encode($response);

                }
			}
       } catch (PDOException $e) {

		$response["success"] = 0;
        $response["message"] = "Database Error1. Please Try Again!";
        die(json_encode($response));
       }
 ?>
