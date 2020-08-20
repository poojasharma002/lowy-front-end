<?php  echo view('templates/header'); 
?>
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
.table td  {
    vertical-align: middle;
    border: none;
}
</style>
 <!-- Tab panes -->
 <div class="tab-content">
    <div id="import" class="container tab-pane fade"><br>
        <h3 style="text-align: center;">List of new images:</h3>
        <div style="text-align: center;"><button >Import All On Page</button></div>
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
           <tr>
           <td>1</td>
           <td style="width: 275px;"><img src="http://18.222.155.57/frameapp//images/frames/web/L0010" width="200"> <span class="frameSoldWrapper" style="margin-left: 75px;">0010</span></td>
           <td><div class="summarydetails">
                            <span class="frameSoldWrapper">L0010</span>
                            <br>
                            19CFRRGDCCC612ST42X35/12<br>
                            AM0589T58P20T                           
                        </div></td>
           <td><button>Import</button></td>
           </tr>
           <tr>
           <td>2</td>
           <td style="width: 275px;"><img src="http://18.222.155.57/frameapp//images/frames/web/L0010" width="200"> <span class="frameSoldWrapper" style="margin-left: 75px;">0011</span></td>
           <td><div class="summarydetails">
                            <span class="frameSoldWrapper">L0011</span>
                            <br>
                            19CFRRGDCCC612ST42X35/12<br>
                            AM0589T58P20T                           
                        </div></td>
           <td><button>Import</button></td>
           </tr>
        </tbody>
        
    </table>
        </div>
 </div>
 </main>
   <?php echo view('templates/footer');?>