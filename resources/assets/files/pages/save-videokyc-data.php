<?php
header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");


include_once 'connect.php'; //added by yogeshvakhre 09-09-2021


  
try {

  $meeting_id =inputCheck($_POST['meeting_id'] ?? '');       
  if (isset($_POST['scan_type']) && base64_decode($_POST['scan_type']) =="passport") {
    if (!empty($_POST['liviness_image']) && !empty($_POST['face_image']) && !empty($_POST['liviness_score']) && !empty($_POST['facematch_score'])) {

      $liviness_image=inputCheck($_POST['liviness_image']);//added by yogeshvakhre 09-09-2021
      $face_image=inputCheck($_POST['face_image']);//added by yogeshvakhre 09-09-2021
      $last_insert_id=inputCheck($_POST['last_insert_id']);
      $facematch_score=inputCheck($_POST['facematch_score']);
      $liviness_score=inputCheck($_POST['liviness_score']);
      // update face and livines details
      $sql='UPDATE save_videokyc_data SET facematch_score="'.$facematch_score.'" ,liviness_score="'.$liviness_score.'" ,liviness_image="'.$liviness_image.'" ,face_image="'.$face_image.'" WHERE meeting_id="'.$meeting_id.'" AND id='.$last_insert_id;
      $stmt = $pdo->query($sql);
      //$stmt->execute();
      if ($stmt) {
        $response=array(
                'status'=>true,
                'message'=>'records updated successfully',
              );
          
      } else {
        $response=array(
                'status'=>true,
                'message'=>'records not updated successfully',
              );
      }
      //return response
      echo json_encode($response);exit();
    }

    if (!empty($_POST['scan_data']) && !empty($_POST['scan_image'])) {
      
      $scan_type=input($_POST['scan_type']);
      $scan_data=inputCheck($_POST['scan_data']);//added by yogeshvakhre 09-09-2021
      $scan_image=inputCheck($_POST['scan_image']);//added by yogeshvakhre 09-09-2021
      //print_r($_POST);exit();
      //check data limit
      $sql='SELECT `id`, `meeting_id` ,`scan_data`  FROM `save_videokyc_data` WHERE `meeting_id`="'.$meeting_id.'" AND `deleted_at` IS NULL AND `scan_type`="'.$scan_type.'"';//add where in scan_type updated by yogeshvakhre 17-08-2021
      $checkSaveKycData = $pdo->query($sql);
     
      if ($checkSaveKycData->rowCount() >= 10) {
         //print_r($checkSaveKycData->rowCount());exit();
        
        //select last record entry 
        $sql='SELECT `meeting_id` ,`created_at` ,`id` FROM `save_videokyc_data` WHERE `meeting_id`="'.$meeting_id.'" AND `deleted_at` IS NULL AND `scan_type`="'.$scan_type.'" ORDER BY `id` DESC LIMIT 1';// add where in scan_type updated by yogeshvakhre 17-08-2021
        $updateData=$pdo->query($sql)->fetch();
        $updateID=$updateData['id'];
        //print_r($updateID);exit();

        //check record id exists
        if (!empty($updateID)) {

          $date=date("Y-m-d h:i:s");

          // update face and livines details
          //$sql='UPDATE `save_videokyc_data` SET `meeting_id`="'.$meeting_id.'" ,`scan_type`="'.$scan_type.'" ,`scan_data`='.json_encode($scan_data).' ,`scan_image`="'.$scan_image.'" WHERE `id`='.$updateID;

          //Soft detele record
          $sql='UPDATE `save_videokyc_data` SET `deleted_at`="'.$date.'" WHERE `meeting_id`="'.$meeting_id.'" AND `scan_type`="'.$scan_type.'" AND `id`='.$updateID; //add where in scan_type updated by yogeshvakhre 17-08-2021
          $update = $pdo->query($sql);

          /*//check record updated
          if ($update) {
              
              $response=array(
                'status'=>true,
                'last_id'=>$updateID,
                'message'=>'New records created successfully',
              );
          } else {
              $response=array(
                'status'=>false,
                'message'=>'New records not created successfully'
              );   
          }
          echo json_encode($response);exit(); */   
        }
        
      } 
        //echo "2222";exit();
      //insert data videokyc 
      $sql='INSERT INTO save_videokyc_data (meeting_id, scan_type, scan_data, scan_image)  VALUES (:meeting_id, :scan_type, :scan_data,  :scan_image)';
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':meeting_id', $meeting_id);
      $stmt->bindParam(':scan_type', $scan_type);
      $stmt->bindParam(':scan_data', $scan_data);
      $stmt->bindParam(':scan_image', $scan_image);
      $stmt->execute();
      if ($stmt) {
          $last_id = $pdo->lastInsertId();
          $response=array(
            'status'=>true,
            'last_id'=>$last_id,
            'message'=>'New records created successfully',
          );
      } else {
          $response=array(
            'status'=>false,
            'message'=>'New records not created successfully'
          );   
      }
      //return response
      echo json_encode($response);exit();    
    }
  } 

  
  // START image capture data save added by yogeshvakhre 17-08-2021
  if (isset($_POST['scan_type']) && base64_decode($_POST['scan_type']) =="captureimage") {
    //print_r($_POST);exit();
    $scan_data=inputCheck($_POST['scan_data']);//added by yogeshvakhre 09-09-2021
    $scan_image=inputCheck($_POST['scan_image']);//added by yogeshvakhre 09-09-2021
    $scan_type=input($_POST['scan_type']);
    //insert data videokyc 
    $sql='INSERT INTO save_videokyc_data (meeting_id, scan_type,scan_data,scan_image)  VALUES (:meeting_id, :scan_type, :scan_data,  :scan_image)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':meeting_id', $meeting_id);
    $stmt->bindParam(':scan_type', $scan_type);
    $stmt->bindParam(':scan_data', $scan_data);
    $stmt->bindParam(':scan_image', $scan_image);
    $stmt->execute();
    if ($stmt) {
        $last_id = $pdo->lastInsertId();
        $response=array(
          'status'=>true,
          'last_id'=>$last_id,
          'message'=>'Capture image records created successfully',
        );
    } else {
        $response=array(
          'status'=>false,
          'message'=>'Capture image records not created successfully'
        );   
    }
    //return response
    echo json_encode($response);exit();  
  }
  // END image capture data save added by yogeshvakhre 17-08-2021 

} catch (Exception $e) {
    $response=array(
        'status'=>false,
        'message'=>$e->getMessage()
      );  
    //return response
     echo json_encode($response);exit();
}
 
//remove tags space special character
function input($data) {
  $data = base64_decode($data);
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = strip_tags($data);
  return $data;
}

function inputCheck($data) {
  $data = base64_decode($data);//added by yogeshvakhre 09-09-2021
  $data = trim($data);
  $data = stripslashes($data);
  //$data = strip_tags($data);
  return $data;
}
?>