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
               print_r($searchValue);
               if($data_action == "fetch_all_frame_searching")
               {
                  //  $response = $client->request('GET', ''.$baseURI.'frames?startRow=0&numRows=200');
                  //  $result= $response->getBody();
                   // $result = json_decode($result);
                  // print_r('hi');
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
