<?php  echo view('templates/header'); ?>
<script>
$(document).ready(function(){  
  $(".nav-link").removeClass("active");
    $(".tab-pane").removeClass("active");
    $(".tab-pane").removeClass("show");
    $('.import').addClass("active");
    $('#import').addClass("active");
    $('#import').addClass("show");
   });
</script>
 <!-- Tab panes -->
 <div class="tab-content">
    <div id="import" class="container tab-pane fade"><br>
        <h3>IMPORT</h3>
        </div>
 </div>
 </main>
   <?php echo view('templates/footer');?>