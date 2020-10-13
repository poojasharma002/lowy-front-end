<?php namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;
class FrameDetails extends BaseController
{
  // function for particuler inventory no deatils .
 	public function index()
	{
        try{
                $baseURI = baseURI();
                if($_GET['id']!=''){
                  $_GET['id']=ltrim($_GET['id'], "L");
                $client = \Config\Services::curlrequest();
                $response = $client->request('GET', ''.$baseURI.'frames/'.$_GET['id'].'');
                $result= $response->getBody();
                $result = json_decode($result);
                if($result->inventoryNumber!=0){
                $numlength = strlen((string)$_GET['id']);
                 if($numlength==1){ $imgNo='L000'.$_GET['id']; $invNo='000'.$_GET['id'];
                 }elseif($numlength==2){ $imgNo='L00'.$_GET['id']; $invNo='00'.$_GET['id'];
                 }elseif($numlength==3){ $imgNo='L0'.$_GET['id']; $invNo='0'.$_GET['id'];
                 }elseif($numlength>=4){ $imgNo='L'.$_GET['id']; $invNo=$_GET['id']; }
                $imgUrl=$baseURI.'/images/frames/web/'.$imgNo;
                echo view('frame_details', ['frameDetails' => $result, 'imgUrl'=>$imgUrl, 'imgNo'=>$imgNo, 'invNo'=>$invNo]);
              }else{
                $countryResponse = $client->request('GET', ''.$baseURI.'reference/country');
                $countryResult= $countryResponse->getBody();
                $countryResult = json_decode($countryResult);
                $makerResponse = $client->request('GET', ''.$baseURI.'reference/maker');
                $makerResult= $makerResponse->getBody();
                $makerResult = json_decode($makerResult);
                $buildingResponse = $client->request('GET', ''.$baseURI.'reference/building');
                $buildingResult= $buildingResponse->getBody();
                $buildingResult = json_decode($buildingResult);
                $sourceResponse = $client->request('GET', ''.$baseURI.'reference/source');
                $sourceResult= $sourceResponse->getBody();
                $sourceResult = json_decode($sourceResult);
                $numlength = strlen((string)$_GET['id']);
                if($numlength==1){ $imgNo='L000'.$_GET['id']; $invNo='000'.$_GET['id'];
                }elseif($numlength==2){ $imgNo='L00'.$_GET['id']; $invNo='00'.$_GET['id'];
                }elseif($numlength==3){ $imgNo='L0'.$_GET['id']; $invNo='0'.$_GET['id'];
                }elseif($numlength>=4){ $imgNo='L'.$_GET['id']; $invNo=$_GET['id'];   }
               $imgUrl=$baseURI.'/images/frames/web/'.$imgNo;
               echo view('frame_details_edit', ['frameDetails' => $result, 'country' =>$countryResult,
               'maker'=>$makerResult, 'building'=>$buildingResult,'source'=>$sourceResult,'imgUrl'=>$imgUrl, 'imgNo'=>$imgNo, 'invNo'=>$invNo]);
              }
              } else{
                echo view('frame_details');
              } 
          
        }catch (Error $e){

           }
  }
  // function for Edit frame Deatils show
     public function frame_get(){
         try{
            $baseURI = baseURI();
            $client = \Config\Services::curlrequest();
            $response = $client->request('GET', ''.$baseURI.'frames/'.$_GET['id'].'');
            $result= $response->getBody();
            $result = json_decode($result);
            $countryResponse = $client->request('GET', ''.$baseURI.'reference/country');
            $countryResult= $countryResponse->getBody();
            $countryResult = json_decode($countryResult);
            $makerResponse = $client->request('GET', ''.$baseURI.'reference/maker');
            $makerResult= $makerResponse->getBody();
            $makerResult = json_decode($makerResult);
            $buildingResponse = $client->request('GET', ''.$baseURI.'reference/building');
            $buildingResult= $buildingResponse->getBody();
            $buildingResult = json_decode($buildingResult);
            $sourceResponse = $client->request('GET', ''.$baseURI.'reference/source');
            $sourceResult= $sourceResponse->getBody();
            $sourceResult = json_decode($sourceResult);
            $numlength = strlen((string)$_GET['id']);
            if($numlength==1){ $imgNo='L000'.$_GET['id']; $invNo='000'.$_GET['id'];
            }elseif($numlength==2){ $imgNo='L00'.$_GET['id']; $invNo='00'.$_GET['id'];
            }elseif($numlength==3){ $imgNo='L0'.$_GET['id']; $invNo='0'.$_GET['id'];
            }elseif($numlength>=4){ $imgNo='L'.$_GET['id']; $invNo=$_GET['id'];
           }
           $imgUrl=$baseURI.'/images/frames/web/'.$imgNo;         
             echo view('frame_details_edit', ['frameDetails' => $result, 'country' =>$countryResult,
                       'maker'=>$makerResult, 'building'=>$buildingResult,'source'=>$sourceResult,
                       'imgUrl'=>$imgUrl, 'imgNo'=>$imgNo, 'invNo'=>$invNo]);
         } catch (Error $e){

         }
       
     }

    //  function for edit frame details.
     public function frame_edit(){
      try{
          if ($this->request->getMethod() === 'post')
            {
            
              $baseURI = baseURI();
              $todaydate = date('Y-m-d');
              $data= '{
              "id": "'.$this->request->getPost('id').'",
              "inventoryNumber":"'.$this->request->getPost('inventoryNumber').'",
              "pairId":"'.$this->request->getPost('pairInventoryNumber').'", 
              "consigned": "'.$this->request->getPost('consigned').'",
              "century": "'.$this->request->getPost('century').'",
              "countryId":"'.$this->request->getPost('countryLookup').'",
              "makerId": "'.$this->request->getPost('makerLookup').'",
              "sourceId": "'.$this->request->getPost('sourceLookup').'",
              "styles": ['.$this->request->getPost('__multiselect_styleLookups').'],
              "ornaments": ['.$this->request->getPost('__multiselect_ornamentLookups').'],
              "colors": ['.$this->request->getPost('__multiselect_colorLookups').'],
              "corners": ['.$this->request->getPost('__multiselect_cornerLookups').'], 
              "frameWidth": "'.$this->request->getPost('frameWidth').'",
              "sightHeight": "'.$this->request->getPost('sightHeight').'", 
              "sightWidth":"'.$this->request->getPost('sightWidth').'", 
              "priceUpdate":"'.$this->request->getPost('priceUpdate').'" ,
              "purchaseDate": "'.$this->request->getPost('purchaseDateAsString').'",
              "purchasePrice": "'.$this->request->getPost('purchasePrice').'", 
              "sellingPrice": "'.$this->request->getPost('sellingPrice').'",
              "status": 0, 
              "lastModified": "'.$todaydate.'",
              "deleted": 0, 
              "location": "'.$this->request->getPost('locationDescription').'", 
              "buildingId": "'.$this->request->getPost('locationBuildingLookup').'", 
              "note": "'.$this->request->getPost('locationInternalNotes').'",
              "defaultimageattribute":"'.$this->request->getPost('defaultImageAttribute').'" 
                }';
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => "".$baseURI."frames/".$this->request->getPost('inventoryNumber')."",
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
                  $inventoryNo=$this->request->getPost('inventoryNumber');
                  $client = \Config\Services::curlrequest();
                  $response = $client->request('GET', ''.$baseURI.'frames/'.$inventoryNo.'');
                  $result= $response->getBody();
                   $result = json_decode($result);
                   $numlength = strlen((string)$inventoryNo);
                    if($numlength==1){ $imgNo='L000'.$inventoryNo; $invNo='000'.$inventoryNo;
                    }elseif($numlength==2){ $imgNo='L00'.$inventoryNo; $invNo='00'.$inventoryNo;
                    }elseif($numlength==3){ $imgNo='L0'.$inventoryNo; $invNo='0'.$inventoryNo;
                    }elseif($numlength>=4){ $imgNo='L'.$inventoryNo; $invNo=$inventoryNo;
                  }
                  $imgUrl=$baseURI.'/images/frames/web/'.$imgNo;   
                   echo view('frame_details', ['frameDetails' => $result, 'status_code'=>$httpcode,
                             'imgUrl'=>$imgUrl, 'imgNo'=>$imgNo, 'invNo'=>$invNo]);
                  require_once(APPPATH.'Controllers/FrameList.php');
                  $aObj = new FrameList();
                  $aObj->json_create();
                 }

                }
      } catch (Error $e){

      }
     

      }
// function for fetch multi select dropdwoun values.
      public function multiDropdown(){
        try{
          $baseURI = baseURI();
          $client = \Config\Services::curlrequest();
          if($this->request->getPost('data_action'))
          {
             $data_action= $this->request->getPost('data_action');
             $dropdwonValue= $this->request->getPost('value');
             $inventoryNo= $this->request->getPost('id');
             if($data_action == "fetch_dropdown_list")
             {
                 $responseDropdown = $client->request('GET', ''.$baseURI.'reference/'.$dropdwonValue.'');
                 $resultDropdown= $responseDropdown->getBody();
                 $response = $client->request('GET', ''.$baseURI.'frames/'.$inventoryNo.'');
                 $result= $response->getBody();
                $result = json_decode($result);
                if( $dropdwonValue!='corners'){
                  $dropdownVarible=$dropdwonValue.'s';
                }else{ $dropdownVarible=$dropdwonValue;}
                
                 $dropdownSelectedValueArr=$result->$dropdownVarible;
                 $dropdownSelectedValue=array();
                 for($j=0; $j<count($dropdownSelectedValueArr); $j++){
                  array_push($dropdownSelectedValue,"".$dropdownSelectedValueArr[$j]->id."");
                 }
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
	//--------------------------------------------------------------------

}
