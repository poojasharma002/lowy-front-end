<?php  echo view('templates/header'); ?>
<script>
$(document).ready(function(){  
  $(".nav-link").removeClass("active");
    $(".tab-pane").removeClass("active");
    $(".tab-pane").removeClass("show");
    $('.missingImages').addClass("active");
    $('#img_missing').addClass("active");
    $('#img_missing').addClass("show");
   });
</script>
 <!-- Tab panes -->
 <div class="tab-content">
    <div id="img_missing" class="container tab-pane fade"><br>
    <div id="cover-spin" class=""><strong class="loading-text">Please Wait...</strong></div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>S.No.</th>
                <th>INV.#</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
           
        </tbody>
        
    </table>
    </div> 
</div>
     
    </main>
    <?php echo view('templates/footer');?>
<script type="text/javascript" language="javascript">
$(document).ready(function(){  
 
  var t = $('#example').DataTable();
  function fetch_farme_list(){
    $('#cover-spin').show(0);
     $.ajax({
        url:"<?php echo base_url(); ?>/MissingImages/action",
        method:"POST",
        data:{data_action:'fetch_missing_images_list'},
        success:function(data){
          $('#cover-spin').hide(0); 
           var missingImagesList= $.parseJSON(data)
           for(var i=0; i<missingImagesList.length; i++){
            var numlength = missingImagesList[i].inventoryNumber.toString().length;
                 if(numlength==1){var imgNo='L000'+missingImagesList[i].inventoryNumber; 
                 }else if(numlength==2){ var imgNo='L00'+missingImagesList[i].inventoryNumber;  
                 }else if(numlength==3){ var imgNo='L0'+missingImagesList[i].inventoryNumber; 
                 }else if(numlength>=4){ var imgNo='L'+missingImagesList[i].inventoryNumber;  
                }
                t.row.add( [
                    missingImagesList[i].sequenceNumber,
                    imgNo,
                    missingImagesList[i].summaryString

        ] ).draw( false );
            }
        }
  })
  }
  fetch_farme_list();
});
</script>
   