$(document).ready(function(){
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

    $('#framesView_0').on('click',function(){
        var centurySelectedValue=$('#__multiselect_centuryLookupables').val();
        // $.session.set('centurySelectedValue', centurySelectedValue);
        var searchData=[];
        searchData.push({'century':centurySelectedValue});
        // console.log(JSON.stringify(searchData));
        var origin   = window.location.origin;
        $.ajax({
         url:origin+"/FrameSearch/search",
         method:"POST",
         data:{data_action:'fetch_all_frame_searching', value:JSON.stringify(searchData)},
         success:function(data){
         var centurySelectedValue= $.parseJSON(data);
          console.log(centurySelectedValue[0].century);
         
       }
   })
    });

     });
    