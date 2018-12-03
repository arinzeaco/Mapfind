<?php
include 'config.php';

$profession = $_POST['profession'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$distance = $_POST['distance'];


if($_POST['profession']=="any profession"){
    $profession="IN (SELECT profession FROM user)";
}else{
    $profession="IN (SELECT profession FROM user WHERE profession = '".$profession."')";
}
try {
    $yes="SELECT *, (3959 * acos(cos( radians($latitude)) * cos(radians(latitude)) 
* cos(radians(longitude) -  radians($longitude)) + sin( radians($latitude)) *    
sin(radians(latitude)))) AS distance 
FROM user WHERE profession $profession HAVING distance > $distance ORDER BY distance";

    $stmt = $db->prepare($yes);
    $stmt->execute([
        ':longitude' =>$longitude,
        ':latitude' => $latitude

    ]);
    $rows = $stmt->fetchAll();

    if ($rows) {
        $response["status"] = 1;
        $response["message"] = "Post Available!";
        foreach ($rows as $row) {
            $response["data"] = $rows;
        }
        echo json_encode($response);

    }
} catch (PDOException $e) {

    $response["success"] = 0;
    $response["message"] = "Database Error1. Please Try Again!";
    die(json_encode($response));
}
?>
