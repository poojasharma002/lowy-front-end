$(document).ready(function(){
 
  // function for sold check box value change
  $( "#framesView_searchSold" ).prop( "checked", true );
  $('#framesView_searchSold').on('change', function(){
     if($("#framesView_searchSold").is(':checked')){
         $('#framesView_searchSold').val(true);
         $('#__checkbox_framesView_searchSold').val(true);
     }else{
       $('#framesView_searchSold').val(false);
       $('#__checkbox_framesView_searchSold').val(false);
     }
   });
   //function for hide Missing Images check box value change
   $( "#framesView_hideMissingImages" ).prop( "checked", true );
  $('#framesView_hideMissingImages').on('change', function(){
    if($("#hideMissingImages").is(':checked')){
        $('#hideMissingImages').val(true);
        $('#__checkbox_framesView_hideMissingImages').val(true);
    }else{
      $('#hideMissingImages').val(false);
      $('#__checkbox_framesView_hideMissingImages').val(false);
    }
  })
  // call seraching on serach page load
   searchingAttributes();
  // all function for search dropdown 
    $('#__multiselect_centuryLookupables').val(sessionStorage['centurySelectedValue']);
   var centurySelectedValue=$('#__multiselect_centuryLookupables').val();
   var centuryData='{"0":null,"1":[{"label":"C14","value":"14"},{"label":"C15","value":"15"},{"label":"C16","value":"16"},{"label":"C17","value":"17"},{"label":"C18","value":"18"},{"label":"C19","value":"19"},{"label":"C20","value":"20"},{"label":"C21","value":"21"}],"dropdownListName":"century"}';
    dropdownList(centuryData);
       var origin   = window.location.origin;
       $.ajax({
        url:origin+"/FrameSearch/multiDropdown",
        method:"POST",
        data:{data_action:'fetch_dropdown_list', value:'country'},
        success:function(data){
        dropdownList(data);
      }
  })
  $.ajax({
    url:origin+"/FrameSearch/multiDropdown",
    method:"POST",
    data:{data_action:'fetch_dropdown_list', value:'maker'},
    success:function(data){
    dropdownList(data);
  }
})
        $.ajax({
          url:origin+"/FrameSearch/multiDropdown",
          method:"POST",
          data:{data_action:'fetch_dropdown_list', value:'style'},
          success:function(data){
          dropdownList(data);
        }
    })
    $.ajax({
        url:origin+"/FrameSearch/multiDropdown",
        method:"POST",
        data:{data_action:'fetch_dropdown_list', value:'ornament'},
        success:function(data){
          dropdownList(data);
      }
  })
  $.ajax({
    url:origin+"/FrameSearch/multiDropdown",
    method:"POST",
    data:{data_action:'fetch_dropdown_list', value:'color'},
    success:function(data){
      dropdownList(data);
  }
})
$.ajax({
    url:origin+"/FrameSearch/multiDropdown",
    method:"POST",
    data:{data_action:'fetch_dropdown_list', value:'corners'},
    success:function(data){
      dropdownList(data);
  }
})
    function dropdownList(data){
        var dropdownValue= $.parseJSON(data)
        $('#__multiselect_'+dropdownValue.dropdownListName+'Lookupables').val(dropdownValue[0]);
        var autocomplete = new SelectPure(".autocomplete-select-"+dropdownValue.dropdownListName, {
        options:dropdownValue[1],
        value: dropdownValue[0],
        multiple: true,
        autocomplete: true,
        icon: "fa fa-times",
        onChange: value => { $('#__multiselect_'+dropdownValue.dropdownListName+'Lookupables').val(value); },
        classNames: {
          select: "select-pure__select",
          dropdownShown: "select-pure__select--opened",
          multiselect: "select-pure__select--multiple",
          label: "select-pure__label",
          placeholder: "select-pure__placeholder",
          dropdown: "select-pure__options",
          option: "select-pure__option",
          autocompleteInput: "select-pure__autocomplete",
          selectedLabel: "select-pure__selected-label",
          selectedOption: "select-pure__option--selected",
          placeholderHidden: "select-pure__placeholder--hidden",
          optionHidden: "select-pure__option--hidden",
        }
      });
    }
    var style= $('#styleLookupables').val();
    $('#__multiselect_styleLookupables').val(style);
    var ornament= $('#ornamentLookupables').val();
    $('#__multiselect_ornamentLookupables').val(ornament);
    var color= $('#colorLookupables').val();
    $('#__multiselect_colorLookupables').val(color);
    var corner= $('#cornerLookupables').val();
    $('#__multiselect_cornerLookupables').val(corner);


// function for load more Frame
    $("#loadMoreSearch").on('click',function(){
      $('#framesView_searchType').val('');
      var artworkId=$('#artworkId').val();
      var centurySelectedValue=$('#__multiselect_centuryLookupables').val();
      var makerSelectedValue=$('#__multiselect_makerLookupables').val();
      var countrySelectedValue=$('#__multiselect_countryLookupables').val();
      var styleSelectedValue=$('#__multiselect_styleLookupables').val();
      var ornamentSelectedValue=$('#__multiselect_ornamentLookupables').val();
      var colorSelectedValue=$('#__multiselect_colorLookupables').val();
      var cornersSelectedValue=$('#__multiselect_cornersLookupables').val();
      var perPageLoadImageCount=$('#__perPageLoadImageCount').val();
      var minPrice= $('#framesView_minPrice').val();
      var maxPrice= $('#framesView_maxPrice').val();
      var WidthMinSelectedValue=parseFloat(parseInt($('#framesView_sizeMouldingWidthMinInt').val()) + parseFloat($('#framesView_sizeMouldingWidthMinFract').val()));
      var WidthMaxSelectedValue=parseFloat(parseInt($('#framesView_sizeMouldingWidthMaxInt').val()) + parseFloat($('#framesView_sizeMouldingWidthMaxFract').val()));
      var sightHeighMinSelectedValue=parseFloat(parseInt($('#framesView_sizeSightHeightMinInt').val()) + parseFloat($('#framesView_sizeSightHeightMinFract').val()));
      var sightHeighMaxSelectedValue=parseFloat(parseInt($('#framesView_sizeSightHeightMaxInt').val()) + parseFloat($('#framesView_sizeSightHeightMaxFract').val()));
      var sightWidthMinSelectedValue=parseFloat(parseInt($('#framesView_sizeSightWidthMinInt').val()) + parseFloat($('#framesView_sizeSightWidthMinFract').val()));
      var sightWidthMaxSelectedValue=parseFloat(parseInt($('#framesView_sizeSightWidthMaxInt').val()) + parseFloat($('#framesView_sizeSightWidthMaxFract').val()));
      var searchSoldValue=$('#__checkbox_framesView_searchSold').val();
      var hideMissingImagesValue=$('#__checkbox_framesView_hideMissingImages').val();
       perPageLoadImageCount=parseInt(perPageLoadImageCount)+6;
      // $.session.set('centurySelectedValue', centurySelectedValue);
      var searchData=[];
      searchData.push({
        'century':centurySelectedValue,
        'makerId':makerSelectedValue,
        'countryId':countrySelectedValue,
        'styleId':styleSelectedValue,
        'ornamentId':ornamentSelectedValue,
        'colorId':colorSelectedValue,
        'cornerId':cornersSelectedValue,
        'priceMin':minPrice,
        'priceMax':maxPrice,
        'frameWidthMin':WidthMinSelectedValue,
        'frameWidthMax':WidthMaxSelectedValue,
        'sightHeightMin':sightHeighMinSelectedValue,
        'sightHeightMax':sightHeighMaxSelectedValue,
        'sightWidthMin':sightWidthMinSelectedValue,
        'sightWidthMax':sightWidthMaxSelectedValue,
        'includeSold':searchSoldValue,
        'hideMissingImages':hideMissingImagesValue
      });
      $('#cover-spin').show(0);
      var origin   = window.location.origin;
      $.ajax({
       url:origin+"/FrameSearch/search",
       method:"POST",
       data:{data_action:'fetch_all_frame_searching', page:perPageLoadImageCount,value:JSON.stringify(searchData)},
       success:function(data){
        var SelectedValue= $.parseJSON(data);
        if(SelectedValue.totalRecords<(parseInt(perPageLoadImageCount)+6)){
          $("#loadMore").css("display", "none");
         }else{ $("#loadMore").css("display", "block");}
        $('#cover-spin').hide(0); 
        $('#__perPageLoadImageCount').val(perPageLoadImageCount);
       for(var i=0; i<SelectedValue.searchResult.length; i++){
          var inventoryNumberCount= (SelectedValue.searchResult[i].inventoryNumber + "").length;
          var imgInventoryNumber, inventoryNumber;
          if(inventoryNumberCount==1){imgInventoryNumber='L000'+SelectedValue.searchResult[i].inventoryNumber;inventoryNumber='000'+SelectedValue.searchResult[i].inventoryNumber;
        }else if(inventoryNumberCount==2){ imgInventoryNumber='L00'+SelectedValue.searchResult[i].inventoryNumber; inventoryNumber='00'+SelectedValue.searchResult[i].inventoryNumber;
        }else if(inventoryNumberCount==3){ imgInventoryNumber='L0'+SelectedValue.searchResult[i].inventoryNumber; inventoryNumber='0'+SelectedValue.searchResult[i].inventoryNumber;
        }else if(inventoryNumberCount>=4){ imgInventoryNumber='L'+SelectedValue.searchResult[i].inventoryNumber; inventoryNumber=SelectedValue.searchResult[i].inventoryNumber;
       }
       if(artworkId!=''){
        var imgSrc=SelectedValue.baseUri+'images/frames/'+imgInventoryNumber+'/'+artworkId;
         
       }else{
        var imgSrc=SelectedValue.baseUri+'images/frames/web/'+imgInventoryNumber;
       }
        $('#gallery').append('<div class="col-12 col-sm-6 col-lg-4" id="imageGrid">'+
      '<img class="w-100" src="'+imgSrc+'" alt="'+imgInventoryNumber+'" onclick="openImgPopup(\''+imgInventoryNumber+'\', \''+SelectedValue.baseUri+'\', \''+inventoryNumber+'\');" data-slide-to="0" border="0">'+
      '<p><input type="checkbox" name="cartFramesChanges" value="'+inventoryNumber+'" id="box'+imgInventoryNumber+'">'+
         '<input type="hidden" id="__checkbox_box'+imgInventoryNumber+'" name="__checkbox_cartFramesChanges" value="'+inventoryNumber+'">'+ 
         '<span class=""><a id="framesAddToCartForm_" href="'+origin+'/frameAdminView.action?id='+inventoryNumber+'" target="_blank" class="checkit">'+imgInventoryNumber+'</a></span></p></div>');
       }
    
      //  console.log(SelectedValue.searchResult);
     }
 })
    });

    // function for searching by inventory number 
      $('#searchByInvNo').on('click', function(){
      $('#framesView_minPrice').val('');
      $('#framesView_maxPrice').val('');
      $('#framesView_sizeMouldingWidthMinInt').val('');$('#framesView_sizeMouldingWidthMinFract').val('');
      $('#framesView_sizeMouldingWidthMaxInt').val('');$('#framesView_sizeMouldingWidthMaxFract').val('');
      $('#framesView_sizeSightHeightMinInt').val('');$('#framesView_sizeSightHeightMinFract').val('');
      $('#framesView_sizeSightHeightMaxInt').val('');$('#framesView_sizeSightHeightMaxFract').val('');
      $('#framesView_sizeSightWidthMinInt').val('');$('#framesView_sizeSightWidthMinFract').val('');
      $('#framesView_sizeSightWidthMaxInt').val('');$('#framesView_sizeSightWidthMaxFract').val('');
      var artworkId=$('#artworkId').val();
      var searchType=$('#framesView_searchType').val();
      if($.isNumeric(searchType)==false){
        var check= searchType.split('L');
            if(check[0]!='L' && $.isNumeric(check[1])==false){
              createAlert('','','Please Enter valid Inventory Number. Ex.(L0004,L0123 etc.)','danger',true,true,'errorMessages');
              return;
            }
          }     
      $('#cover-spin').show(0);
      var origin   = window.location.origin;
      $.ajax({
       url:origin+"/FrameSearch/searchByInventoryNumber",
       method:"POST",
       data:{data_action:'fetch_frame_searching', 'value':searchType},
       success:function(data){
        $('#cover-spin').hide(0); 
        $("#loadMore").css("display", "none");
       var SelectedValue= $.parseJSON(data);
       $( "#gallery" ).empty();
       if(SelectedValue.inventoryNumber!=0){
          var inventoryNumberCount= (SelectedValue.inventoryNumber + "").length;
          var imgInventoryNumber, inventoryNumber;
          if(inventoryNumberCount==1){imgInventoryNumber='L000'+SelectedValue.inventoryNumber;inventoryNumber='000'+SelectedValue.inventoryNumber;
        }else if(inventoryNumberCount==2){ imgInventoryNumber='L00'+SelectedValue.inventoryNumber; inventoryNumber='00'+SelectedValue.inventoryNumber;
        }else if(inventoryNumberCount==3){ imgInventoryNumber='L0'+SelectedValue.inventoryNumber; inventoryNumber='0'+SelectedValue.inventoryNumber;
        }else if(inventoryNumberCount>=4){ imgInventoryNumber='L'+SelectedValue.inventoryNumber; inventoryNumber=SelectedValue.inventoryNumber;}
        if(artworkId!=''){
          var imgSrc=SelectedValue.baseUri+'images/frames/'+imgInventoryNumber+'/'+artworkId;
           
         }else{
          var imgSrc=SelectedValue.baseUri+'images/frames/web/'+imgInventoryNumber;
         }
        $('#gallery').append('<div class="col-12 col-sm-6 col-lg-4" id="imageGrid">'+
      '<img class="w-100" src="'+imgSrc+'" alt="'+imgInventoryNumber+'" onclick="openImgPopup(\''+imgInventoryNumber+'\', \''+SelectedValue.baseUri+'\', \''+inventoryNumber+'\');" data-slide-to="0" border="0">'+
      '<p><input type="checkbox" name="cartFramesChanges" value="'+inventoryNumber+'" id="box'+imgInventoryNumber+'">'+
         '<input type="hidden" id="__checkbox_box'+imgInventoryNumber+'" name="__checkbox_cartFramesChanges" value="'+inventoryNumber+'">'+ 
         '<span class=""><a id="framesAddToCartForm_" href="'+origin+'/frameAdminView.action?id='+inventoryNumber+'" target="_blank" class="checkit">'+imgInventoryNumber+'</a></span></p></div>');
       }else{
        $('#gallery').append('<div class="col-12 col-sm-6 col-lg-4" id="imageGrid">'+
        '<h2>NO Frame Found</h2>'+
        '</div>');
       }
      }
      })
    });

    // function for add artwork image
    $('#insertArtImage_0').on('click',function(){
      var artHeight=parseFloat(parseInt($('#insertArtImage_artHeightInt').val()) + parseFloat($('#framesView_sizeMouldingArtHeightFract').val()));
      var artWidth=parseFloat(parseInt($('#insertArtImage_artWidthInt').val()) + parseFloat($('#framesView_sizeMouldingArtWidthFract').val()));
    });

     });

     // function for search filter according to arigin, style, size, price, sold, missing, image
   function searchingAttributes(){
    $('#framesView_searchType').val('');
      var artworkId=$('#artworkId').val();
      var centurySelectedValue=$('#__multiselect_centuryLookupables').val();
      var makerSelectedValue=$('#__multiselect_makerLookupables').val();
      var countrySelectedValue=$('#__multiselect_countryLookupables').val();
      var styleSelectedValue=$('#__multiselect_styleLookupables').val();
      var ornamentSelectedValue=$('#__multiselect_ornamentLookupables').val();
      var colorSelectedValue=$('#__multiselect_colorLookupables').val();
      var cornersSelectedValue=$('#__multiselect_cornersLookupables').val();
      var perPageLoadImageCount=$('#__perPageLoadImageCount').val();
      var minPrice= $('#framesView_minPrice').val();
      var maxPrice= $('#framesView_maxPrice').val();
      var WidthMinSelectedValue=parseFloat(parseInt($('#framesView_sizeMouldingWidthMinInt').val()) + parseFloat($('#framesView_sizeMouldingWidthMinFract').val()));
      var WidthMaxSelectedValue=parseFloat(parseInt($('#framesView_sizeMouldingWidthMaxInt').val()) + parseFloat($('#framesView_sizeMouldingWidthMaxFract').val()));
      var sightHeighMinSelectedValue=parseFloat(parseInt($('#framesView_sizeSightHeightMinInt').val()) + parseFloat($('#framesView_sizeSightHeightMinFract').val()));
      var sightHeighMaxSelectedValue=parseFloat(parseInt($('#framesView_sizeSightHeightMaxInt').val()) + parseFloat($('#framesView_sizeSightHeightMaxFract').val()));
      var sightWidthMinSelectedValue=parseFloat(parseInt($('#framesView_sizeSightWidthMinInt').val()) + parseFloat($('#framesView_sizeSightWidthMinFract').val()));
      var sightWidthMaxSelectedValue=parseFloat(parseInt($('#framesView_sizeSightWidthMaxInt').val()) + parseFloat($('#framesView_sizeSightWidthMaxFract').val()));
      var searchSoldValue=$('#__checkbox_framesView_searchSold').val();
      var hideMissingImagesValue=$('#__checkbox_framesView_hideMissingImages').val();
      perPageLoadImageCount=0;
      var searchData=[];
      searchData.push({
        'century':centurySelectedValue,
        'makerId':makerSelectedValue,
        'countryId':countrySelectedValue,
        'styleId':styleSelectedValue,
        'ornamentId':ornamentSelectedValue,
        'colorId':colorSelectedValue,
        'cornerId':cornersSelectedValue,
        'priceMin':minPrice,
        'priceMax':maxPrice,
        'frameWidthMin':WidthMinSelectedValue,
        'frameWidthMax':WidthMaxSelectedValue,
        'sightHeightMin':sightHeighMinSelectedValue,
        'sightHeightMax':sightHeighMaxSelectedValue,
        'sightWidthMin':sightWidthMinSelectedValue,
        'sightWidthMax':sightWidthMaxSelectedValue,
        'includeSold':searchSoldValue,
        'hideMissingImages':hideMissingImagesValue
      });
      $('#cover-spin').show(0);
      var origin   = window.location.origin;
      $.ajax({
       url:origin+"/FrameSearch/search",
       method:"POST",
       data:{data_action:'fetch_all_frame_searching', page:perPageLoadImageCount,value:JSON.stringify(searchData)},
       success:function(data){
        $('#cover-spin').hide(0); 
       var SelectedValue= $.parseJSON(data);
       if(SelectedValue.totalRecords<(parseInt(perPageLoadImageCount)+6)){
        $("#loadMore").css("display", "none");
       }else{ $("#loadMore").css("display", "block");}
       $('#__perPageLoadImageCount').val(perPageLoadImageCount)
       $( "#gallery" ).empty();
      //  alert(SelectedValue.totalRecords);
       if(SelectedValue.totalRecords!=0){
       for(var i=0; i<SelectedValue.searchResult.length; i++){
          var inventoryNumberCount= (SelectedValue.searchResult[i].inventoryNumber + "").length;
          var imgInventoryNumber, inventoryNumber;
          if(inventoryNumberCount==1){imgInventoryNumber='L000'+SelectedValue.searchResult[i].inventoryNumber;inventoryNumber='000'+SelectedValue.searchResult[i].inventoryNumber;
        }else if(inventoryNumberCount==2){ imgInventoryNumber='L00'+SelectedValue.searchResult[i].inventoryNumber; inventoryNumber='00'+SelectedValue.searchResult[i].inventoryNumber;
        }else if(inventoryNumberCount==3){ imgInventoryNumber='L0'+SelectedValue.searchResult[i].inventoryNumber; inventoryNumber='0'+SelectedValue.searchResult[i].inventoryNumber;
        }else if(inventoryNumberCount>=4){ imgInventoryNumber='L'+SelectedValue.searchResult[i].inventoryNumber; inventoryNumber=SelectedValue.searchResult[i].inventoryNumber;
       }
       if(artworkId!=''){
        var imgSrc=SelectedValue.baseUri+'images/frames/'+imgInventoryNumber+'/'+artworkId+'?showArt=true';
         
       }else{
        var imgSrc=SelectedValue.baseUri+'images/frames/web/'+imgInventoryNumber;
       }
        $('#gallery').append('<div class="col-12 col-sm-6 col-lg-4" id="imageGrid">'+
      '<img class="w-100" src="'+imgSrc+'" alt="'+imgInventoryNumber+'" onclick="openImgPopup(\''+imgInventoryNumber+'\', \''+SelectedValue.baseUri+'\', \''+inventoryNumber+'\');" data-slide-to="0" border="0">'+
      '<p><input type="checkbox" name="cartFramesChanges" value="'+inventoryNumber+'" id="box'+imgInventoryNumber+'">'+
         '<input type="hidden" id="__checkbox_box'+imgInventoryNumber+'" name="__checkbox_cartFramesChanges" value="'+inventoryNumber+'">'+ 
      '<span class=""><a id="framesAddToCartForm_" href="'+origin+'/frameAdminView.action?id='+inventoryNumber+'" target="_blank" class="checkit">'+imgInventoryNumber+'</a></span></p></div>');       
       }
         }else{
        $('#gallery').append('<div class="col-12 col-sm-6 col-lg-4" id="imageGrid">'+
        '<h2>NO Frame Found</h2>'+
        '</div>');
      }
        // console.log(SelectedValue.searchResult);
     }
 })
}

     function openImgPopup(imgno,uri,inventoryNumber){
      $( "#imagePopup" ).empty();
      $( "#modal-footer" ).empty();
      var artworkId=$('#artworkId').val();
      if(artworkId!=''){
        var imgSrc=uri+'images/frames/'+imgno+'/'+artworkId+'?showArt=true';     
       }else{
        var imgSrc=uri+'images/frames/web/'+imgno;
       }
      $('#imagePopup').append('<div class="zoom-area">'+
      '<div class="large"></div>'+
      '<img class="small" id="pic" src="'+imgSrc+'" alt="'+imgno+'">'+
      '</div>');
      $('#modal-footer').append(' <div id="fancybox-title-under"> <a target="_blank" href="'+imgSrc+'"> [Print]</a> <div style="float:left;">'+imgno+'&nbsp;</div> <a class="doRotate" href="#" data-toggle="modal"  titledata="'+imgno+'">[Edit]</a> <a target="_blank" href="'+imgSrc+'"> [E-mail]</a> <div id="lb-'+imgno+'" style="float:right;text-align:right;">18CFRRGDCCC838ST56/34X43/58 <br> LP0188T052P313H16</div> </div>')
    $('#exampleModal').modal('show');
     imageZoom();
     }
    
