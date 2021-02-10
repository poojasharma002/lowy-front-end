<?php namespace App\Controllers;
use CodeIgniter\Controller;
class FrameSearch extends BaseController
{
// show all search Frame
	public function index()
	{
       echo view('search');
   }
   
  // function for searching Frame 
     public function search(){
         try{
            $baseURI = baseURI();
            $client = \Config\Services::curlrequest();
            if($this->request->getPost('data_action'))
            {
               $data_action= $this->request->getPost('data_action');
               $searchValue= $this->request->getPost('value');
               $page= $this->request->getPost('page');
               if($data_action == "fetch_all_frame_searching")
               {  
                  $searchValue=json_decode($searchValue);
                  $query='';
                  $num=count($searchValue);
                      foreach($searchValue[0] as $key=>$value)
                           {
                              if($value!=""){
                                 $query=$query.$key.'='.$value.'&';
                              }
                           }
                  $query=rtrim($query, "&");
                   $response = $client->request('GET', ''.$baseURI.'/search?'.$query.'');
                   $result= $response->getBody();
                   $result = json_decode($result);
                   $totalRecords=count($result);
                   $results=array();
                   for($i=$page; $i<($page+6);$i++){
                        array_push($results,$result[$i]);
                    
                   }

                   $data=['searchResult'=>array_filter($results), 'baseUri'=>$baseURI,'totalRecords'=>$totalRecords];
                   $data = json_encode($data);  
                   print_r($data);
                  // echo 'hi';
               }
            }
         } catch (Error $e){

         }
       
     }
  //--------------------------------------------------------------------

   // function for searching Frame by inventory number 
   public function searchByInventoryNumber(){
    try{
       $baseURI = baseURI();
       $client = \Config\Services::curlrequest();
       if($this->request->getPost('data_action'))
       {
          $data_action= $this->request->getPost('data_action');
          $searchValue= $this->request->getPost('value');
          if($data_action == "fetch_frame_searching")
          {  
            $query=ltrim($searchValue, "L");
              $response = $client->request('GET', ''.$baseURI.'frames/'.$query.'');
              $result= $response->getBody();
              $result = json_decode($result);
              $data=['inventoryNumber'=>$result->inventoryNumber, 'baseUri'=>$baseURI,'totalRecords'=>1];
              $data = json_encode($data);
               // echo $response->getStatusCode();
               print_r($data);
              // echo 'hi';
          }
       }
    } catch (Error $e){
            print_r($e);
    }
  
}
//--------------------------------------------------------------------
  

// function for fetch multi select dropdwoun values.
public function multiDropdown(){
    try{
      $baseURI = baseURI();
      $client = \Config\Services::curlrequest();
      if($this->request->getPost('data_action'))
      {
         $data_action= $this->request->getPost('data_action');
         $dropdwonValue= $this->request->getPost('value');
         if($data_action == "fetch_dropdown_list")
         {
             $responseDropdown = $client->request('GET', ''.$baseURI.'reference/'.$dropdwonValue.'');
             $resultDropdown= $responseDropdown->getBody();
            if( $dropdwonValue!='corners'){
              $dropdownVarible=$dropdwonValue.'s';
            }else{ $dropdownVarible=$dropdwonValue;}
            $dropdownOption=array();
             $resultDropdown = json_decode($resultDropdown);
            for($i=0; $i<count($resultDropdown); $i++){
              array_push($dropdownOption, array("label"=>$resultDropdown[$i]->title,"value"=>"".$resultDropdown[$i]->id."",));
             
            }
            $results=[$dropdownSelectedValue,$dropdownOption,"dropdownListName"=>$dropdwonValue];
             echo json_encode( $results);
         }
      }
  } catch (Error $e){

  }
  }

 // function for upload artwork image.
 public function uploadArtwork(){
   try{
      $baseURI = baseURI();
      $session = \Config\Services::session();
        // $file =$_FILES["artFile"]["tmp_name"];
         // $path=FCPATH.'assets/img';
         $file= $this->request->getFile('artFile');
         $originalName = $file->getClientName();
         $tempfile = $file->getTempName();
         $data = file_get_contents($tempfile);
         $base64 = base64_encode($data);
         $artHeightWhole= (int)$this->request->getPost('artHeightInt');
         $artHeightFraction= (int)$this->request->getPost('sizeArtHeightFract');
         $artWidthWhole= (int)$this->request->getPost('artWidthInt');
         $artWidthFraction= (int)$this->request->getPost('sizeArtWidthFract');
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => ''.$baseURI.'images/art',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => array('file'=> new \CURLFILE($tempfile),'artHeightWhole' => $artHeightWhole, 'artHeightFraction' => $artHeightFraction,'artWidthWhole' => $artWidthWhole,'artWidthFraction' => $artWidthFraction)
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response);
            $fileName =$originalName;
             $sourceResult=['fileNmae'=>$fileName,'response'=>$response,'img'=>$base64] ;
             echo json_encode( $sourceResult);
            $session->set('upload_artwork', $sourceResult);
            //  print_r( $sourceResult);
            // $file->move($path);
         
   } catch (Error $e){
      die($e->getMessage());
   }
 
}

}
