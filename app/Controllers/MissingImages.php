<?php namespace App\Controllers;

class MissingImages extends BaseController
{
// show all missing images   
	public function index()
	{
       echo view('missing_images');
   }
   
    // function for fetch missing images
    public function action(){
        try{
           $baseURI = baseURI();
           $client = \Config\Services::curlrequest();
           if($this->request->getPost('data_action'))
           {
              $data_action= $this->request->getPost('data_action');
  
              if($data_action == "fetch_missing_images_list")
              {
                  $response = $client->request('GET', ''.$baseURI.'/images/frames/missingimages');
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
