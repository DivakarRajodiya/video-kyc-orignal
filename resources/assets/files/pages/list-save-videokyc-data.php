<?php
header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
	
include_once 'connect.php';   

try {

	  $meeting_id =inputCheck($_POST['meeting_id'] ?? '');  
	  if (! empty($meeting_id)) {
        $scan_type=inputCheck($_POST['scan_type']);//added by yogeshvakhre 09-09-2021
        //select passport last record entry add by yogeshvakhre 17-08-2021
        if ($scan_type=="passport") {
      	  //select last record entry 
          $sql='SELECT * FROM `save_videokyc_data` WHERE `meeting_id`="'.$meeting_id.'" AND `deleted_at` IS NULL AND `scan_type`="'.$scan_type.'" ORDER BY `id` DESC LIMIT 1';// add where in scan_type updated by yogeshvakhre 17-08-2021
          $fetchRow=$pdo->query($sql)->fetch();
          if ($fetchRow==true) {
            $response=array(
              'status'=>true,
              'data'=>$fetchRow,
            );
              
          } else {
            $response=array(
              'status'=>false,
              'message'=>'Letest record not found',
            );
          }
          //return response
          echo json_encode($response);exit();    
        }
        //select captureimage record entry add by yogeshvakhre 18-08-2021
        if ($scan_type=="captureimage") {
        
          $sql='SELECT * FROM `save_videokyc_data` WHERE `meeting_id`="'.$meeting_id.'" AND `deleted_at` IS NULL AND `scan_type`="'.$scan_type.'" ORDER BY `id` DESC'; 
          $fetchData=$pdo->query($sql)->fetchAll();
          $html='';
          $html.='<table id="capturetabel" class="table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                  <tr>
                      <th>TextField</th>
                      <th>Image</th>
                  </tr>
                   </thead>
                   <tbody>';
          if(count($fetchData)>0){
              $sn=1;
              foreach($fetchData as $data){ 
                $html.="<tr>
                        <td>".$data['scan_data']."</td>
                        <td><img src='".$data['scan_image']."' class='w-150px'/></td>
                         
                 </tr>";
                     
                $sn++; 
             }
          }else{
               
            $html.="<tr>
                  <td colspan='7'>No Data Found</td>
                 </tr>"; 
          }
          $html.="</tbody></table>";
          echo $html;exit();
        }
       
	   }  
   
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