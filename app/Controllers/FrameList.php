<?php namespace App\Controllers;

class FrameList extends BaseController
{
// show all Frame Inventory Details   
	public function index()
	{
       echo view('frame_list');
   }
   
   // function for fetch Frame inventory details 
     public function action(){
         try{
            $baseURI = baseURI();
            $client = \Config\Services::curlrequest();
            if($this->request->getPost('data_action'))
            {
               $data_action= $this->request->getPost('data_action');
   
               if($data_action == "fetch_frame_list")
               {
                   $response = $client->request('GET', ''.$baseURI.'frames?startRow=0&numRows=200');
                   $result= $response->getBody();
                   // $result = json_decode($result);
                  echo $result;
               }
            }
         } catch (Error $e){

         }
       
     }
	//--------------------------------------------------------------------

}
