<?php  echo view('templates/header');
echo link_tag('assets/css/frame-details.css'); 
?>
<script>
$(document).ready(function(){  
  $(".nav-link").removeClass("active");
    $(".tab-pane").removeClass("active");
    $(".tab-pane").removeClass("show");
    $('.detail').addClass("active");
    $('#details').addClass("active");
    $('#details').addClass("show");
   });
</script>
<!-- Tab panes -->
<div class="tab-content">
    <div id="details" class="container tab-pane fade"><br>
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
                                        <img src="<?php echo base_url('assets/img/frame.png');?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" class="titleText">
                                        <span class="<?php if($frameDetails->deleted ==true){echo 'frameSoldWrapper frameUnavaliableWrapper';} ?>">
                                            L00<?= $frameDetails->inventoryNumber ?>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <div class="alternativeImagesSelector">
                            <div class="imageWrapper"
                                onclick="javascript:window.open('resources/images/showAdminFrameNormal.action?frameId=0035','default');return false; ">
                                <img src="<?php echo base_url('assets/img/frame.png');?>" alt="default"
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
                    <form id="frameAdminEdit" name="frameAdminEdit" action="/frameAdminEdit.action" method="GET">
                        <div class="detailheader">
                            <span class="<?php if($frameDetails->deleted ==true){echo 'frameSoldWrapper frameUnavaliableWrapper';} ?>">
                                Inventory # <?= $frameDetails->inventoryNumber ?>
                            </span>
                        </div>
                        <table class="framedetailtable content" cellpadding="2" cellspacing="0" width="100%" border="0">
<tbody><tr class="odd">
            <td class="first title">Century</td>
            <td class="last">
                <select name="century" id="frameAdminSave_century">
    <option value=""></option>
    <option value="14">C14</option>
    <option value="15">C15</option>
    <option value="16">C16</option>
    <option value="17">C17</option>
    <option value="18">C18</option>
    <option value="19" selected="selected">C19</option>
    <option value="20">C20</option>
    <option value="21">C21</option>
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
            <td class="last"><select name="styleLookups" id="styleLookupables" multiple="" style="display: none;">
            <?php
            for($i=0; $i<count($style); $i++){?> 
            <option value="<?php echo $style[$i]->id; ?>" <?php for($j=0; $j<count($frameDetails->styles); $j++){if($style[$i]->id==$frameDetails->styles[$j]){$slectedStyleTitle=$slectedStyleTitle.' '.$style[$i]->title;?> selected="selected" <?php } }?> ><?php echo $style[$i]->title?></option>';
           <?php } ?>
</select><span class="ui-dropdownchecklist-wrapper" style="display: inline-block; cursor: default;">
<span class="ui-dropdownchecklist" tabindex="0" style="display: inline-block;">
<span class="ui-dropdownchecklist-text" title="" style="display: inline-block; overflow: hidden; width: 222px;"><?php echo  $slectedStyleTitle; ?>
</span></span></span>
<input type="hidden" id="__multiselect_styleLookupables" name="__multiselect_styleLookups" value="">
</td>
        </tr>
        <tr class="even">
            <td class="first title">Ornament</td>
            <td class="last"><select name="ornamentLookups" id="ornamentLookupables" multiple="" style="display: none;">
            <?php for($i=0; $i<count($ornament); $i++){?> 
            <option value="<?php echo $ornament[$i]->id; ?>" <?php for($j=0; $j<count($frameDetails->ornaments); $j++){  if($ornament[$i]->id==$frameDetails->ornaments[$j]){$slectedOrnamentTitle=$slectedOrnamentTitle.' '.$ornament[$i]->title;?> selected="selected" <?php } }?> ><?php echo $ornament[$i]->title?></option>';
           <?php } ?>
    </select><span class="ui-dropdownchecklist-wrapper" style="display: inline-block; cursor: default;"><span class="ui-dropdownchecklist" tabindex="0" style="display: inline-block;">
    <span class="ui-dropdownchecklist-text" title="<?php echo $slectedOrnamentTitle; ?>" style="display: inline-block; overflow: hidden; width: 161px;"><?php echo $slectedOrnamentTitle; ?></span>
    </span></span>
<input type="hidden" id="__multiselect_ornamentLookupables" name="__multiselect_ornamentLookups" value="">
</td>
        </tr>
        <tr class="odd">
    <td class="first title">Colors</td>       
    <td class="last"><select name="colorLookups" id="colorLookupables" multiple="" style="display: none;">
    <?php for($i=0; $i<count($color); $i++){?> 
            <option value="<?php echo $color[$i]->id; ?>" <?php for($j=0; $j<count($frameDetails->colors); $j++){ if($color[$i]->id==$frameDetails->colors[$j]){ $slectedColorTitle=$slectedColorTitle.' '.$color[$i]->title;?> selected="selected" <?php } }?> ><?php echo $color[$i]->title;?></option>';
           <?php } ?>

</select><span class="ui-dropdownchecklist-wrapper" style="display: inline-block; cursor: default;">
<span class="ui-dropdownchecklist" tabindex="0" style="display: inline-block;">
<span class="ui-dropdownchecklist-text" title="<?php echo $slectedColorTitle; ?>" style="display: inline-block; overflow: hidden; width: 172px;"><?php echo $slectedColorTitle; ?></span>
</span></span>
<input type="hidden" id="__multiselect_colorLookupables" name="__multiselect_colorLookups" value="">
</td>
        </tr>
        <tr class="even">
            <td class="first title">Corners</td>
                
            <td class="last"><select name="cornerLookups" id="cornerLookupables" multiple="" style="display: none;">
            <?php for($i=0; $i<count($corners); $i++){?> 
            <option value="<?php echo $corners[$i]->id; ?>" <?php for($j=0; $j<count($frameDetails->corners); $j++){ if($corners[$i]->id==$frameDetails->corners[$j]){ $slectedCornersTitle=$slectedCornersTitle.' '.$corners[$i]->title;?> selected="selected" <?php } } ?> ><?php echo $corners[$i]->title;?></option>';
           <?php } ?>
           </select><span class="ui-dropdownchecklist-wrapper" style="display: inline-block; cursor: default;"><span class="ui-dropdownchecklist" tabindex="0" style="display: inline-block;">
           <span class="ui-dropdownchecklist-text" title="<?php echo $slectedCornersTitle;?>" style="display: inline-block; overflow: hidden; width: 168px;"><?php echo $slectedCornersTitle;?></span>
           </span></span>
<input type="hidden" id="__multiselect_cornerLookupables" name="__multiselect_cornerLookups" value="">
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
                                L00<?= $frameDetails->inventoryNumber ?>
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
    <?php 
    // echo view('templates/footer');
    ?>