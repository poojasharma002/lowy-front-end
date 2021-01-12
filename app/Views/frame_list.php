<?php  echo view('templates/header'); ?>
 <!-- Tab panes -->
 <div class="tab-content">
    <div id="frame_list" class="tab-pane active"><br>
    <div id="cover-spin" class=""><strong class="loading-text">Please Wait...</strong></div>
    <a href='<?php echo base_url('ExportCsv/exportCSV'); ?>' id="">Export</a><br><br>
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
   