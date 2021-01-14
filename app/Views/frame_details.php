<?php  echo view('templates/header');
echo link_tag('assets/css/frame-details.css'); 
echo link_tag('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'); 
echo link_tag('assets/css/animate.min.css'); 
echo script_tag('assets/js/notification.js');

?>
<script>
$(document).ready(function(){  
  $(".nav-link").removeClass("active");
    $(".tab-pane").removeClass("active");
    $(".tab-pane").removeClass("show");
    $('.detail').addClass("active");
    $('#details').addClass("active");
    $('#details').addClass("show");
    createAlert('Opps!','Something went wrong','Please Contact to administrative.','danger',true,true,'errorMessages');
    createAlert('','Edit Frame Details!','Frame Details Update Successfully!.','success',true,true,'successMessages');
    $('#frameAdminView_0').on('click', function(e){
         e.preventDefault();
      var searchType=$('#frameAdminView_id').val();
      if($.isNumeric(searchType)==false){
        var check= searchType.split('L');
            if(check[0]!='L' && $.isNumeric(check[1])==false){
              createAlert('','','Please Enter valid Inventory Number. Ex.(L0004,L0123 etc.)','danger',true,true,'errorMessages-2');
              return;
            }else{
                $("#frameAdminView").submit();
            }
          }else{
            $("#frameAdminView").submit();
          }  
    })
   });
</script>
<?php 
if(empty($frameDetails)){?>
    <div class="tab-content">
    <div id="details" class="container tab-pane fade"><br>
    <div class="row">
    <div class="col-12">
    <div class="pagecontrol setbottomborder">
        <div class="detailnavigator">
            <form id="frameAdminView" name="frameAdminView" action="<?php echo base_url('frameAdminView.action');?>" method="GET">
                  <input type="text" name="id" value="<?= $imgNo ?>" id="frameAdminView_id" style="width: 70px; float: left;"><input type="submit" id="frameAdminView_0" value="Show" class="inputsubmit" style="float:left;">
            </form>
        </div>
    </div>
    </div>
    </div>
    <p>Inventory number is not specified.</p>
    </div>
    <div id="errorMessages-2"></div>
    </div>

<?php die();}?>
<?php 
  $styles='';
  for($i=0; $i<count($frameDetails->styles); $i++){
   if($i==0){
        $styles=$frameDetails->styles[$i]->title;
    }elseif($i>0){
        $styles= $styles.', '.$frameDetails->styles[$i]->title;
    } 
} 
    $ornaments='';
    for($i=0; $i<count($frameDetails->ornaments); $i++){
       if($i==0){
            $ornaments=$frameDetails->ornaments[$i]->title;
        }elseif($i>0){
            $ornaments= $ornaments.', '.$frameDetails->ornaments[$i]->title;
        } 
    }
    $colors='';
    for($i=0; $i<count($frameDetails->colors); $i++){
       if($i==0){
            $colors=$frameDetails->colors[$i]->title;
        }elseif($i>0){
            $colors= $colors.', '.$frameDetails->colors[$i]->title;
        } 
    } 
    $corners='';
    for($i=0; $i<count($frameDetails->corners); $i++){
       if($i==0){
            $corners=$frameDetails->corners[$i]->title;
        }elseif($i>0){
            $corners= $corners.', '.$frameDetails->corners[$i]->title;
        } 
    }           
?>
<!-- Tab panes -->
<div class="tab-content">
    <div id="details" class="container tab-pane fade"><br>
    <div class="row">
    <div class="col-12">
    <div class="pagecontrol setbottomborder">
        <div class="detailnavigator">
            <form id="frameAdminView" name="frameAdminView" action="<?php echo base_url('frameAdminView.action');?>" method="GET">
                <input type="text" name="id" value="<?= $imgNo ?>" id="frameAdminView_id" style="width: 120px; float: left;"><input type="submit" id="frameAdminView_0" value="Show" class="inputsubmit" style="float:left;">
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
                                        <img src='<?php echo $imgUrl; ?>'>
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
            <div class="col-4"><?php if($status_code == "200"){echo '<div id="successMessages"></div>';}else if($status_code!="200" && !empty($status_code)){echo '<div id="errorMessages"></div>';}?>
            <div id="errorMessages-2"></div>
               <div class="frameDetail">
                    <form id="frameAdminEdit" name="frameAdminEdit" action="<?php echo base_url('frameAdminEdit.action');?>" method="GET">
                        <div class="detailheader">
                            <span class="<?php if($frameDetails->deleted ==true){echo 'frameSoldWrapper frameUnavaliableWrapper';} ?>">
                                Inventory # <?= $imgNo ?>
                            </span>
                        </div>
                        <table class="framedetailtable content" cellpadding="2" cellspacing="0" width="100%" border="0">
                            <tbody>
                                <tr class="odd">
                                    <td class="">Century</td>
                                    <td class=""><?= $frameDetails->century ?></td>
                                </tr>
                                <tr class="even">
                                    <td class="">Country</td>
                                    <td class=""><?= $frameDetails->countryName ?></td>
                                </tr>
                                <tr class="odd">
                                    <td class="first title">Maker</td>
                                    <td class="last"><?= $frameDetails->makerName ?></td>
                                </tr>
                                <tr class="even">
                                    <td class="first title">Pair</td>
                                    <td class="last"></td>
                                </tr>
                                <tr class="odd">
                                    <td class="first title">Style</td>
                                    <td class="last"><?= $styles ?></td>
                                </tr>
                                <tr class="even">
                                    <td class="first title">Ornament</td>
                                    <td class="last"><?= $ornaments ?></td>

                                </tr>
                                <tr class="odd">
                                    <td class="first title">Colors</td>
                                    <td class="last"><?= $colors ?> </td>
                                </tr>
                                <tr class="even">
                                    <td class="first title">Corners</td>
                                    <td class="last"><?= $corners ?></td>
                                </tr>
                                <tr class="odd">
                                    <td class="first title">Width</td>
                                   <td class="last"><?= $frameDetails->frameWidth ?></td>
                                </tr>
                                <tr class="even">
                                    <td class="first title">Sight</td>
                                    <td class="last"><?= $frameDetails->sightHeight ?></td>
                                </tr>
                                <tr class="odd">
                                    <td class="first title">Source</td>
                                    <td class="last"><?= $frameDetails->sourceName ?></td>
                                </tr>
                                <tr class="even">
                                    <td class="first title">Third Party</td>
                                    <td class="last">
                                    <?php 
                                    if($frameDetails->consigned==0){ echo 'None';}
                                    elseif($frameDetails->consigned==1){echo 'Consigned';}
                                    elseif($frameDetails->consigned==2){echo 'Partnered';} ?></td>
                                </tr>
                                <tr class="odd">
                                    <td class="first title">Purchase Date</td>
                                    <td class="last"><?= $frameDetails->purchaseDate ?> </td>
                                </tr>
                                <tr class="even">
                                    <td class="first title">Purchase price</td>
                                    <td class="last"><?= $frameDetails->purchasePrice ?></td>
                                </tr>
                                <tr class="odd">
                                    <td class="first title">Asking price</td>
                                    <td class="last"><?= $frameDetails->sellingPrice ?></td>
                                </tr>
                                <tr class="even">
                                    <td class="first title">Location</td>
                                    <td class="last"><?= $frameDetails->locationName ?> </td>
                                </tr>
                                <tr class="odd">
                                    <td class="first title">Building</td>
                                    <td class="last"><?= $frameDetails->buildingName ?></td>
                                </tr>
                                <tr class="even">
                                    <td class="first title">Last Modified</td>
                                    <td class="last"><?= $frameDetails->lastModified ?></td>
                                </tr>
                                <tr class="odd">
                                    <td class="first title">Note</td>
                                    <td class="last"><?= $frameDetails->note ?> </td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="border-top: 0pt none; border-bottom: 1px solid rgb(93, 119, 91); text-align: right;"
                            class="detailheader">
                            <input type="hidden" name="id" value="<?= $frameDetails->inventoryNumber ?>" id="frameAdminEdit_id">
                            <input type="image" alt="Edit" src="<?php echo base_url('assets/img/edit-btn.svg');?>" id="frameAdminEdit_0"
                                value="Edit" class="buttonlink">

                        </div>
                    </form>
                    <div class="summary">
                        <div class="summaryheading">Summary:</div>
                        <div class="summarydetails">
                            <span class="<?php if($frameDetails->deleted ==true){echo 'frameSoldWrapper frameUnavaliableWrapper';} ?>">
                            <?= $imgNo ?>
                            </span>
                            <br>
                            <?=  $frameDetails->summary?>
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