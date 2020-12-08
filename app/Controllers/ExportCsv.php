<?php namespace App\Controllers;

class ExportCsv extends BaseController
{

   // Export data in CSV format 
   public function exportCSV(){ 
    // file name 
    $filename = 'Lowy_Front_End'.date('Ymd').'.csv'; 
    header("Content-Description: File Transfer"); 
    header("Content-Disposition: attachment; filename=$filename"); 
    header("Content-Type: application/csv; ");
    
    // get data 
    $baseURI = baseURI();
         $client = \Config\Services::curlrequest();
         //  $file = new \CodeIgniter\Files\File('result.json',false);
                $response = $client->request('GET', ''.$baseURI.'frames?startRow=0&numRows=10000');
                $result= $response->getBody();
                $result = json_decode($result);
            
    // file creation 
    $file = fopen('php://output', 'w');
  
    $header = array("InventoryNumber","Description","Century","CountryCode","FrameWidth","SightHeight","SightWidth","PurchaseDate","PairId","BuildingName","LocationName"); 
    fputcsv($file, $header);
       for($i=0; $i<count($result); $i++){
        $numlength = strlen((string)$result[$i]->inventoryNumber);
        if($numlength==1){ $invNo='L000'.$result[$i]->inventoryNumber;
        }elseif($numlength==2){ $invNo='L00'.$result[$i]->inventoryNumber;
        }elseif($numlength==3){ $invNo='L0'.$result[$i]->inventoryNumber; 
        }elseif($numlength>=4){ $invNo='L'.$result[$i]->inventoryNumber;  }
     $data=array($invNo,$result[$i]->description,$result[$i]->century,$result[$i]->countryCode,$result[$i]->frameWidth,$result[$i]->sightHeight,$result[$i]->sightWidth,$result[$i]->purchaseDate,$result[$i]->pairId,$result[$i]->buildingName,$result[$i]->locationName);
     fputcsv($file,$data); 
     }
    fclose($file); 
    echo 'hi';
    exit; 
   }
   
 }
 