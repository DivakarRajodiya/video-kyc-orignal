<?php
//add by yogeshvakhre 23-08-2021 

header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
	
include_once '../server/connect.php';   

try {
 	  $headers =  getallheaders();
  	if (empty($headers['api-key'])) {
      $response=array(
        'status'=>false,
        'message'=>'Please provide api key'
      );  
    //return response
     echo json_encode($response);exit();
    }else{
      if ($headers['api-key']!=='V9zsiI2jo8CRQrnocdMDz6uYSFVsVJ') {
          $response=array(
            'status'=>false,
            'message'=>'Invalid Api key'
          );  
        //return response
         echo json_encode($response);exit();
      }
    }  
    //select question answer record entry  
		$sql='SELECT * FROM `lsv_question_answer` WHERE `deleted_at` IS NULL AND `status`=1 ORDER BY `id` DESC'; 
		$fetchData=$pdo->query($sql)->fetchAll();
		$html='';
		
		if(count($fetchData)>0){
		  $sn=1;
		  foreach($fetchData as $data){ 
		   $html.=' <input id="faq-a'.$sn.'" type="checkbox" class="faq-checkbox">
                          <label for="faq-a'.$sn.'">
                            <p class="faq-heading">'.$data['question'].'?</p>
                            <div class="faq-arrow"></div>
                              <p class="faq-text"> 
                                <button class="btn btn-sm btn-success">Correct</button>
                                <button class="btn btn-sm btn-danger">Incorrect</button>     
                              </p>
                          </label>';
		         
		    $sn++; 
		 }
		}else{
		   
		$html.=" No Data Found"; 
		}
		 
		echo $html;exit();
	  

} catch (Exception $e) {
    $response=array(
        'status'=>false,
        'message'=>$e->getMessage()
      );  
    //return response
     echo json_encode($response);exit();
}

?>