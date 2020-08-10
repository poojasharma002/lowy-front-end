$(document).ready(function(){  
    $(".nav-link").removeClass("active");
      $(".tab-pane").removeClass("active");
      $(".tab-pane").removeClass("show");
      $('.detail').addClass("active");
      $('#details').addClass("active");
      $('#details').addClass("show");
       var inventoryNumber =$('#frameAdminSave_inventoryNumber').val();
       var origin   = window.location.origin;
        $.ajax({
          url:origin+"/lowy-front-end/FrameDetails/multiDropdown",
          method:"POST",
          data:{data_action:'fetch_dropdown_list', value:'style', id:inventoryNumber},
          success:function(data){
            dropdownList(data);
        }
    })
    $.ajax({
        url:origin+"/FrameDetails/multiDropdown",
        method:"POST",
        data:{data_action:'fetch_dropdown_list', value:'ornament', id:inventoryNumber},
        success:function(data){
          dropdownList(data);
      }
  })
  $.ajax({
    url:origin+"/lowy-front-end/FrameDetails/multiDropdown",
    method:"POST",
    data:{data_action:'fetch_dropdown_list', value:'color', id:inventoryNumber},
    success:function(data){
      dropdownList(data);
  }
})
$.ajax({
    url:origin+"/lowy-front-end/FrameDetails/multiDropdown",
    method:"POST",
    data:{data_action:'fetch_dropdown_list', value:'corners', id:inventoryNumber},
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
     });
    