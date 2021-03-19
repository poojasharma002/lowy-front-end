$(document).ready(function (e) {
  $("#artworkupload").on('submit',(function(e) {
      e.preventDefault();
     var artFile= $('#insertArtImage_artFile').val();
     var HeightInt= $('#insertArtImage_artHeightInt').val();
     var WidthInt= $('#insertArtImage_artWidthInt').val();
     var perPageLoadImageCount=$('#__perPageLoadImageCount').val();
     perPageLoadImageCount=0;
     var ext= $('#insertArtImage_artFile').val().split('.').pop().toLowerCase();
     if(artFile!=''){
     var size= $("#insertArtImage_artFile")[0].files[0].size;
     }
     if(artFile==''){
      createAlert('','','Please upload Image.','danger',true,true,'errorMessages');
      $("#insertArtImage_artFile").focus();
      return;
    }else if($.inArray(ext, ['svg','png','jpg','jpeg']) == -1) {
      createAlert('','','Required, only .png and .jpg files allowed','danger',true,true,'errorMessages');
      $("#insertArtImage_artFile").focus();
      return;
    }else if(size > 10485760) {
      createAlert('','','Required, only less than 10MB files size allowed','danger',true,true,'errorMessages');
      $("#insertArtImage_artFile").focus();
      return;
    }else if(HeightInt==''){
        createAlert('','','Please Enter Height.','danger',true,true,'errorMessages');
        $("#insertArtImage_artHeightInt").focus();
        return;
      }else if($.isNumeric(HeightInt)==false){
        createAlert('','','Please Enter Numeric Value.','danger',true,true,'errorMessages');
        $("#insertArtImage_artHeightInt").focus();
        return;
      }else if(WidthInt==''){
        createAlert('','','Please Enter Width.','danger',true,true,'errorMessages');
        $("#insertArtImage_artFile").focus();
        return;
      }else if($.isNumeric(WidthInt)==false){
        createAlert('','','Please Enter Numeric Value.','danger',true,true,'errorMessages');
        $("#insertArtImage_artHeightInt").focus();
        return;
      }
      var artworkId=$('#artworkId').val();
      var origin   = window.location.origin;
      // if(artworkId==''){
      $('#cover-spin').show(0);
       $.ajax({
         url:origin+"/FrameSearch/uploadArtwork",
         type: "POST",
         data:  new FormData(this),
         contentType: false,
         cache: false,
         processData:false,
         success:function(data){
           var uploadData= $.parseJSON(data);
          $('#cover-spin').hide(0); 
          $("#imagePreview").empty();
          $("#insertArtImage_artFile").val('');
          $("#insertArtImage_artHeightInt").val('');
          $("#framesView_sizeMouldingArtHeightFract").val('');
          $("#insertArtImage_artWidthInt").val('');
          $("#framesView_sizeMouldingArtWidthFract").val('');
          $('#artworkId').val(uploadData.response.artworkId)
          $("#imagePreview").append('<img src="data:image/*;base64,'+uploadData.img+'" width="250" height="250">'+
                  '<p style="font-size:11px;line-height: 1.1;"><strong>Name: </strong>'+uploadData.fileNmae+'</p>'+
                  '<p style="font-size:11px;line-height: .2;"><strong>Pixels: </strong> <strong>Y: </strong>'+uploadData.response.imageHeight+' <strong>X: </strong>'+uploadData.response.imageWidth+'</p>'+
                  '<p style="font-size:11px;line-height: .2;"><strong>Inches: </strong> <strong>Y: </strong>'+uploadData.response.artHeightInches+'<strong>X: </strong>'+uploadData.response.artWidthInches+'</p>'+
                  '<p style="font-size:11px;line-height: .2;"><strong>Dpi: </strong> <strong>Y: </strong>'+uploadData.response.dpiY+' <strong>X: </strong>'+uploadData.response.dpiX+'</p>');
          $('#insertArtImage_removeArtImage').prop('disabled', false);
        //   searchingAttributes();
        //  console.log(data);
        if(uploadData.totalRecords<(parseInt(perPageLoadImageCount)+6)){
          $("#loadMore").css("display", "none");
         }else{ $("#loadMore").css("display", "block");}
         $('#__perPageLoadImageCount').val(perPageLoadImageCount)
         $( "#gallery" ).empty();
         if(uploadData.totalRecords!=0){
          for(var i=0; i<uploadData.searchResult.length; i++){
             var inventoryNumberCount= (uploadData.searchResult[i].inventoryNumber + "").length;
             var imgInventoryNumber, inventoryNumber;
             if(inventoryNumberCount==1){imgInventoryNumber='L000'+uploadData.searchResult[i].inventoryNumber;inventoryNumber='000'+uploadData.searchResult[i].inventoryNumber;
           }else if(inventoryNumberCount==2){ imgInventoryNumber='L00'+uploadData.searchResult[i].inventoryNumber; inventoryNumber='00'+uploadData.searchResult[i].inventoryNumber;
           }else if(inventoryNumberCount==3){ imgInventoryNumber='L0'+uploadData.searchResult[i].inventoryNumber; inventoryNumber='0'+uploadData.searchResult[i].inventoryNumber;
           }else if(inventoryNumberCount>=4){ imgInventoryNumber='L'+uploadData.searchResult[i].inventoryNumber; inventoryNumber=uploadData.searchResult[i].inventoryNumber;
          }
          var imgSrc=uploadData.baseUri+'images/frames/'+imgInventoryNumber+'/'+uploadData.response.artworkId+'?showArt=true';
          $('#gallery').append('<div class="col-12 col-sm-6 col-lg-4" id="imageGrid">'+
        '<img class="w-100" id="frameImg" src="'+imgSrc+'" alt="'+imgInventoryNumber+'" onclick="openImgPopup(\''+imgInventoryNumber+'\', \''+uploadData.baseUri+'\', \''+inventoryNumber+'\');" data-slide-to="0" border="0"  data-inventoryno="'+imgInventoryNumber+'">'+
        '<p><input type="checkbox" name="cartFramesChanges" value="'+inventoryNumber+'" id="box'+imgInventoryNumber+'">'+
           '<input type="hidden" id="__checkbox_box'+imgInventoryNumber+'" name="__checkbox_cartFramesChanges" value="'+inventoryNumber+'">'+ 
        '<span class=""><a id="framesAddToCartForm_" href="'+origin+'/frameAdminView.action?id='+inventoryNumber+'" target="_blank" class="checkit">'+imgInventoryNumber+'</a></span></p></div>');       
         }
           }else{
          $('#gallery').append('<div class="col-12 col-sm-6 col-lg-4" id="imageGrid">'+
          '<h2>NO Frame Found</h2>'+
          '</div>');
        }
       }
   })
  // }else{
  //     createAlert('','','Please remove the previous image.','warning',true,true,'errorMessages');
  // }
  }));
  var artworkId=$('#artworkId').val();
  if(artworkId!='')
  {
      $('#insertArtImage_removeArtImage').prop('disabled', false);
  }
  });