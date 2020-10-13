<?php namespace App\Controllers;

class Categories extends BaseController
{
// show all Frame Inventory Details   
	public function index()
	{
       echo view('categories');
   }

    // function for fetch all  refrence data 
    public function action(){
      try{
         $baseURI = baseURI();
         $client = \Config\Services::curlrequest();
         if($this->request->getPost('data_action'))
         {
            $data_action= $this->request->getPost('data_action');
            $lookupValue= $this->request->getPost('value');
            if($data_action == "get_reference_data")
            {
              $response = $client->request('GET', ''.$baseURI.'reference/'.$lookupValue.'');
              $result= $response->getBody();
               echo $result;
            }
         }
      } catch (Error $e){

      }
    
  }

   //  function for add/edit frame refrence data.
   public function add_save(){
    try{
      $baseURI = baseURI();
      $ref_type=$this->request->getPost('ref_type');
      $id=$this->request->getPost('id');
      if($id==''){
        $data= '[{
          "id": null,
          "code":"'.$this->request->getPost('code').'",
          "title":"'.$this->request->getPost('title').'"
        }]';
      }
      else{ $data= '[{
        "id": '.$id.',
        "code":"'.$this->request->getPost('code').'",
        "title":"'.$this->request->getPost('title').'"
      }]';}
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => "".$baseURI."reference/".$ref_type."",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "PUT",
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
      ),
    ));
      $response = curl_exec($curl);
      $err = curl_error($curl);
      $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      curl_close($curl);
      if($httpcode=="200"){
         echo view('categories', ['lookupValue' => $ref_type, 'status_code'=>$httpcode]);
      }
       
    } catch (Error $e){

    }
  
}
   
 }
