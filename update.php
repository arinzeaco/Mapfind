<?php
include 'config.php';

		$u_id = $_POST['u_id'];
		$name=$_POST['name'];
		$profession =$_POST['profession'];
        $interest = $_POST['interest'];
	    $brief = $_POST['brief'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];

       try {
       
	  $query = "UPDATE user SET name=:name, profession=:profession, interest=:interest, brief=:brief, phone=:phone,
               longitude= :longitude, latitude= :latitude, address=:address
	           Where u_id=:u_id";

			$stmt = $db->prepare($query);
            $stmt->execute([
                 ':u_id' => $u_id,
				':name' => $name,
				':profession' => $profession,
				':interest' => $interest,
				':brief' => $brief,
				':phone'=>$phone,
				':address'=>$address,
				':longitude'=>$longitude,
				':latitude'=>$latitude
			]);
		   	$stmtt = $db->prepare("SELECT * FROM user WHERE u_id = :u_id");
		 $stmtt->execute([
                 ':u_id' => $u_id
            ]);
         $row = $stmtt->fetchAll();

	  $response["status"] = 1;
		  $response["message"]="Login Succesfull";
		  $response["data"]=$row[0];
    echo json_encode($response);
	
    
       } catch (PDOException $e) {

		    $response["success"] = 0;
        $response["message"] = "Database Error1. Please Try Again!";
        die(json_encode($response));
       }
?>
