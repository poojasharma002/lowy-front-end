<?php  echo view('templates/header'); ?>
 <!-- Tab panes -->
 <div class="tab-content">
    <div id="frame_list" class="container tab-pane active"><br>
    <div id="cover-spin" class=""><strong class="loading-text">Please Wait...</strong></div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>INV.#</th>
                <th>Description</th>
                <th>C</th>
                <th>Country</th>
                <th>Frame Width</th>
                <th>Sight Height</th>
                <th>Sight Width</th>
                <th>Purchase Date</th>
                <th>pair</th>
                <th>Bldg.</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
           
        </tbody>
        <tfoot>
        <tr>
                <th>INV.#</th>
                <th>Description</th>
                <th>C</th>
                <th>Country</th>
                <th>Frame Width</th>
                <th>Sight Height</th>
                <th>Sight Width</th>
                <th>Purchase Date</th>
                <th>pair</th>
                <th>Bldg.</th>
                <th>Location</th>
            </tr>
        </tfoot>
    </table>
    </div>
    <div id="details" class="container tab-pane fade"><br>
      <h3>Details</h3>
        </div>
    <div id="img_missing" class="container tab-pane fade"><br>
      <h3>MISSING IMAGES</h3>
    </div>
    <div id="categories" class="container tab-pane fade"><br>
      <h3>CATEGORIES</h3>
    </div>
    <div id="import" class="container tab-pane fade"><br>
      <h3>IMPORT</h3>
    </div>
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
        url:"<?php echo base_url(); ?>/FrameList/action",
        method:"POST",
        data:{data_action:'fetch_frame_list'},
        success:function(data){
          $('#cover-spin').hide(0); 
           var framelist= $.parseJSON(data)
           for(var i=0; i<framelist.length; i++){
                t.row.add( [
                    '<a href ="#" onclick="details(\''+framelist[i].id+'\',event);">'+framelist[i].inventoryNumber+'</a>',
                    framelist[i].description,
                    framelist[i].century,
                    framelist[i].countryCode,
                    framelist[i].frameWidth,
                    framelist[i].sightHeight,
                    framelist[i].sightWidth,
                    framelist[i].purchaseDate,
                    framelist[i].pairId,
                    framelist[i].buildingName,
                    framelist[i].locationName

        ] ).draw( false );
            }
        }
  })
  }
  fetch_farme_list();
});
function details(id,e){
    e.preventDefault();
    $(".nav-link").removeClass("active");
    $(".tab-pane").removeClass("active");
    $(".tab-pane").removeClass("show");
    $('.detail').addClass("active");
    $('#details').addClass("active");
    $('#details').addClass("show");
    
}
</script>
   