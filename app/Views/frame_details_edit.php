<?php  echo view('templates/header');
echo link_tag('assets/css/frame-details.css'); 
echo link_tag('assets/css/ui-dropdown.css'); 
echo script_tag("assets/js/bundle.min.js");
echo script_tag("assets/js/ui-drowpdown.js");
?>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"  crossorigin="anonymous">
<!-- Tab panes -->
<?= \Config\Services::validation()->listErrors(); ?>
<div class="tab-content">
    <div id="details" class="container tab-pane fade"><br>
    <div class="row">
    <div class="col-12">
    <div class="pagecontrol setbottomborder">
        <div class="detailnavigator">
            <form id="frameAdminView" name="frameAdminView" action="<?php echo base_url('frameAdminView.action');?>" method="GET">
                  <div class="pager">
                        <a id="frameAdminView_" href="<?php echo base_url('frameAdminView.action?id=0015');?>">&lt; previous</a>
                </div>
                <input type="text" name="id" value="<?= $invNo ?>" id="frameAdminView_id" style="width: 50px; float: left;"><input type="submit" id="frameAdminView_0" value="Show" class="inputsubmit" style="float:left;">

                <div class="pager" style="text-align: center;">
                    
                        <a id="frameAdminView_" href="<?php echo base_url('frameAdminView.action?id=0018');?>">next &gt;</a>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
        <div class="row">
            <div class="col-8">
                <div class="frameImage">
                <?php if($frameDetails->deleted==true){?>
                <div class="veryImportantText">
                    FRAME DELETED
                </div>
                <?php }?>
                    <div class="bigImageViewer" align="center">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <img src="<?php echo $imgUrl; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" class="titleText">
                                        <span class="<?php if($frameDetails->deleted ==true){echo 'frameSoldWrapper frameUnavaliableWrapper';} ?>">
                                        <?= $imgNo ?>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <div class="alternativeImagesSelector">
                         <div class="imageWrapper"
                                onclick="javascript:window.open('<?php echo $imgUrl; ?>','default');return false; ">
                                <img src="<?php echo $imgUrl; ?>" alt="default"
                                    class="selected">
                                <br>
                                Variant: default
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="frameDetail">
                    <form id="frameAdminEdit" name="frameAdminEdit" action="<?php echo base_url('frameAdminEdit.action');?>" method="POST">
                    <?= csrf_field() ?>
                        <div class="detailheader">
                            <span class="<?php if($frameDetails->deleted ==true){echo 'frameSoldWrapper frameUnavaliableWrapper';} ?>">
                                Inventory #  <?= $invNo ?>
                            </span>
                        </div>
                        <table class="framedetailtable content" cellpadding="2" cellspacing="0" width="100%" border="0">
<tbody><tr class="odd">
            <td class="first title">Century</td>
            <td class="last">
                <select name="century" id="frameAdminSave_century">
    <option value="" ></option>
    <option value="14" <?php if($frameDetails->century =="14"){echo 'selected="selected"';}?>>C14</option>
    <option value="15" <?php if($frameDetails->century =="15"){echo 'selected="selected"';}?>>C15</option>
    <option value="16" <?php if($frameDetails->century =="16"){echo 'selected="selected"';}?>>C16</option>
    <option value="17" <?php if($frameDetails->century =="17"){echo 'selected="selected"';}?>>C17</option>
    <option value="18" <?php if($frameDetails->century =="18"){echo 'selected="selected"';}?>>C18</option>
    <option value="19" <?php if($frameDetails->century =="19"){echo 'selected="selected"';}?>>C19</option>
    <option value="20" <?php if($frameDetails->century =="20"){echo 'selected="selected"';}?>>C20</option>
    <option value="21" <?php if($frameDetails->century =="21"){echo 'selected="selected"';}?>>C21</option>
</select>

            </td>
        </tr>
        <tr class="even">
            <td class="first title">Country</td>
            <td class="last"><select name="countryLookup" id="frameAdminSave_countryLookup">
            <option value=""></option>
            <?php
             for($i=0; $i<count($country); $i++){?>
                 <option value="<?php echo $country[$i]->id; ?>" <?php if($country[$i]->id==$frameDetails->countryId){?> selected="selected" <?php } ?> ><?php echo $country[$i]->title?></option>';

            <?php } ?>

</select>
</td>
        </tr>
        <tr class="odd">
            <td class="first title">Maker</td>
            <td class="last"><select name="makerLookup" id="frameAdminSave_makerLookup">
            <option value=""></option>
           <?php for($i=0; $i<count($maker); $i++){?> 
            <option value="<?php echo $maker[$i]->id; ?>" <?php if($maker[$i]->id==$frameDetails->makerId){?> selected="selected" <?php } ?> ><?php echo $maker[$i]->title?></option>';
           <?php } ?>
            </select>
</td>
        </tr>
        <tr class="even">
            <td class="first title">Pair</td>
            <td class="last"><input type="text" name="pairInventoryNumber" value="" id="frameAdminSave_pairInventoryNumber"></td>
        </tr>
        <tr class="odd">
            <td class="first title">Style</td> 
            <td class="last">
                <span class="autocomplete-select-style"></span>
<input type="hidden" id="__multiselect_styleLookupables" name="__multiselect_styleLookups" value="">

</td>
        </tr>
        <tr class="even">
            <td class="first title">Ornament</td>
            <td class="last">
            <span class="autocomplete-select-ornament"></span>
<input type="hidden" id="__multiselect_ornamentLookupables" name="__multiselect_ornamentLookups" value="">
</td>
        </tr>
        <tr class="odd">
    <td class="first title">Colors</td>       
    <td class="last">
    <span class="autocomplete-select-color"></span>
<input type="hidden" id="__multiselect_colorLookupables" name="__multiselect_colorLookups" value="">
</td>
        </tr>
        <tr class="even">
            <td class="first title">Corners</td>
                
            <td class="last"><span class="autocomplete-select-corners"></span>
<input type="hidden" id="__multiselect_cornersLookupables" name="__multiselect_cornerLookups" value="">
</td>
        </tr>
        <tr class="odd">
            <td class="first title">Width</td>
            <td class="last">
                <input type="text" name="frameWidth" value="<?php echo $frameDetails->frameWidth; ?>" id="frameAdminSave_frameWidth">
              </td>
        </tr>
        <tr class="even">
            <td class="first title">Sight Height</td>
            <td class="last">
                <input type="text" name="sightHeight" value="<?php echo $frameDetails->sightHeight; ?>" id="frameAdminSave_sightHeight">
               </td>
        </tr>
        <tr class="odd">
            <td class="first title">Sight Width</td>
            <td class="last">
                <input type="text" name="sightWidth" value="<?php echo $frameDetails->sightWidth; ?>" id="frameAdminSave_sightWidth">
           </td>
        </tr>
        <tr class="even">
            <td class="first title">Source</td>
            <td class="last"><select name="sourceLookup" id="frameAdminSave_sourceLookup">
    <option value=""></option>
    <?php for($i=0; $i<count($source); $i++){?> 
            <option value="<?php echo $source[$i]->id; ?>" <?php if($source[$i]->id==$frameDetails->sourceId){?> selected="selected" <?php } ?> ><?php echo $source[$i]->title?></option>';
           <?php } ?>
</select>
</td>
        </tr>
        <tr class="odd">
            <td class="first title">Third Party</td>
            <td class="last" style="font-size:smaller;"><input type="radio" name="consigned" id="frameAdminSave_consigned0" checked="checked" value="0"><label for="frameAdminSave_consigned0">None</label>
<input type="radio" name="consigned" id="frameAdminSave_consigned1" value="1"><label for="frameAdminSave_consigned1">Consigned</label>
<input type="radio" name="consigned" id="frameAdminSave_consigned2" value="2"><label for="frameAdminSave_consigned2">Partnered</label>
</td>
        </tr>
        <tr class="even">
            <td class="first title">Purchase Date:</td>
            <td class="last"><input type="text" name="purchaseDateAsString" value="<?php echo $frameDetails->purchaseDate;?>" id="frameAdminSave_purchaseDateAsString"></td>
        </tr>
        <tr class="odd">
            <td class="first title">Purchase Price:</td>
            <td class="last"><input type="text" name="purchasePrice" value="<?php echo $frameDetails->purchasePrice;?>" id="frameAdminSave_purchasePrice"></td>
        </tr>
        <tr class="even">
            <td class="first title">Asking Price:</td>
            <td class="last"><input type="text" name="sellingPrice" value="<?php echo $frameDetails->sellingPrice;?>" id="frameAdminSave_sellingPrice"></td>
        </tr>
        <tr class="odd">
            <td>Location</td>
            <td><input type="text" name="locationDescription" value="<?php echo $frameDetails->locationName;?>" id="frameAdminSave_locationDescription"></td>
        </tr>
        <tr class="even">
            <td>Building</td>
            <td><select name="locationBuildingLookup" id="frameAdminSave_locationBuildingLookup">
    <option value="-1">--Select--</option>
   
</select>
</td>
        </tr>
        <tr class="odd">
            <td>Note</td>
            <td><textarea name="locationInternalNotes" cols="30" rows="6" id="frameAdminSave_locationInternalNotes"></textarea></td>
        </tr>
        <tr class="even">
            <td class="first title">Default image:</td>
            <td class="last"><select name="defaultImageAttribute" id="frameAdminSave_defaultImageAttribute">
    <option value="default">default</option>
    <?php for($i=0; $i<count($building); $i++){?> 
            <option value="<?php echo $building[$i]->id; ?>" <?php if($building[$i]->id==$frameDetails->buildingId){?> selected="selected" <?php } ?> ><?php echo $building[$i]->title?></option>';
           <?php } ?>
</select>
</td>
        </tr>
     </tbody></table>
     <div style="border-top: 0pt none; border-bottom: 1px solid rgb(93, 119, 91); text-align: right;" class="detailheader">
        <input type="hidden" name="mode" value="edit" id="frameAdminSave_mode">
        <input type="hidden" name="priceUpdate" value="<?php echo $frameDetails->priceUpdate; ?>" id="priceUpdate">
         <input type="hidden" name="id" value="<?php echo $frameDetails->id; ?>" id="frameAdminSave_id">
        <input type="hidden" name="inventoryNumber" value="<?php echo $frameDetails->inventoryNumber; ?>" id="frameAdminSave_inventoryNumber">
        <input type="image" alt="Сancel" src="<?php echo base_url('assets/img/reset.jpg');?>" id="frameAdminSave_frameAdminCancel" name="action:frameAdminCancel" value="Сancel" class="buttonlink">

        <input type="image" alt="Save" src="<?php echo base_url('assets/img/save.jpg');?>" id="frameAdminSave_0" value="Save" class="buttonlink">

    </div>
                    </form>
                    <div class="summary">
                        <div class="summaryheading">Summary:</div>
                        <div class="summarydetails">
                            <span class="<?php if($frameDetails->deleted ==true){echo 'frameSoldWrapper frameUnavaliableWrapper';} ?>">
                            <?= $imgNo ?>
                            </span>
                            <br>
                            19CFRRGDCCC612ST42X35/12<br>
                            AM0589T58P20T
                        </div>
                    </div>
                    <div id="frameSold">
                        <a href="#framesoldForm" id="framesoldLink">
                            Frame Sold </a>
                    </div>

                    <div style="float:right;width:40px;">
                        &nbsp;
                    </div>

                    <div id="deleteUndelete">
                        <a href="#deleteUndeleteForm" id="deleteUndeleteLink"><?php if($frameDetails->deleted ==true){echo 'Undelete Frame';}else{echo 'Delete Frame';} ?>
                           </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
     
    </main>
    </br>
 <script>
$(document).ready(function(){ 
    var style= $('#styleLookupables').val();
    $('#__multiselect_styleLookupables').val(style);
    var ornament= $('#ornamentLookupables').val();
    $('#__multiselect_ornamentLookupables').val(ornament);
    var color= $('#colorLookupables').val();
    $('#__multiselect_colorLookupables').val(color);
    var corner= $('#cornerLookupables').val();
    $('#__multiselect_cornerLookupables').val(corner);
   });
</script>
    <?php 
    // echo view('templates/footer');
    ?>