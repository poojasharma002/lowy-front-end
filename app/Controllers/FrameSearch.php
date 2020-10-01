<?php namespace App\Controllers;

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
               print_r($data);
              // echo 'hi';
          }
       }
    } catch (Error $e){

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
            //  $response = $client->request('GET', ''.$baseURI.'frames/'.$inventoryNo.'');
            //  $result= $response->getBody();
            // $result = json_decode($result);
            if( $dropdwonValue!='corners'){
              $dropdownVarible=$dropdwonValue.'s';
            }else{ $dropdownVarible=$dropdwonValue;}
            
            //  $dropdownSelectedValueArr=$result->$dropdownVarible;
            //  $dropdownSelectedValue=array();
            //  for($j=0; $j<count($dropdownSelectedValueArr); $j++){
            //   array_push($dropdownSelectedValue,"".$dropdownSelectedValueArr[$j]->id."");
            //  }
            $dropdownOption=array();
             $resultDropdown = json_decode($resultDropdown);
            for($i=0; $i<count($resultDropdown); $i++){
              array_push($dropdownOption, array("label"=>$resultDropdown[$i]->title,"value"=>"".$resultDropdown[$i]->id."",));
             
            }
            // $results=[$dropdownSelectedValue,$dropdownOption,"dropdownListName"=>$dropdwonValue];
            $results=[$dropdownSelectedValue,$dropdownOption,"dropdownListName"=>$dropdwonValue];
             echo json_encode( $results);
         }
      }
  } catch (Error $e){

  }
  }
}
