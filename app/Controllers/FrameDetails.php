<?php namespace App\Controllers;

class FrameDetails extends BaseController
{
   	public function index()
	{
        try{
              if($_GET['id']!=''){
                $client = \Config\Services::curlrequest();
                $response = $client->request('GET', 'http://52.14.43.85/frameapp/frames/'.$_GET['id'].'');
                $result= $response->getBody();
                 $result = json_decode($result);
                 echo view('frame_details', ['frameDetails' => $result]);
              } else{
                echo view('frame_details');
              } 
          
        }catch (Error $e){

           }
	}
     public function frame_get(){
         try{
            $client = \Config\Services::curlrequest();
            $response = $client->request('GET', 'http://52.14.43.85/frameapp/frames/'.$_GET['id'].'');
            $result= $response->getBody();
            $result = json_decode($result);
            $countryResponse = $client->request('GET', 'http://52.14.43.85/frameapp/reference/country');
            $countryResult= $countryResponse->getBody();
            $countryResult = json_decode($countryResult);
            $makerResponse = $client->request('GET', 'http://52.14.43.85/frameapp/reference/maker');
            $makerResult= $makerResponse->getBody();
            $makerResult = json_decode($makerResult);
            $colorResponse = $client->request('GET', 'http://52.14.43.85/frameapp/reference/color');
            $colorResult= $colorResponse->getBody();
            $colorResult = json_decode($colorResult);
            $cornersResponse = $client->request('GET', 'http://52.14.43.85/frameapp/reference/corners');
            $cornersResult= $cornersResponse->getBody();
            $cornersResult = json_decode($cornersResult);
            $styleResponse = $client->request('GET', 'http://52.14.43.85/frameapp/reference/style');
            $styleResult= $styleResponse->getBody();
            $styleResult = json_decode($styleResult);
            $ornamentResponse = $client->request('GET', 'http://52.14.43.85/frameapp/reference/ornament');
            $ornamentResult= $ornamentResponse->getBody();
            $ornamentResult = json_decode($ornamentResult);
            $buildingResponse = $client->request('GET', 'http://52.14.43.85/frameapp/reference/building');
            $buildingResult= $buildingResponse->getBody();
            $buildingResult = json_decode($buildingResult);
            $sourceResponse = $client->request('GET', 'http://52.14.43.85/frameapp/reference/source');
            $sourceResult= $sourceResponse->getBody();
            $sourceResult = json_decode($sourceResult);
                     
             echo view('frame_details_edit', ['frameDetails' => $result, 'country' =>$countryResult, 'style'=> $styleResult,
                       'maker'=>$makerResult, 'color'=>$colorResult, 'corners'=>$cornersResult, 'ornament'=>$ornamentResult,
                       'building'=>$buildingResult,'source'=>$sourceResult]);
         } catch (Error $e){

         }
       
     }
	//--------------------------------------------------------------------

}
