<?php
header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");


include_once 'connect.php'; 

$serverMethod = $_SERVER['REQUEST_METHOD'];
 
if($serverMethod == 'POST'){
  
  try {

    $meeting_id =inputCheck($_POST['meeting_id'] ?? '');       
    
    // START location added by yogeshvakhre 26-08-2021
    if (isset($meeting_id)) {
      //print_r($_POST);exit();
      
      if (!empty($_POST['crud']) && inputCheck($_POST['crud']) =='select') {
        $sql='SELECT * FROM `lsv_location` WHERE `meeting_id`="'.$meeting_id.'" AND `deleted_at` IS NULL';
        $data = $pdo->query($sql)->fetch();;
        echo json_encode($data);exit();  
      }else{
        $location=inputCheck($_POST['location']);
        $latlong=inputCheck($_POST['latlong']);
        $sql='SELECT `meeting_id` FROM `lsv_location` WHERE `meeting_id`="'.$meeting_id.'" AND `deleted_at` IS NULL';
        $checkSaveKycData = $pdo->query($sql);
        //check record
        if ($checkSaveKycData->rowCount() >= 1) {
          //update record
          $sql='UPDATE `lsv_location` SET `location`="'.$location.'" , `latlong`="'.$latlong.'" WHERE `meeting_id`="'.$meeting_id.'"'; 
          $update = $pdo->query($sql);
          if ($update) {
            $response=array(
              'status'=>true,
              'message'=>'Records updated successfully',
            );
          } else {
            $response=array(
              'status'=>false,
              'message'=>'Records not updated successfully'
            );   
          }
        }else{
          //insert data videokyc 
          $sql='INSERT INTO `lsv_location` (meeting_id, location ,latlong)  VALUES (:meeting_id, :location ,:latlong)';
          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(':meeting_id', $meeting_id);
          $stmt->bindParam(':location', $location);
          $stmt->bindParam(':latlong', $latlong);
          $stmt->execute();
          if ($stmt) {
              $last_id = $pdo->lastInsertId();
              $response=array(
                'status'=>true,
                'last_id'=>$last_id,
                'message'=>'Records created successfully',
              );
          } else {
              $response=array(
                'status'=>false,
                'message'=>'Records not created successfully'
              );   
          }
        }
        
       //return response
        echo json_encode($response);exit();  
      }
      
    }
    // END location added by yogeshvakhre 26-08-2021

  } catch (Exception $e) {
      $response=array(
          'status'=>false,
          'message'=>$e->getMessage()
        );  
      //return response
       echo json_encode($response);exit();
  }
}
//remove tags space special character
function inputCheck($data) {
  $data = base64_decode($data);//added by yogeshvakhre 09-09-2021
  $data = trim($data);
//  $data = stripslashes($data);
  //$data = strip_tags($data);
  return $data;
}
?>