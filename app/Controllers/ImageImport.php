<?php namespace App\Controllers;

class ImageImport extends BaseController
{
// show all Frame import Images.   
	public function index()
	{
        $baseURI = baseURI();
        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', ''.$baseURI.'images/frames/import');
        $result= $response->getBody();
        $result = json_decode($result);
       echo view('image_import', ['importImageList' => $result, 'baseUri'=>$baseURI]);
   }
   
   // function for import image
   public function action(){
    try{
       $baseURI = baseURI();
       $client = \Config\Services::curlrequest();
       if($this->request->getPost('data_action'))
       {
          $data_action= $this->request->getPost('data_action');
          $inventoryNumber= $this->request->getPost('inventoryNumber');
          if($data_action == "import_image")
          {
              $data='[{"inventoryNumber": "'.$inventoryNumber.'"}]';
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "".$baseURI."images/frames/import?action=import",
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
              // $result = json_decode($result);
             echo $response;
          }
       }
    } catch (Error $e){

    }
  
}

}
