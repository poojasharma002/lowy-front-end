<?php  echo view('templates/header');
echo link_tag('assets/css/categories-style.css'); 
echo link_tag('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'); 
echo link_tag('assets/css/animate.min.css'); 
echo script_tag('assets/js/notification.js');
echo script_tag('assets/js/categories.min.js');
 ?>
<script>
</script>
<!-- Tab panes -->
<div class="tab-content">
    <div id="categories" class="container tab-pane fade">
    <div class="row">
     <div class="col-12">
     <div id="cover-spin" class=""><strong class="loading-text">Please Wait...</strong></div> 
     <?php if($status_code == "200"){echo '<div id="successMessages"></div>';}else if($status_code!="200" && !empty($status_code)){echo '<div id="errorMessages"></div>';}?>  
    <div class="pagecontrol setbottomborder">
    <div class="tablenavigator">
        <!-- <form id="adminManageLookupablesChangeLookupable" name="adminManageLookupablesChangeLookupable" action="/adminManageLookupablesChangeLookupable.action" method="GET"> -->
            <div class="headerBlock" style="white-space:nowrap;">
               <span class="title">Lookup table:</span>
                <select name="lookupable" id="adminManageLookupablesChangeLookupable_lookupable">
                    <option value="color" <?php if($lookupValue=="color"){echo 'selected="selected"';} ?>>Colors</option>
                    <option value="corners" <?php if($lookupValue=="corners"){echo 'selected="selected"';}?>>Corners</option>
                    <option value="country" <?php if($lookupValue=="country"){echo 'selected="selected"';}?>>Country</option>
                    <option value="maker" <?php if($lookupValue=="maker"){echo 'selected="selected"';} ?>>Maker</option>
                    <option value="ornament" <?php if($lookupValue=="ornament"){echo 'selected="selected"';}?>>Ornament</option>
                    <option value="source" <?php if($lookupValue=="source"){echo 'selected="selected"';} ?>>Source</option>
                    <option value="style"  <?php if($lookupValue=="style"){ echo 'selected="selected"';} ?>>Style</option>
                </select>
                <input type="button" id="adminManageLookupablesChangeLookupable_0" value="Change Table" onclick="chnageLookupTable();">
            </div>
        <!-- </form> -->
        </div>
        </div>  
        </div>
        </div>
</br>
        <div class="row">
            <div class="col-7">
                <div class="lookupValuesList">
                    <div>
                        <table class="frameProperties" id="framePropertiesDetails">
                            <colgroup>
                                <col width="40%">
                                <col width="60%">
                            </colgroup>
                            <tbody>
                           
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="lookupEditForm">
                    <form id="adminManageLookupablesSave" name="adminManageLookupablesSave" action="<?php echo base_url('adminManageLookupablesSave.action');?>" method="Post">
                        <div>
                            <table class="frameProperties">
                                <tbody>
                                    <tr>
                                        <td> Code:</td>
                                        <td><input type="text" name="code" value="" id="adminManageLookupablesSave_code"><br>
                                        </td>
                                    </tr>
                                    <tr>
                               <td>Title:</td>
                              <td> <input type="text" name="title" value="" id="adminManageLookupablesSave_title"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" name="id" value="" id="adminManageLookupablesSave_id">
                            <input type="hidden" name="ref_type" value="" id="adminManageLookupablesRef_type">
                        </div>
                      <input type="submit" id="adminManageLookupablesSave_0" value="Add" class="buttonlink">
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

</main>
<?php echo view('templates/footer');?>