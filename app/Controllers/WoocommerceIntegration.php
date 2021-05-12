<?php namespace App\Controllers;

class WoocommerceIntegration extends BaseController
{

    public function insertProduct(){
      $baseURI = baseURI();
      $client = \Config\Services::curlrequest();
      // $responseDetails = $client->request('GET', ''.$baseURI.'frames/inv');
      // $resultDetails= $responseDetails->getBody();
      // $result = json_decode($resultDetails);
       $json = file_get_contents('./exportCsvData.json');
       $result  = json_decode($json);
       for($i=$_GET['start']; $i<$_GET['end']; $i++){
        if($result[$i]->activeStatus==true && $result[$i]->imageURL!=''){
        $numlength = strlen((string)$result[$i]->inventoryNumber);
        if($numlength==1){ $invNo='L000'.$result[$i]->inventoryNumber;
        }elseif($numlength==2){ $invNo='L00'.$result[$i]->inventoryNumber;
        }elseif($numlength==3){ $invNo='L0'.$result[$i]->inventoryNumber; 
        }elseif($numlength>=4){ $invNo='L'.$result[$i]->inventoryNumber;  }
              $century= $result[$i]->century.'th Century';
              $countryName=$result[$i]->countryName;
              $frameWidth=$result[$i]->frameWidth;
              $sightHeight=$result[$i]->sightHeight;
              $sightWidth=$result[$i]->sightWidth;
              $sellingPrice=$result[$i]->sellingPrice;
              $makerName=$result[$i]->makerName;
              $sourceName=$result[$i]->sourceName;
              $attributes=[];
              $styles=[];
              $ornaments=[];
              $colors=[];
              $corners=[];
              for($j=0; $j<count($result[$i]->styles); $j++){
                array_push($styles,(string)$result[$i]->styles[$j]->title);
            } 
               
                for($k=0; $k<count($result[$i]->ornaments); $k++){
                  array_push($ornaments,(string)$result[$i]->ornaments[$k]->title);
                }
               
                for($l=0; $l<count($result[$i]->colors); $l++){
                    array_push($colors,(string)$result[$i]->colors[$l]->title);
                } 
                for($m=0; $m<count($result[$i]->corners); $m++){
                    array_push($corners,(string)$result[$i]->corners[$m]->title);
                } 
                if(count($styles)>0){$styleVal=$styles[0];} else{$styleVal='';}
                if(count($ornaments)>0){$ornamentVal=$ornaments[0];} else{$ornamentVal='';}
                if(count($colors)>0){$colorVal=$colors[0];} else{$colorVal='';}
                if($result[$i]->makerName!=''){$makerName=$result[$i]->makerName;} else{$makerName='';}
                $productNmae=$result[$i]->countryName.' '.$result[$i]->century.'th Century'.' '.$makerName.' '.$styleVal.' '.$ornamentVal.'  '.$colorVal.' '.'Frame';
                array_push($attributes, array(
                  "id"=> 13,
                  "position" => 1,
                  "visible"=>"true",
                  "options"=> [
                    (string)$countryName
                    ]));
             array_push($attributes, array(
                        "id"=> 1,
                        "position" => 1,
                        "visible"=>"true",
                        "options"=> [
                          (string)$century
                          ]));
                         
            if(!empty($colors)){
              array_push($attributes, [
                "id"=> 6,
                "position" => 1,
                "visible"=>"true",
                "options"=>$colors
                  ]) ;
            } if(!empty($styles))
            {
              array_push($attributes, [
                "id"=> 4,
                "position" => 1,
                "visible"=>"true",
                "options"=>$styles
                  ]) ;
            } if(!empty($ornaments))
            {
              array_push($attributes, [
                "id"=> 5,
                "position" => 1,
                "visible"=>"true",
                "options"=>$ornaments
                  ]) ;
            } if(!empty($corners))
            {
              array_push($attributes, [
                "id"=> 11,
                "position" => 1,
                "visible"=>"true",
                "options"=>$corners
                  ]) ;
            }
            if(!empty($makerName))
            {
              array_push($attributes, [
                "id"=> 2,
                "position" => 1,
                "visible"=>"true",
                "options"=>[(string)$makerName]
                
                  ]) ;
            }
            array_push($attributes, array(
              "id"=> 7,
              "position" => 1,
              "visible"=>"true",
              "options"=> [
                (string)$frameWidth
                ]));
                array_push($attributes, array(
                  "id"=> 8,
                  "position" => 1,
                  "visible"=>"true",
                  "options"=> [
                    (string)$sightHeight
                    ]));
                    array_push($attributes, array(
                      "id"=> 9,
                      "position" => 1,
                      "visible"=>"true",
                      "options"=> [
                       (string)$sightWidth
                        ]));
                 array_push($attributes, array(
                          "id"=> 16,
                          "position" => 1,
                          "visible"=>"true",
                          "options"=> [
                           (string)$sellingPrice
                            ])); 
    if($result[$i]->century=="21"){$category=1682;}else{ $category=24; } 
    $slug=str_replace(' ', '-', preg_replace('/\s+/', ' ', $productNmae));      
    $url = 'https://staging15.lowy1907.com/antique-picture-frames/'.strtolower($invNo.'/'.$slug);
   $data= ["name" =>$productNmae,
      "type"=>"simple",
      "sku"=>$invNo,
      "permalink"=>$url,
      "slug"=>$slug,
      "stock_quantity"=> 1,
      "categories"=> [
        [
          "id"=>$category
        ]
      ],
      'images' => [
        [
            'src' => $result[$i]->imageURL
        ]
        ],
        "attributes"=>$attributes
              ];
     $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://staging15.lowy1907.com/wp-json/wc/v3/products?consumer_key=ck_9d78fc365b45d234a132cc51e57c80b37e2224bf&consumer_secret=cs_830f033b32c54bd745a2681b30d07fae33062cec");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    
    curl_setopt($ch, CURLOPT_POST, TRUE);
    
    curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "Content-Type: application/json"
    ));
    
    $response = curl_exec($ch);
    $response =json_decode($response);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err = curl_error($ch);
    if($httpcode=='400'){
     $resource_id= $response->data->resource_id;
     $curl = curl_init();
     curl_setopt_array($curl, array(
       CURLOPT_URL => "https://staging15.lowy1907.com/wp-json/wc/v3/products/$resource_id?consumer_key=ck_9d78fc365b45d234a132cc51e57c80b37e2224bf&consumer_secret=cs_830f033b32c54bd745a2681b30d07fae33062cec",
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_ENCODING => "",
       CURLOPT_MAXREDIRS => 10,
       CURLOPT_TIMEOUT => 30,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => "PUT",
       CURLOPT_POSTFIELDS => json_encode($data),
       CURLOPT_HTTPHEADER => array(
         "cache-control: no-cache",
         "content-type: application/json"
       ),
     ));
     
     $responseUpdate = curl_exec($curl);
     $responseUpdate =json_decode($responseUpdate);
     echo "Product Update======= Product Id =".$responseUpdate->id.", ". "SKU =".$responseUpdate->sku."</br>";
    }else if($httpcode=="201"){
      echo "Product Insert======= Product Id =".$response->id.", ". "SKU =".$response->sku."</br>";
    }
    curl_close($ch);
    }
    
  }
    }
	

    public function insertProductAuto(){
      $baseURI = baseURI();
      $currentDate=date("Y-m-d");
      $client = \Config\Services::curlrequest();
      $responseDetails = $client->request('GET', ''.$baseURI.'frames/inv');
      $resultDetails= $responseDetails->getBody();
      $result = json_decode($resultDetails);
      //  $json = file_get_contents('./exportCsvData.json');
      //  $result  = json_decode($json);
       for($i=0; $i<count($result); $i++){
        $numlength = strlen((string)$result[$i]->inventoryNumber);
        if($numlength==1){ $invNo='L000'.$result[$i]->inventoryNumber;
        }elseif($numlength==2){ $invNo='L00'.$result[$i]->inventoryNumber;
        }elseif($numlength==3){ $invNo='L0'.$result[$i]->inventoryNumber; 
        }elseif($numlength>=4){ $invNo='L'.$result[$i]->inventoryNumber;  }
        if($result[$i]->activeStatus==true && $result[$i]->lastModified == $currentDate && $result[$i]->imageURL!=''){
              $century= $result[$i]->century.'th Century';
              $countryName=$result[$i]->countryName;
              $frameWidth=$result[$i]->frameWidth;
              $sightHeight=$result[$i]->sightHeight;
              $sightWidth=$result[$i]->sightWidth;
              $sellingPrice=$result[$i]->sellingPrice;
              $makerName=$result[$i]->makerName;
              $sourceName=$result[$i]->sourceName;
              $attributes=[];
              $styles=[];
              $ornaments=[];
              $colors=[];
              $corners=[];
              for($j=0; $j<count($result[$i]->styles); $j++){
                array_push($styles,(string)$result[$i]->styles[$j]->title);
            } 
               
                for($k=0; $k<count($result[$i]->ornaments); $k++){
                  array_push($ornaments,(string)$result[$i]->ornaments[$k]->title);
                }
               
                for($l=0; $l<count($result[$i]->colors); $l++){
                    array_push($colors,(string)$result[$i]->colors[$l]->title);
                } 
                for($m=0; $m<count($result[$i]->corners); $m++){
                    array_push($corners,(string)$result[$i]->corners[$m]->title);
                } 
                if(count($styles)>0){$styleVal=$styles[0];} else{$styleVal='';}
                if(count($ornaments)>0){$ornamentVal=$ornaments[0];} else{$ornamentVal='';}
                if(count($colors)>0){$colorVal=$colors[0];} else{$colorVal='';}
                if($result[$i]->makerName!=''){$makerName=$result[$i]->makerName;} else{$makerName='';}
                $productNmae=$result[$i]->countryName.' '.$result[$i]->century.'th Century'.' '.$makerName.' '.$styleVal.' '.$ornamentVal.'  '.$colorVal.' '.'Frame';
                array_push($attributes, array(
                  "id"=> 13,
                  "position" => 1,
                  "visible"=>"true",
                  "options"=> [
                    (string)$countryName
                    ]));
             array_push($attributes, array(
                        "id"=> 1,
                        "position" => 1,
                        "visible"=>"true",
                        "options"=> [
                          (string)$century
                          ]));
                         
            if(!empty($colors)){
              array_push($attributes, [
                "id"=> 6,
                "position" => 1,
                "visible"=>"true",
                "options"=>$colors
                  ]) ;
            } if(!empty($styles))
            {
              array_push($attributes, [
                "id"=> 4,
                "position" => 1,
                "visible"=>"true",
                "options"=>$styles
                  ]) ;
            } if(!empty($ornaments))
            {
              array_push($attributes, [
                "id"=> 5,
                "position" => 1,
                "visible"=>"true",
                "options"=>$ornaments
                  ]) ;
            } if(!empty($corners))
            {
              array_push($attributes, [
                "id"=> 11,
                "position" => 1,
                "visible"=>"true",
                "options"=>$corners
                  ]) ;
            }
            if(!empty($makerName))
            {
              array_push($attributes, [
                "id"=> 2,
                "position" => 1,
                "visible"=>"true",
                "options"=>[(string)$makerName]
                
                  ]) ;
            }
            array_push($attributes, array(
              "id"=> 7,
              "position" => 1,
              "visible"=>"true",
              "options"=> [
                (string)$frameWidth
                ]));
                array_push($attributes, array(
                  "id"=> 8,
                  "position" => 1,
                  "visible"=>"true",
                  "options"=> [
                    (string)$sightHeight
                    ]));
                    array_push($attributes, array(
                      "id"=> 9,
                      "position" => 1,
                      "visible"=>"true",
                      "options"=> [
                       (string)$sightWidth
                        ]));
                 array_push($attributes, array(
                          "id"=> 16,
                          "position" => 1,
                          "visible"=>"true",
                          "options"=> [
                           (string)$sellingPrice
                            ])); 
    if($result[$i]->century=="21"){$category=1682;}else{ $category=24; }                          
    $slug=str_replace(' ', '-', preg_replace('/\s+/', ' ', $productNmae));      
    $url = 'https://staging15.lowy1907.com/antique-picture-frames/'.strtolower($invNo.'/'.$slug);
   $data= ["name" =>$productNmae,
      "type"=>"simple",
      "sku"=>$invNo,
      "permalink"=>$url,
      "slug"=>$slug,
      "stock_quantity"=> 1,
      "categories"=> [
        [
          "id"=>$category
        ]
      ],
      'images' => [
        [
            'src' => $result[$i]->imageURL
        ]
        ],
        "attributes"=>$attributes
              ];
     $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://staging15.lowy1907.com/wp-json/wc/v3/products?consumer_key=ck_9d78fc365b45d234a132cc51e57c80b37e2224bf&consumer_secret=cs_830f033b32c54bd745a2681b30d07fae33062cec");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    
    curl_setopt($ch, CURLOPT_POST, TRUE);
    
    curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "Content-Type: application/json"
    ));
    
    $response = curl_exec($ch);
    $response =json_decode($response);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err = curl_error($ch);
    if($httpcode=='400'){
     $resource_id= $response->data->resource_id;
     $curl = curl_init();
     curl_setopt_array($curl, array(
       CURLOPT_URL => "https://staging15.lowy1907.com/wp-json/wc/v3/products/$resource_id?consumer_key=ck_9d78fc365b45d234a132cc51e57c80b37e2224bf&consumer_secret=cs_830f033b32c54bd745a2681b30d07fae33062cec",
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_ENCODING => "",
       CURLOPT_MAXREDIRS => 10,
       CURLOPT_TIMEOUT => 30,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => "PUT",
       CURLOPT_POSTFIELDS => json_encode($data),
       CURLOPT_HTTPHEADER => array(
         "cache-control: no-cache",
         "content-type: application/json"
       ),
     ));
     
     $responseUpdate = curl_exec($curl);
     $responseUpdate =json_decode($responseUpdate);
     echo "Product Update======= Product Id =".$responseUpdate->id.", ". "SKU =".$responseUpdate->sku."</br>";
    }else if($httpcode=="201"){
      echo "Product Insert======= Product Id =".$response->id.", ". "SKU =".$response->sku."</br>";
    }
    curl_close($ch);
    }else if($result[$i]->lastModified == $currentDate && ($result[$i]->activeStatus==false || $result[$i]->imageURL=='')){
      $responseProductId = $client->request('GET', 'https://staging15.lowy1907.com/wp-json/api/v3/product?sku='.$invNo);
      $resultId= $responseProductId->getBody();
      $resultId = json_decode($resultId);
     if($resultId!=''){
      $curl = curl_init();
      $productId=$resultId;
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://staging15.lowy1907.com/wp-json/wc/v3/products/$productId?force=true&consumer_key=ck_9d78fc365b45d234a132cc51e57c80b37e2224bf&consumer_secret=cs_830f033b32c54bd745a2681b30d07fae33062cec",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "DELETE",
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
        ),
      ));
      
      $response = curl_exec($curl);
      $response =json_decode($response);
      $err = curl_error($curl);
      echo "Product Delete======= Product Id =".$productId.", ". "SKU =".$response->sku."</br>";
      curl_close($curl);
     }
    
    
}
  }
    }
function deleteInActiveProduct(){
  $client = \Config\Services::curlrequest();
  $json = file_get_contents('./exportCsvData.json');
  $result  = json_decode($json);
  for($i=$_GET['start']; $i<$_GET['end']; $i++){
   $numlength = strlen((string)$result[$i]->inventoryNumber);
  
   if($numlength==1){ $invNo='L000'.$result[$i]->inventoryNumber;
   }elseif($numlength==2){ $invNo='L00'.$result[$i]->inventoryNumber;
   }elseif($numlength==3){ $invNo='L0'.$result[$i]->inventoryNumber; 
   }elseif($numlength>=4){ $invNo='L'.$result[$i]->inventoryNumber;  }
  
   if($result[$i]->activeStatus== false || $result[$i]->imageURL==''){
   
      $responseProductId = $client->request('GET', 'https://staging15.lowy1907.com/wp-json/api/v3/product?sku='.$invNo);
      $resultId= $responseProductId->getBody();
      $resultId = json_decode($resultId);
     if($resultId!=''){
      $curl = curl_init();
      $productId=$resultId;
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://staging15.lowy1907.com/wp-json/wc/v3/products/$productId?force=true&consumer_key=ck_9d78fc365b45d234a132cc51e57c80b37e2224bf&consumer_secret=cs_830f033b32c54bd745a2681b30d07fae33062cec",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "DELETE",
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
        ),
      ));
      
      $response = curl_exec($curl);
      $response =json_decode($response);
      $err = curl_error($curl);
      echo "Product Delete======= Product Id =".$productId.", ". "SKU =".$response->sku."</br>";
      curl_close($curl);
     }
    

    }
   
  }
}

}
