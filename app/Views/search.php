<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php 
echo link_tag('assets/css/bootstrap.min.css');
echo link_tag('assets/css/image-grid.css');
echo script_tag("assets/js/jquery-3.5.1.js");
echo link_tag('assets/css/search.min.css');
echo link_tag('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'); 
echo link_tag('assets/css/ui-dropdown.css'); 
echo script_tag("assets/js/bundle.min.js");
echo script_tag("assets/js/ui-drowpdown-search.js");
echo link_tag('assets/css/zoomIn.css');
echo script_tag("assets/js/zoomIn.js");
?>

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading"><a href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/img/logo-client.jpg');?>"/></a></div>
      <div class="list-group list-group-flush">
        <div id="searchOptionWapper">
          <!-- Actual search box -->
             <p>
                <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="framesView_searchType" id="framesView_searchType">
                <div class="input-group-append">
                  <button class="btn btn-secondary" type="button" id="searchByInvNo">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
            </p>
                <p>
            <button class="btn btn-primary search-btn" type="button" data-toggle="collapse" data-target="#artwork" aria-expanded="false" aria-controls="artwork">
            Artwork
            </button>
            </p>
            <div class="collapse" id="artwork">
            <div class="card card-body">
            <div class="container">
                <form action="">
                  <div class="form-group">
                    <label for="File">File:</label>
                    <input type="file" name="artFile" value="" class="form-control" accept="image/jpeg,image/tiff,image/png" id="insertArtImage_artFile">
                  </div>
                  <div class="form-group">
                    <label for="Height">Height:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="artHeightInt" class="" placeholder="Enter Height" value="" id="insertArtImage_artHeightInt" class="sizeFieldInt">
                    <select name="sizeArtHeightFract" id="framesView_sizeMouldingArtHeightFract" class="">
                          <option value="0.0" selected="selected">0</option>
                          <option value="0.0625">1/16</option>
                          <option value="0.125">1/8</option>
                          <option value="0.1875">3/16</option>
                          <option value="0.25">1/4</option>
                          <option value="0.3125">5/16</option>
                          <option value="0.375">3/8</option>
                          <option value="0.4375">7/16</option>
                          <option value="0.5">1/2</option>
                          <option value="0.5625">9/16</option>
                          <option value="0.625">5/8</option>
                          <option value="0.6875">11/16</option>
                          <option value="0.75">3/4</option>
                          <option value="0.8125">13/16</option>
                          <option value="0.875">7/8</option>
                          <option value="0.9375">15/16</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="Width">Width:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="artWidthInt" class="" placeholder="Enter Width" value="" id="insertArtImage_artWidthInt" class="sizeFieldInt">
                    <select name="sizeArtWidthFract" id="framesView_sizeMouldingArtWidthFract" class="">
                          <option value="0.0" selected="selected">0</option>
                          <option value="0.0625">1/16</option>
                          <option value="0.125">1/8</option>
                          <option value="0.1875">3/16</option>
                          <option value="0.25">1/4</option>
                          <option value="0.3125">5/16</option>
                          <option value="0.375">3/8</option>
                          <option value="0.4375">7/16</option>
                          <option value="0.5">1/2</option>
                          <option value="0.5625">9/16</option>
                          <option value="0.625">5/8</option>
                          <option value="0.6875">11/16</option>
                          <option value="0.75">3/4</option>
                          <option value="0.8125">13/16</option>
                          <option value="0.875">7/8</option>
                          <option value="0.9375">15/16</option>
                      </select>
                  </div> 
                  <input type="submit" id="insertArtImage_0" value="Add Art" class="buttonlink">
                  <!-- <input type="submit" id="insertArtImage_toggleArtImage" name="action:toggleArtImage" value="Hide Art" disabled="disabled" class="buttonlink"> -->
                  <input type="submit" id="insertArtImage_removeArtImage" name="action:removeArtImage" value="Remove Art" disabled="disabled" class="buttonlink">
                </form>
              </div>
            </div>
            </div>
            <p>
            <button class="btn btn-primary search-btn" type="button" data-toggle="collapse" data-target="#origin" aria-expanded="false" aria-controls="origin">
            Origin
            </button>
            </p>
            <div class="collapse" id="origin">
            <div class="card card-body">
            <div class="container">
                  <div class="form-group">
                    <label for="Width">Century:</label>
                    <span class="autocomplete-select-century"></span>
                    <input type="hidden" id="__multiselect_centuryLookupables" name="__multiselect_centuryLookups" value="">
                  </div>
                  <div class="form-group">
                    <label for="Width">Maker:</label>
                    <span class="autocomplete-select-maker"></span>
                    <input type="hidden" id="__multiselect_makerLookupables" name="__multiselect_makerLookups" value="">
                  </div>
                  <div class="form-group">
                    <label for="Width">Country:</label>
                    <span class="autocomplete-select-country"></span>
                    <input type="hidden" id="__multiselect_countryLookupables" name="__multiselect_countryLookups" value="">
                  </div>
                  </div>
            </div>
            </div>

            <p>
            <button class="btn btn-primary search-btn" type="button" data-toggle="collapse" data-target="#style" aria-expanded="false" aria-controls="style">
            Style
            </button>
            </p>
            <div class="collapse" id="style">
            <div class="card card-body">
                <div class="container">
                  <div class="form-group">
                    <label for="Width">Style:</label>
                    <span class="autocomplete-select-style"></span>
                    <input type="hidden" id="__multiselect_styleLookupables" name="__multiselect_styleLookups" value="">
                  </div>
                  <div class="form-group">
                    <label for="Width">Ornament:</label>
                    <span class="autocomplete-select-ornament"></span>
                    <input type="hidden" id="__multiselect_ornamentLookupables" name="__multiselect_ornamentLookups" value="">
                  </div>

                  <div class="form-group">
                    <label for="Width">Colors:</label>
                    <span class="autocomplete-select-color"></span>
                    <input type="hidden" id="__multiselect_colorLookupables" name="__multiselect_colorLookups" value="">
                  </div>

                  <div class="form-group">
                    <label for="Width">Corners:</label>
                    <span class="autocomplete-select-corners"></span>
                    <input type="hidden" id="__multiselect_cornersLookupables" name="__multiselect_cornerLookups" value="">
                  </div>

                </div>
            </div>
            </div>

            <p>
            <button class="btn btn-primary search-btn" type="button" data-toggle="collapse" data-target="#price" aria-expanded="false" aria-controls="price">
            Price
            </button>
            </p>
            <div class="collapse" id="price">
            <div class="card card-body">
            <div class="container">
            <div class="form-group">
                    <!-- <label for="Height">Min Price:</label> -->
                    <input type="text" name="minPrice" class="form-control" placeholder="Enter Min Price" value="" id="framesView_minPrice" class=""> 
                  </div>
            <div class="form-group" style="margin-left:118px;">
            <label for="Height">To</label>
            </div>
            <div class="form-group">
                    <!-- <label for="Height">Max Price:</label> -->
                    <input type="text" name="maxPrice" class="form-control" placeholder="Enter Max Price" value="" id="framesView_maxPrice" class="">
                  </div>
            </div>
            </div>
            </div>

            <p>
            <button class="btn btn-primary search-btn" type="button" data-toggle="collapse" data-target="#size" aria-expanded="false" aria-controls="size">
            Size
            </button>
            </p>
        <div class="collapse" id="size">
          <div class="card card-body">
            <div class="container">
                <div class="form-group">
                  <label for="Width">Min Width :</label>
                  <input type="text" name="sizeMouldingWidthMinInt" class="" value="" id="framesView_sizeMouldingWidthMinInt">
                  <select name="sizeMouldingWidthMinFract" id="framesView_sizeMouldingWidthMinFract" class="">
                          <option value="0.0" selected="selected">0</option>
                          <option value="0.0625">1/16</option>
                          <option value="0.125">1/8</option>
                          <option value="0.1875">3/16</option>
                          <option value="0.25">1/4</option>
                          <option value="0.3125">5/16</option>
                          <option value="0.375">3/8</option>
                          <option value="0.4375">7/16</option>
                          <option value="0.5">1/2</option>
                          <option value="0.5625">9/16</option>
                          <option value="0.625">5/8</option>
                          <option value="0.6875">11/16</option>
                          <option value="0.75">3/4</option>
                          <option value="0.8125">13/16</option>
                          <option value="0.875">7/8</option>
                          <option value="0.9375">15/16</option>
                      </select>
                </div>
                <!-- <label for="Height" style="margin-left: 107px;">To</label> -->
                <div class="form-group"> 
                      <label for="Width">Max Width :</label>
                      <input type="text" name="sizeMouldingWidthMaxInt"  value="" id="framesView_sizeMouldingWidthMaxInt" class="sizeFieldInt">
                      <select name="sizeMouldingWidthMaxFract" id="framesView_sizeMouldingWidthMaxFract" class="sizeFieldFract">
                          <option value="0.0" selected="selected">0</option>
                          <option value="0.0625">1/16</option>
                          <option value="0.125">1/8</option>
                          <option value="0.1875">3/16</option>
                          <option value="0.25">1/4</option>
                          <option value="0.3125">5/16</option>
                          <option value="0.375">3/8</option>
                          <option value="0.4375">7/16</option>
                          <option value="0.5">1/2</option>
                          <option value="0.5625">9/16</option>
                          <option value="0.625">5/8</option>
                          <option value="0.6875">11/16</option>
                          <option value="0.75">3/4</option>
                          <option value="0.8125">13/16</option>
                          <option value="0.875">7/8</option>
                          <option value="0.9375">15/16</option>
                      </select>
                </div>
                <div class="form-group">
                  <label for="Sight Height">Min Sight Height:</label>
                  <input type="text" name="sizeSightHeightMinInt" value="" id="framesView_sizeSightHeightMinInt" class="sizeFieldInt">
                  <select name="sizeSightHeightMinFract" id="framesView_sizeSightHeightMinFract" class="sizeFieldFract">
                      <option value="0.0" selected="selected">0</option>
                      <option value="0.0625">1/16</option>
                      <option value="0.125">1/8</option>
                      <option value="0.1875">3/16</option>
                      <option value="0.25">1/4</option>
                      <option value="0.3125">5/16</option>
                      <option value="0.375">3/8</option>
                      <option value="0.4375">7/16</option>
                      <option value="0.5">1/2</option>
                      <option value="0.5625">9/16</option>
                      <option value="0.625">5/8</option>
                      <option value="0.6875">11/16</option>
                      <option value="0.75">3/4</option>
                      <option value="0.8125">13/16</option>
                      <option value="0.875">7/8</option>
                      <option value="0.9375">15/16</option>
                  </select>
                </div>
                <!-- <label for="Height" style="margin-left: 107px;">To</label> -->
                <div class="form-group">
                <label for="Sight Height">Max Sight Height:</label>
                <input type="text" name="sizeSightHeightMaxInt" value="" id="framesView_sizeSightHeightMaxInt" class="sizeFieldInt">
                <select name="sizeSightHeightMaxFract" id="framesView_sizeSightHeightMaxFract" class="sizeFieldFract">
                      <option value="0.0" selected="selected">0</option>
                      <option value="0.0625">1/16</option>
                      <option value="0.125">1/8</option>
                      <option value="0.1875">3/16</option>
                      <option value="0.25">1/4</option>
                      <option value="0.3125">5/16</option>
                      <option value="0.375">3/8</option>
                      <option value="0.4375">7/16</option>
                      <option value="0.5">1/2</option>
                      <option value="0.5625">9/16</option>
                      <option value="0.625">5/8</option>
                      <option value="0.6875">11/16</option>
                      <option value="0.75">3/4</option>
                      <option value="0.8125">13/16</option>
                      <option value="0.875">7/8</option>
                      <option value="0.9375">15/16</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="Sight Width">Min Sight Width:</label>
                  <input type="text" name="sizeSightWidthMinInt" value="" id="framesView_sizeSightWidthMinInt" class="sizeFieldInt">
                  <select name="sizeSightWidthMinFract" id="framesView_sizeSightWidthMinFract" class="sizeFieldFract">
                      <option value="0.0" selected="selected">0</option>
                      <option value="0.0625">1/16</option>
                      <option value="0.125">1/8</option>
                      <option value="0.1875">3/16</option>
                      <option value="0.25">1/4</option>
                      <option value="0.3125">5/16</option>
                      <option value="0.375">3/8</option>
                      <option value="0.4375">7/16</option>
                      <option value="0.5">1/2</option>
                      <option value="0.5625">9/16</option>
                      <option value="0.625">5/8</option>
                      <option value="0.6875">11/16</option>
                      <option value="0.75">3/4</option>
                      <option value="0.8125">13/16</option>
                      <option value="0.875">7/8</option>
                      <option value="0.9375">15/16</option>
                  </select>
                </div>
                <!-- <label for="Width" style="margin-left: 107px;">To</label> -->
                <div class="form-group">
                <label for="Sight Width">Max Sight Width:</label>
                <input type="text" name="sizeSightWidthMaxInt" value="" id="framesView_sizeSightWidthMaxInt" class="sizeFieldInt">
                <select name="sizeSightWidthMaxFract" id="framesView_sizeSightWidthMaxFract" class="sizeFieldFract">
                  <option value="0.0" selected="selected">0</option>
                  <option value="0.0625">1/16</option>
                  <option value="0.125">1/8</option>
                  <option value="0.1875">3/16</option>
                  <option value="0.25">1/4</option>
                  <option value="0.3125">5/16</option>
                  <option value="0.375">3/8</option>
                  <option value="0.4375">7/16</option>
                  <option value="0.5">1/2</option>
                  <option value="0.5625">9/16</option>
                  <option value="0.625">5/8</option>
                  <option value="0.6875">11/16</option>
                  <option value="0.75">3/4</option>
                  <option value="0.8125">13/16</option>
                  <option value="0.875">7/8</option>
                  <option value="0.9375">15/16</option>
                </select>
                </div>

             </div>
          </div>
        </div>
           
            <div id="serachSold">
            Search Sold<input type="checkbox" name="searchSold" value="true" id="framesView_searchSold" >
<input type="hidden" id="__checkbox_framesView_searchSold" name="__checkbox_searchSold" value="true"> 
        </div>

        <div id="hideMissingImages">
            Hide missing images<input type="checkbox" name="hideMissingImages" value="true" id="framesView_hideMissingImages">
<input type="hidden" id="__checkbox_framesView_hideMissingImages" name="__checkbox_hideMissingImages" value="true"> 
        </div>
        <div id="searchSubmit">
            <input type="image" alt="Search Frames" src="<?php echo base_url('assets/img/search-link.jpg');?>" id="framesView_0" onclick="searchingAttributes();" value="Search Frames">
            <a href="<?php echo base_url('framesSearch.action');?>"><input type="image" alt="Clear Search" src="<?php echo base_url('assets/img/clear-search.jpg');?>" id="framesView_framesResetSearch" name="action:framesResetSearch" value="Clear Search"></a>
        </div>
        
        </div>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"> <span class="navbar-toggler-icon"></span></button>
      </nav>

<div class="container-fluid">
   </br>     
   <div id="cover-spin" class=""><strong class="loading-text">Please Wait...</strong></div> 
   <input type="hidden" id="__perPageLoadImageCount" name="__perPageLoadImageCount" value="0"> 
<div class="row" id="gallery" >
</div>
<div id="loadMore">
<input type="button" alt="load More" class="btn-primary" id="loadMoreSearch" name="loadMoreSearch" value="Load More Frame">
</div>
<!-- Modal -->
<!-- 
This part is straight out of Bootstrap docs. Just a carousel inside a modal.
-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div  class="carousel slide">
          <div  id="carousel-inner">
          </div>
        </div>
      </div>
      <div class="modal-footer" id="modal-footer">
     
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="rotateFramePopup" tabindex="-1" role="dialog" data-backdrop='static' data-keyboard='false'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">Edit Frame</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="rotateFrame" class="ui-dialog-content ui-widget-content" style="display: block; height: auto; min-height: 0px; width: auto;">
            <form id="frameChangeParameters" name="frameChangeParameters" action="/frameChangeParameters.action" method="post">
                <input type="hidden" name="modifyInventoryNumber" value="L0989" id="rotateFrameName">
                <div class="cutPerSide">
                    <label>Cut Per Side</label>    <br><br>
                    <input type="radio" name="cut" id="frameChangeParameters_cut0" value="0"><label for="frameChangeParameters_cut0">0 Cuts</label>
<input type="radio" name="cut" id="frameChangeParameters_cut1" value="1"><label for="frameChangeParameters_cut1">1 Cuts CN</label>
<input type="radio" name="cut" id="frameChangeParameters_cut2" value="2"><label for="frameChangeParameters_cut2">2 Cuts CC</label>
<input type="radio" name="cut" id="frameChangeParameters_cut4" value="4"><label for="frameChangeParameters_cut4">4 Cuts CCDC </label>
<input type="radio" name="cut" id="frameChangeParameters_cut-1" value="-1"><label for="frameChangeParameters_cut-1">Default</label>

                </div>

                <div class="cutPerSide">
                    <label>Rotate Clockwise by</label>    <br><br>
                    <input type="radio" name="rotate" id="frameChangeParameters_rotate0" value="0"><label for="frameChangeParameters_rotate0">0</label>
<input type="radio" name="rotate" id="frameChangeParameters_rotate1" value="1"><label for="frameChangeParameters_rotate1">90</label>
<input type="radio" name="rotate" id="frameChangeParameters_rotate2" value="2"><label for="frameChangeParameters_rotate2">180</label>
<input type="radio" name="rotate" id="frameChangeParameters_rotate3" value="3"><label for="frameChangeParameters_rotate3">270</label>
<input type="radio" name="rotate" id="frameChangeParameters_rotate-1" value="-1"><label for="frameChangeParameters_rotate-1">Default</label>

                </div>
                <input type="submit" id="frameChangeParameters_0" value="Apply" class="controls">
                <input class="controls" type="submit" value="Cancel">
            </form>
        </div>
      </div>
      <div class="modal-footer" id="">
     
      </div>
    </div>
  </div>
</div>

      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <?php  
  //  echo script_tag("assets/js/popper.min.js");
   echo script_tag("assets/js/bootstrap.min.js");
   echo script_tag("assets/js/draggagle.js");
   ?>
  </body>

</html>
