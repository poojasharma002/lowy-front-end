<?php  echo view('templates/header'); ?>
 <!-- Tab panes -->

 <style>
     /*  loading Css */
#cover-spin {
  position:fixed;
  width:100%;
  left:0;right:0;top:0;bottom:0;
  background: rgb(35 35 35);
  z-index:9999;
  display:none;
}
.cover-spin-hide {
display:none;
}
.cover-spin-show {
display:block !important;
}
@-webkit-keyframes spin {
  from {-webkit-transform:rotate(0deg);}
  to {-webkit-transform:rotate(360deg);}
}

@keyframes spin {
  from {transform:rotate(0deg);}
  to {transform:rotate(360deg);}
}

#cover-spin::after {
  content: '';
    position: absolute;
    background: url('assets/img/frame-spin.png');
    right: auto;
    display: block;
    top: 40vh;
    width: 35px;
    height: 40px;
    border-style: groove;
    border-color: #af9467;
    border-top-color: #ab9166;
    border-width: 2px;
    border-radius: 2px;
    -webkit-animation: spin 1s linear infinite;
    animation: spin 1s linear infinite;
    margin-left: 3px !important;
    text-shadow: none;
}
.loading-text{
  position: relative;
  text-align: center;
  display: block;
  margin-top: 50vh;
  color: #afa491;
  font-weight: normal;
  letter-spacing: 0;
  font-size: 13px;
  letter-spacing: .2px;
}
     </style>
 <div class="tab-content">
    <div id="frame_list" class="tab-pane active">
    <div id="cover-spin" class=""><strong class="loading-text">Please Wait...</strong></div>
    <a class="export-link" href='<?php echo base_url('ExportCsv/exportCSV'); ?>' id="">Export</a><br>
    <table id="example" class="table table-striped table-bordered " style="width:100%">
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
    </div>   
    </main>
   <?php echo view('templates/footer');?>
<script type="text/javascript" language="javascript">
$(document).ready(function(){  
    $('#example').DataTable( {
		"processing": true,
		"serverSide": false,
		"ajax": "./results.json",
		"columns"     :     [  
                {     "data"     :     "inventoryNumber"},  
                {     "data"     :     "description"},
				{     "data"     :     "century"},
				{     "data"     :     "countryCode"},
				{     "data"     :     "frameWidth"},
				{     "data"     :     "sightHeight"},
				{     "data"     :     "sightWidth"},
				{     "data"     :     "purchaseDate"},
				{     "data"     :     "pairId"},
				{     "data"     :     "buildingName"},
				{     "data"     :     "locationName"}
           ]  
	} );

});
</script>
   