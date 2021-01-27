<?php  echo view('templates/header');
echo link_tag('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'); 
// echo link_tag('assets/css/animate.min.css'); 
echo script_tag('assets/js/notification.js');
echo link_tag('assets/css/jquery-confirm.min.css'); 
echo script_tag('assets/js/jquery-confirm.min.js');?>
<script>
$(document).ready(function(){  
  $(".nav-link").removeClass("active");
    $(".tab-pane").removeClass("active");
    $(".tab-pane").removeClass("show");
    $('.import').addClass("active");
    $('#import').addClass("active");
    $('#import').addClass("show");
    $('#example').dataTable( {
    "pageLength": 1
});
   });
 </script>
<style>
.frameSoldWrapper{
  font-weight: 700;
}
#successMessages, #errorMessages{
  z-index:1;
}

.table td  {
    vertical-align: middle;
    border: none;
}
</style>
 <!-- Tab panes -->
 <div class="tab-content">
 <div id="cover-spin" class=""><strong class="loading-text">Please Wait...</strong></div>
 <div id="successMessages"></div>
 <div id="errorMessages"></div>
    <div id="import" class="container tab-pane fade"><br>
        <h3 style="text-align: center;">List of new images:</h3>
        <div style="text-align: center;"><button onclick="importAllImage();">Import All On Page</button></div>
        </br>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead style="display:none;">
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php 
        for($i=0; $i<count($importImageList);$i++){
         $numlength = strlen((string)$importImageList[$i]->inventoryNumber);
                if($numlength==1){ $imgNo='L000'.$importImageList[$i]->inventoryNumber; $invNo='000'.$importImageList[$i]->inventoryNumber;
                }elseif($numlength==2){ $imgNo='L00'.$importImageList[$i]->inventoryNumber; $invNo='00'.$importImageList[$i]->inventoryNumber;
                }elseif($numlength==3){ $imgNo='L0'.$importImageList[$i]->inventoryNumber; $invNo='0'.$importImageList[$i]->inventoryNumber;
                }elseif($numlength>=4){ $imgNo='L'.$importImageList[$i]->inventoryNumber; $invNo=$importImageList[$i]->inventoryNumber;   }?>
        <tr>
           <td><?= $importImageList[$i]->sequenceNumber;?></td>
           <td style="width: 275px;"><img src="<?= $baseUri; ?>images/frames/web-tmp/<?= $imgNo ?>" width="200"> <span class="frameSoldWrapper" style="margin-left: 75px;"><?= $invNo; ?></span></td>
           <td><div class="summarydetails">
                            <span class="frameSoldWrapper"><?= $imgNo; ?></span>
                            <br>
                            <?= $importImageList[$i]->summary;?>
                            <!-- 19CFRRGDCCC612ST42X35/12<br>
                            AM0589T58P20T                            -->
                        </div></td>
           <td><button onclick="importImage(<?= $invNo; ?>);">Import</button></td>
           </tr>
           
        <?php }?>
           
        </tbody>
        
    </table>
        </div>
 </div>
 </main>
  <?php echo view('templates/footer');?>
   <script type="text/javascript" language="javascript">
  function importImage(invNo){
    $.confirm({
    title: 'Import Image?',
    content: 'You Want to import this Image.',
    autoClose: 'no|8000',
    buttons: {
      yes: {
            text: 'Yes',
            action: function () {
                  console.log();
                  $('#cover-spin').show(0);
                    $.ajax({
                        url:"<?php echo base_url(); ?>/ImageImport/action",
                        method:"POST",
                        data:{data_action:'import_image', inventoryNumber:invNo},
                        success:function(data){
                          $('#cover-spin').hide(0);
                          jQuery(".page-item.active .page-link").css('z-index','0'); 
                          var importImage= $.parseJSON(data)
                          
                          if(importImage[0].importStatus=='Imported'){
                            createAlert('','Import Image!','Frame image import Successfully!.','success',true,true,'successMessages');
                          }else{
                            createAlert('Opps!','Something went wrong','Frame image not found.','danger',true,true,'errorMessages');
                          }
                        }
                  })
            }
        },
        no: function () {
            // $.alert('action is canceled');
        }
    }
});
    
  }

  function importAllImage(){
    $.confirm({
    title: 'Are you sure?',
    content: 'You Want to import All Images.',
    autoClose: 'no|8000',
    buttons: {
      yes: {
            text: 'Yes',
            action: function () {
                  console.log();
                  $('#cover-spin').show(0);
                    $.ajax({
                        url:"<?php echo base_url(); ?>/ImageImport/AllImageImport",
                        method:"POST",
                        data:{data_action:'importAll_image'},
                        success:function(data){
                          console.log(data);
                          $('#cover-spin').hide(0);
                          jQuery(".page-item.active .page-link").css('z-index','0'); 
                          var importImage= $.parseJSON(data)
                          
                          if(importImage[0].importStatus=='Imported'){
                            createAlert('','Import Images!','Frame images import Successfully!.','success',true,true,'successMessages');
                          }else{
                            createAlert('Opps!','Something went wrong','Frame images not found.','danger',true,true,'errorMessages');
                          }
                        }
                  })
            }
        },
        no: function () {
            // $.alert('action is canceled');
        }
    }
});
    
  }
  setInterval(function(){$('#cover-spin').hide(0);}, 3000);
</script>