<?php namespace App\Controllers;

class FrameList extends BaseController
{
    
	public function index()
	{
       echo view('frame_list');
	}
     public function action(){
         try{
            $client = \Config\Services::curlrequest();
            if($this->request->getPost('data_action'))
            {
               $data_action= $this->request->getPost('data_action');
   
               if($data_action == "fetch_frame_list")
               {
                   $response = $client->request('GET', 'http://52.14.43.85/frameapp/frames?startRow=0&numRows=200');
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
