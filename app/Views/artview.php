<!doctype html>
<html lang="en" class="no-js">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <title>Art-View</title>
  <!-- Bootstrap CSS -->
  <?php
  
  echo link_tag('assets/artview/css/bootstrap.min.css');
  echo link_tag('assets/artview/css/art-view.css');
  ?>
  <?php $session = session();
        $dataSession=$session->get('upload_artwork');
        $url=$baseUri."images/frames/".$imageNo."/".$dataSession['response']->artworkId."?showArt=true";
        ?>
  <!-- remove this if you use Modernizr -->
  <!-- script for feature detection -->
  

</head>

<body>
  <!-- <div class="welcome">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#preview-box">Let's Go To Art-View -> Click Me!</button>
  </div> -->

  <!-- Preview Box -->
  <div class="modal" tabindex="-1" role="dialog" id='preview-box'>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header preview-box-header">
        <span class="col-2 logo">
            <img src="<?php echo base_url('assets/artview/img/Bitmap.png');?>" alt="logo" class="img img-responsive" width="50" />
            <br />
            <img src="<?php echo base_url('assets/artview/img/ART VIEW.png');?>" alt="art-view-text" class='img img-responsive' width="50" />
          </span>
          <span class="col-6">
            <span class="row">
              <span class="modal-title preview-box-title">View art on your walls in 2 steps!</span>
            </span>
          </span>
          <span class="col-4">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <span class="btn-group">
              <button type="button" class="btn-login">Login</button>
              <button type="button" class="btn-sign-up">Sign-up</button>
            </span>
          </span>
        </div>
        <div class="modal-body preview-box-body">
          <div class="col-12">
            <div class="row">
              <div class="col-4">
                <div class="row">
                  <div class="gallery">
                    <div class="show-case">
                      <div class="art">
                        <img src='<?= $url ?>' class="img-responsive" id='art' alt="" draggable="true" data-width='46' data-height='46'>
                        <div class="art-text mt-2">
                          <h5 class="art-title">Tommy May</h5>
                          <div class="art-description text-muted">
                            <p><strong>Pixels: </strong> <strong>Y: </strong><?= $dataSession['response']->imageHeight;?> <strong>X: </strong><?= $dataSession['response']->imageWidth;?></p>
                            <p><strong>Inches: </strong> <strong>Y: </strong><?= $dataSession['response']->artHeightInches;?> <strong>X: </strong><?= $dataSession['response']->artWidthInches;?></p>
                            <p><strong>Dpi: </strong> <strong>Y: </strong><?= $dataSession['response']->dpiY;?> <strong>X: </strong><?= $dataSession['response']->dpiX;?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-8">
                <div class="drawing-canvas" id='box'>
                  <input type="file" hidden class="wall-image" id='wall-image'/>
                  <canvas class="canvas" id='canvas' width="665" height="360">
                  </canvas>
                  <div class="information">
                    <div class="upload-section step-1 active" style="display:none">
                    <img src="<?php echo base_url('assets/artview/img/Download.png');?>" alt="Download Image" class="img-responsive align-self-center"/>
                      <p class="text-muted">Drag and Drop Image</p>
                      <div>
                        <button class="btn-upload" id="btn-upload">Upload Wall Photo</button>
                      </div>
                    </div>
                    <div class="example-section step-2" style="display:none">
                    </div>
                    <div class="measurement-section step-3" style="display:none">
                      <label>Enter Dimension: </label>
                      <input type="number" name='wallMeasurement' id='wall-measurement' min="50">
                      <button class="btn btn-dark" type="button" id='set-art'>Continue</button>
                      <button class="btn-round" type="button" id='retry'>RETRY</button>
                    </div>
                    <div class="download-section step-4" style="display:none">
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
echo script_tag('assets/artview/js/jquery.min.js');
echo script_tag('assets/artview/js/bootstrap.bundle.min.js');
echo script_tag('assets/artview/js/art-view.js');
?>
<script>
    $(document).ready(function(){
        $('#preview-box').modal({
        backdrop:'static'
    });
    });
</script>
</body>

</html>
