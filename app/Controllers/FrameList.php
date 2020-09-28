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
                   $response = $client->request('GET', ''.$baseURI.'frames?startRow=0&numRows=6000');
                   $result= $response->getBody();
                   // $result = json_decode($result);
                  echo $result;
               }
            }
         } catch (Error $e){

         }
       
     }
   //--------------------------------------------------------------------
     // function for create json data file  
     public function json_create(){
      try{
         $baseURI = baseURI();
         $client = \Config\Services::curlrequest();
         //  $file = new \CodeIgniter\Files\File('result.json',false);
                $response = $client->request('GET', ''.$baseURI.'frames?startRow=0&numRows=10000');
                $result= $response->getBody();
                $result = json_decode($result);
              for($i=0; $i<count($result); $i++){
               $numlength = strlen((string)$result[$i]->inventoryNumber);
               if($numlength==1){ $invNo='L000'.$result[$i]->inventoryNumber;
               }elseif($numlength==2){ $invNo='L00'.$result[$i]->inventoryNumber;
               }elseif($numlength==3){ $invNo='L0'.$result[$i]->inventoryNumber; 
               }elseif($numlength>=4){ $invNo='L'.$result[$i]->inventoryNumber;  }
               $frames[] = array(
                'inventoryNumber'  => "<a href ='".base_url()."/frameAdminView.action?id=".$result[$i]->inventoryNumber."'>".$invNo."</a>",
                'description'      => $result[$i]->description,
                'century'          => $result[$i]->century,
                'countryCode'      => $result[$i]->countryCode,
                'frameWidth'       => $result[$i]->frameWidth,
                'sightHeight'      => $result[$i]->sightHeight,
                'sightWidth'       => $result[$i]->sightWidth,
                'purchaseDate'     => $result[$i]->purchaseDate,
                'pairId'           => $result[$i]->pairId,
                'buildingName'     => $result[$i]->buildingName,
                'locationName'     => $result[$i]->locationName
            );
            } 
      

            $responseData['data'] = $frames;
            write_file('./results.json',json_encode($responseData), 'w');
            
      } catch (Error $e){

      }
    
  }
//--------------------------------------------------------------------
   

}
