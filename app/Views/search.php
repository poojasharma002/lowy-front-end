<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php 
echo link_tag('assets/css/bootstrap.min.css');
echo script_tag("assets/js/jquery-3.5.1.js");
echo link_tag('assets/css/search.min.css');
echo link_tag('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'); 
echo link_tag('assets/css/ui-dropdown.css'); 
echo script_tag("assets/js/bundle.min.js");
echo script_tag("assets/js/ui-drowpdown-search.js");
?>
  <!-- Bootstrap core CSS -->
  <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->

  <!-- Custom styles for this template -->
  <!-- <link href="css/simple-sidebar.css" rel="stylesheet"> -->

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading"><img src="<?php echo base_url('assets/img/logo-client.jpg');?>"/></div>
      <div class="list-group list-group-flush">
        <div id="searchOptionWapper">
          <!-- Actual search box -->
             <p>
                <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <div class="input-group-append">
                  <button class="btn btn-secondary" type="button">
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
                    <label for="Height">Height:</label>
                    <input type="text" name="artHeightInt" class="form-control" placeholder="Enter Height" value="" id="insertArtImage_artHeightInt" class="sizeFieldInt">
                  </div>
                  <div class="form-group">
                    <label for="Width">Width:</label>
                    <input type="text" name="artWidthInt" class="form-control" placeholder="Enter Width" value="" id="insertArtImage_artWidthInt" class="sizeFieldInt">
                  </div> 
                  <input type="submit" id="insertArtImage_0" value="Add Art" class="buttonlink">
                  <input type="submit" id="insertArtImage_toggleArtImage" name="action:toggleArtImage" value="Hide Art" disabled="disabled" class="buttonlink">
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
                  <label for="Width">Min Width:</label>
                  <input type="text" name="sizeMouldingWidthMinInt" class="" value="0" id="framesView_sizeMouldingWidthMinInt">
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
                      <label for="Width">Max Width:</label>
                      <input type="text" name="sizeMouldingWidthMaxInt"  value="0" id="framesView_sizeMouldingWidthMaxInt" class="sizeFieldInt">
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
                  <input type="text" name="sizeSightHeightMinInt" value="0" id="framesView_sizeSightHeightMinInt" class="sizeFieldInt">
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
                <input type="text" name="sizeSightHeightMaxInt" value="0" id="framesView_sizeSightHeightMaxInt" class="sizeFieldInt">
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
                  <input type="text" name="sizeSightWidthMinInt" value="0" id="framesView_sizeSightWidthMinInt" class="sizeFieldInt">
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
                <input type="text" name="sizeSightWidthMaxInt" value="0" id="framesView_sizeSightWidthMaxInt" class="sizeFieldInt">
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
            Search Sold<input type="checkbox" name="searchSold" value="true" id="framesView_searchSold">
<input type="hidden" id="__checkbox_framesView_searchSold" name="__checkbox_searchSold" value="true"> 
        </div>

        <div id="hideMissingImages">
            Hide missing images<input type="checkbox" name="hideMissingImages" value="true" id="framesView_hideMissingImages">
<input type="hidden" id="__checkbox_framesView_hideMissingImages" name="__checkbox_hideMissingImages" value="true"> 
        </div>
        <div id="searchSubmit">
            <input type="image" alt="Search Frames" src="<?php echo base_url('assets/img/search-link.jpg');?>" id="framesView_0" value="Search Frames">
            <input type="image" alt="Clear Search" src="<?php echo base_url('assets/img/clear-search.jpg');?>" id="framesView_framesResetSearch" name="action:framesResetSearch" value="Clear Search">
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
        <h1 class="mt-4"></h1>
      
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <?php echo script_tag("assets/js/jquery-3.5.1.js"); 
   echo script_tag("assets/js/bootstrap.min.js");?>
  <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
  <!-- <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
