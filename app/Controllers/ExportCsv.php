<?php namespace App\Controllers;

class ExportCsv extends BaseController
{

   // Export data in CSV format 
   public function createJsonFile(){ 
   
        // $result= $this->getInventoryNumber($_GET['startRow'],$_GET['endRow']); 
        // if(!empty($result)){
        //   if($_GET['startRow']==0){
        //   unlink('./exportCsvData.json');
        //   }else{
        //     $json = file_get_contents('./exportCsvData.json');
        //     $obj  = json_decode($json);
        //   }
          
        //   $data=array();
        $baseURI = baseURI();
        $client = \Config\Services::curlrequest();
      //   for($i=0; $i< count($result); $i++){  
        $responseDetails = $client->request('GET', ''.$baseURI.'frames/inv');
        $resultDetails= $responseDetails->getBody();
        $resultDetails = json_decode($resultDetails);
      //   array_push($data,$resultDetails); 
      //  }

      //  if(!empty($obj)){$totalData=array_merge($obj,$data);}else{$totalData=$data;}
        write_file('./exportCsvData.json',json_encode($resultDetails), 'w');
      //   }
        
   }
   public function getInventoryNumber($startRow,$endRow){ 
        // get data 
        $baseURI = baseURI();
        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', ''.$baseURI.'/frames/?startRow='.$startRow.'&numRows='.$endRow.'');
        $result= $response->getBody();
        $result = json_decode($result);
        return $result;
   }
   

   public function exportCSV(){ 
         // file name 
    $filename = 'Lowy_Front_End_'.date('Ymd').'.csv'; 
    header("Content-Description: File Transfer"); 
    header("Content-Disposition: attachment; filename=$filename"); 
    header("Content-Type: application/csv; ");
    // file creation 
    $file = fopen('php://output', 'w');
  
    $header = array("FrameNumber","Century","Country","Maker","Pair","Style","Ornament","Colors","Corners","FrameWidth","SightHeight","SightWidth","Source","ThirdParty","PurchaseDate","PriceUpdate","PurchasePrice","SellPrice","Location","BuildingName","Note","LastModified","Deleted"); 
    fputcsv($file, $header);
     $json = file_get_contents('./exportCsvData.json');
             $result  = json_decode($json);
            for($i=0; $i<count($result); $i++){
          $numlength = strlen((string)$result[$i]->inventoryNumber);
          if($numlength==1){ $invNo='L000'.$result[$i]->inventoryNumber;
          }elseif($numlength==2){ $invNo='L00'.$result[$i]->inventoryNumber;
          }elseif($numlength==3){ $invNo='L0'.$result[$i]->inventoryNumber; 
          }elseif($numlength>=4){ $invNo='L'.$result[$i]->inventoryNumber;  }
    $styles='';
  for($j=0; $j<count($result[$i]->styles); $j++){
   if($j==0){
        $styles=$result[$i]->styles[$j]->title;
    }elseif($j>0){
        $styles= $styles.', '.$result[$i]->styles[$j]->title;
    } 
} 
    $ornaments='';
    for($k=0; $k<count($result[$i]->ornaments); $k++){
       if($k==0){
            $ornaments=$result[$i]->ornaments[$k]->title;
        }elseif($k>0){
            $ornaments= $ornaments.', '.$result[$i]->ornaments[$k]->title;
        } 
    }
    $colors='';
    for($l=0; $l<count($result[$i]->colors); $l++){
       if($l==0){
            $colors=$result[$i]->colors[$l]->title;
        }elseif($l>0){
            $colors= $colors.', '.$result[$i]->colors[$l]->title;
        } 
    } 
    $corners='';
    for($m=0; $m<count($result[$i]->corners); $m++){
       if($m==0){
            $corners=$result[$i]->corners[$m]->title;
        }elseif($m>0){
            $corners= $corners.', '.$result[$i]->corners[$m]->title;
        } 
    }  
                                    if($result[$i]->consigned==0){ $thirdParty='None';}
                                    elseif($result[$i]->consigned==1){$thirdParty='Consigned';}
                                    elseif($result[$i]->consigned==2){$thirdParty='Partnered';}    
                                   if($result[$i]->deleted==true){ $deleted= "Yes"; }else{$deleted="No";}
                                //    $baseURI = baseURI();
                                //    $imageNotMissing=  $this->getMissingImage($result[$i]->inventoryNumber);
                                //   if($imageNotMissing==true){
                                //     $imgUrl=$baseURI.'/images/frames/web/'.$invNo;
                                //   }else{$imgUrl='Missing Image';}                  
       $data=array($invNo,$result[$i]->century,$result[$i]->countryName,$result[$i]->makerName,$result[$i]->pairId,$styles,$ornaments,$colors,$corners,$result[$i]->frameWidth,$result[$i]->sightHeight,$result[$i]->sightWidth,$result[$i]->sourceName,$thirdParty,$result[$i]->purchaseDate,$result[$i]->priceUpdate,$result[$i]->purchasePrice,$result[$i]->sellingPrice,$result[$i]->locationName,$result[$i]->buildingName,$result[$i]->note,$result[$i]->lastModified,$deleted);
       fputcsv($file,$data); 
         }
      fclose($file); 
     
    exit; 
   }

   public function getMissingImage($inventoryNumber){ 
    $baseURI = baseURI(); 
    $client = \Config\Services::curlrequest();
    $responseMissingImage = $client->request('GET', ''.$baseURI.'/images/frames/missingimages');
     $resultMissingImage= $responseMissingImage->getBody();
     $resultMissingImage = json_decode($resultMissingImage);
     $filterValue = array_filter($resultMissingImage, function ($var) use ($inventoryNumber) {
        if($var->inventoryNumber == $inventoryNumber){
            return true;
        }else {
            return false; 
        }
          
    });
    if(empty($filterValue)){
        return true; 
    }else{return false; }
    
     
   }

 }
 