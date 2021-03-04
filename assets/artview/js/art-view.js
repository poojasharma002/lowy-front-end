$(document).ready(function () {

    var $box = $('#box');
    var $art = $('#art');
    var $canvas = document.getElementById("canvas");
    var $cntxt = $canvas.getContext("2d");
    var wall_image = document.getElementById('wall-image');
    var initImage = new Image();
    render('assets/artview/img/first-example.png', false);
    var MAX_HEIGHT = $canvas.height;
    var dragStates = { dragStart: 'drag-start', dragging: 'dragging', dragStop: 'drag-stop', none: 'none'}
    Object.freeze(dragStates);
    var canvasDragState = dragStates.none;
    var imageLoaded = false;
    var paint = false;
    var artset = false;
    var lineDrawn = false;
    var initX = 0;
    var initY = 0;
    var artPosition = {
      x1: 0, x2: 0,
      y1: 0, y2: 0,
      aligment: ''
    };
    var art_size;
    var art_view;
    var lastX = 0;
    var lastY = 0;
    var dragging = false;
    var isDown = false;

    // get Left offset from document
    function getOffsetLeft( elem )
    {
        return $($canvas).offset().left;
    }

    // get Top Offset from document
    function getOffsetTop( elem )
    {
        var eTop = $($canvas).offset().top;
        return (eTop - $(window).scrollTop());
    }

    function registerDrawLineEvents(callback){
      $($canvas).on('mousedown', mousedown);
      $($canvas).on('mouseup', mouseup);
      $($canvas).on('mouseover', mouseover);
      $($canvas).on('mouseleave', mouseleave);
      if(callback && typeof callback === "function"){
        callback();
      }
    }

    function deregisterDrawLineEvents(callback) {
      $($canvas).off('mousedown', mousedown);
      $($canvas).off('mouseup', mouseup);
      $($canvas).off('mouseover', mouseover);
      $($canvas).off('mouseleave', mouseleave);
      if(callback && typeof callback === "function"){
        callback();
      }
    }

    function registerDragArtEvents(callback) {
      $($canvas).on('mousedown', handleMouseDown);
      $($canvas).on('mousemove', handleMouseMove);
      $($canvas).on('mouseup', handleMouseUp);
      if(callback && typeof callback === "function"){
        callback();
      }
    }

    function deregisterDragArtEvents(callback) {
      $($canvas).on('mousedown', handleMouseDown);
      $($canvas).on('mousemove', handleMouseMove);
      $($canvas).on('mouseup', handleMouseUp);
      if(callback && typeof callback === "function"){
        callback();
      }
    }

    // handlers for drawing lines on canvas

    function mouseover(e) {
      if(canvasDragState == dragStates.dragStart){
        paint = true; //enabling paint when mouse is over canvas.
        canvasDragState = dragStates.dragging;
      }
    }

    function mouseleave(e) {
      if(canvasDragState == dragStates.none){
        paint = false; //disabling paint when the mouse pointer is out of canvas.
      }
    }

    function mousedown(e) {
      if(e.originalEvent.target == $canvas){
        paint = true;
        if(paint){
          initX = e.pageX;
          initY = e.pageY;
        }
      }
    }

    function mouseup(e) {
      if(paint) {
        var targetX = targetY = finalX = finalY = 0;
        finalX = e.pageX - initX;
        finalY = e.pageY - initY;
        if(Math.abs(finalX) >=50 || Math.abs(finalY) >= 50){
          if(Math.abs(finalX) > Math.abs(finalY)) {
            targetX = e.pageX;
            targetY = initY;
            artPosition.aligment = 'horizontal';
          } else {
            targetX = initX;
            targetY = e.pageY;
            artPosition.aligment = 'vertical';
          }
          drawlines(targetX, targetY);
        }
      }
      paint = false;
    }

    // draw line mouse handlers ends here

    // Draw lines on canvas
    function drawlines(targetX, targetY) {
      if(paint && imageLoaded){
        var x1 = (initX - getOffsetLeft($canvas));
        var y1 = (initY - getOffsetTop($canvas));
        $cntxt.beginPath()
        $cntxt.moveTo(x1, y1);
        artPosition.x1 = x1;
        artPosition.y1 = y1;
        var x2 = (targetX - getOffsetLeft($canvas));
        var y2 = (targetY - getOffsetTop($canvas));
        $cntxt.lineTo(x2, y2);
        artPosition.x2 = x2;
        artPosition.y2 = y2;
        $cntxt.strokeStyle = '#000000';
        $cntxt.lineWidth = 2;
        $cntxt.stroke();
        $cntxt.closePath()
        lineDrawn = true;
        deregisterDrawLineEvents();
        $('.active').removeClass('active');
        $('.step-3').addClass('active');
      }
    }

    // mouse handlers for dragging and repositioning arts

    function handleMouseDown(e) {
      // get mouse coordinates
      mouseX = e.pageX - getOffsetLeft($canvas);
      mouseY = e.pageY - getOffsetTop($canvas);
      // set the starting drag position
      lastX = mouseX.toFixed(4);
      lastY = mouseY.toFixed(4);
      // test if we're over any of the images
      dragging = imagesHitTests(mouseX.toFixed(4), mouseY.toFixed(4));
      // set the dragging flag
      isDown = true;
    }

    function handleMouseUp(e) {
      // clear the dragging flag
      if(isDown && dragging){
        isDown = false;
        $cntxt.globalAlpha = 1;
        resetImage(function(){
          // draw art
          $cntxt.drawImage(art_view, art_size.x, art_size.y, art_size.artWallWidth, art_size.artWallHeight);
        });
      }
    }

    function handleMouseMove(e) {

      // if we're not dragging, exit
      if (!isDown) {
          return;
      }
      //get mouse coordinates
      mouseX = e.pageX - getOffsetLeft($canvas);
      mouseY = e.pageY - getOffsetTop($canvas);

      // calc how much the mouse has moved since we were last here
      var dx = mouseX - lastX;
      var dy = mouseY - lastY;

      // set the lastXY for next time we're here
      lastX = mouseX;
      lastY = mouseY;

      // handle drags/pans
      if (dragging) {
        // we're dragging art
        art_size.x = parseFloat(art_size.x)+dx;
        art_size.y = parseFloat(art_size.y)+dy;

        reDraw();
      }
    }

    // return image to be dragged
    function imagesHitTests(x, y) {

      // create var to hold any hits
      var hits = false;
      // hit-test art image
      // add art to hits

      if(art_view!=undefined && art_size!=undefined){
        if (x > parseFloat(art_size.x) && x < (parseFloat(art_size.x) + parseFloat(art_size.artWallWidth)) && y > parseFloat(art_size.y) && y < (parseFloat(art_size.y) + parseFloat(art_size.artWallHeight))) {
          hits = true;
        }
      }
      return hits;
    }

    // reDraw the complete canvas to move the image to new Position
    function reDraw() {

      // draw canvas background image
      $cntxt.globalAlpha = 0.45;
      resetImage(function(){
        // draw art
        $cntxt.drawImage(art_view, art_size.x, art_size.y, art_size.artWallWidth, art_size.artWallHeight);
      });


    }

    // art drag handlers end here

    // check if drag and drop is available to the browser.
    var isDroppable = function () {
        var div = document.createElement('div');
        return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
    }();

    // if isDroppable than bind the drag events to the drawing box.
    if (isDroppable) {

        var droppedFile = false;
        var art;
        $art.on('dragstart', function(e){
          if(imageLoaded && lineDrawn) {
            e.originalEvent.dataTransfer.setData('Text', e.target.id);
          } else {
            e.preventDefault();
          }
        });

        // drag events for drawing box to detect incoming image.
        $box.on('drag dragstart dragend dragover dragenter dragleave drop', function (e) {
                e.preventDefault();
                e.stopPropagation();
            })
            .on('drop', function (e) {
                // console.log(e);
                droppedFile = e.originalEvent.dataTransfer.files[0];
                if(droppedFile!=null && droppedFile!=undefined && droppedFile){
                  loadImage(droppedFile);
                } else {

                  if(!artset && imageLoaded && lineDrawn) {
                    $(wall_image).data('art', e.originalEvent.dataTransfer.getData('Text'));
                    setArt();
                  }
                }
            });

    }

    // using upload button instead of drag n drop if not supported.
    $('#btn-upload').click(function(e){
      e.stopPropagation();
      e.preventDefault();
      $(wall_image).trigger('click'); // opening the file select box;
    })

    $('#retry').click(function(e){
      reloadCanvasImage();
    });

    // calling loadImage on image change.
    $(wall_image).change(function(e){
      var selectedFile = e.originalEvent.target.files[0];
      loadImage(selectedFile);
    })

    // setting art over canvas image on button Click
    $('#set-art').click(function(e){
      e.preventDefault();
      if( !artset && imageLoaded && lineDrawn ){
        $(wall_image).data('art', $('#art').attr('id'));
        setArt();
      }
    })

    //loads the image from url or base-64 string
    function loadImage(src){
        //	Prevent any non-image file type from being read.
        if(!src.type.match(/image.*/)){
            console.log("The dropped file is not an image: ", src.type);
            return;
        }

        //	Create our FileReader and run the results through the render function.
        var reader = new FileReader();
        reader.onload = function(e){
            $(wall_image).data('wall', e.target.result);
            render(e.target.result);
        };
        reader.readAsDataURL(src);
    }

    // renders the image as background inside canvas.
    function render(src, flag, callbackFunction){
        if(flag==null || flag == undefined) {
          flag = true; //if new image is loaded set value to true else pass flag value as false when using resetImage
        }
        var image = new Image();
        image.onload = function(){

            if(image.height > MAX_HEIGHT) {
                image.width *= MAX_HEIGHT / image.height;
                image.height = MAX_HEIGHT;
            }

            clearCanvas();
            $cntxt.drawImage(image, 0, 0, $canvas.width, $canvas.height);
            if(flag){
              imageLoaded = flag;
              registerDrawLineEvents();
              $('.active').removeClass('active');
              $('.step-2').addClass('active');
            }
            if ( callbackFunction && typeof callbackFunction === "function" ) {
              callbackFunction();
            }
        };
        image.src = src;
    }

    // clears the canvas
    function clearCanvas(callback) {
      $cntxt.clearRect(0, 0, $canvas.width, $canvas.height);
      if(callback && typeof callback === "function"){
        callback();
      }
    }

    // gets image data url as base64 string
    function getBase64Image(img) {
      var c = document.createElement("canvas");
      c.id = 'temp_canvas';
      c.width = img.width;
      c.height = img.height;
      var ctx = c.getContext("2d");
      ctx.drawImage(img, 0, 0);
      var dataURL = c.toDataURL("image/png");
      return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
    }

    //function resets all vars.
    function resetVars(callback){
      artset = imageLoaded = lineDrawn = paint = false;
      initX = initY = 0;
      artPosition = {
        x1: 0, x2: 0,
        y1: 0, y2: 0,
        aligment: ''
      };
      canvasDragState = dragStates.none;
      deregisterDragArtEvents();
      deregisterDrawLineEvents(function(){
        if(callback && typeof callback === "function"){
          callback();
        }
      });
    }

    // reloads the current room image and clears all the data by resetting all variables.
    function reloadCanvasImage(){
      resetVars(function(){
        render($(wall_image).data('wall'));
      });
    }

    // resets the Image loaded on canvas. All other data persists.
    function resetImage(callback) {
      render($(wall_image).data('wall'), false, function(){
        if(callback && typeof callback === "function"){
          callback();
        }
      });
    }

    // set art on wall.
    function setArt() {
      var art = calculateArtSize();
      if(art!=undefined){
        resetImage(function(){
          art_view = document.getElementById($(wall_image).data('art'));
          $cntxt.drawImage(art_view, art.x, art.y, art.artWallWidth, art.artWallHeight);
          artset = true;
          registerDragArtEvents();
        });
      } else {
        alert('Please set wall measurement first, than continue.');
      }
    }

    // calculate art size to be drawn over wall.
    function calculateArtSize() {
      art_size = {artWallWidth: 0, artWallHeight: 0, x: 0, y: 0};
      var lineLength = wallMeasurement = artHeight = artWidth = artWallHeight = artWallWidth = ratio = 0;
      lineLength = calculateLineLength();
      // console.log('lineLength: '+lineLength);
      wallMeasurement = parseFloat($('#wall-measurement').val()).toFixed(4);
      // console.log('wallMeasurement: '+wallMeasurement);

      if(!isNaN(wallMeasurement)  || wallMeasurement > 0){
        artWidth = parseFloat($('#art').data('width')).toFixed(4);
        // console.log('artWidth: '+artWidth);
        artHeight = parseFloat($('#art').data('height')).toFixed(4);
        // console.log('artHeight: '+artHeight);
        ratio = parseFloat(lineLength/wallMeasurement).toFixed(4);
        // console.log('ratio: '+ratio);
        if(artWidth!=artHeight) { // if art is not square size than calculate both dimensions.
          art_size.artWallWidth = parseFloat( artWidth * ratio ).toFixed(4);
          art_size.artWallHeight = parseFloat (artHeight * ratio ).toFixed(4);
        } else {
          art_size.artWallWidth = art_size.artWallHeight = parseFloat (artHeight * ratio ).toFixed(4);
        }
        if(artPosition.aligment.trim() == 'vertical') {
          art_size.x = parseFloat(artPosition.x1 - art_size.artWallWidth/2).toFixed(4);
          art_size.y = parseFloat(artPosition.y1 + ((lineLength - art_size.artWallHeight)/2)).toFixed(4);
        } else if (artPosition.aligment.trim() == 'horizontal') {
          art_size.x = parseFloat(artPosition.x1 + ((lineLength - art_size.artWallWidth)/2)).toFixed(4);
          art_size.y = parseFloat(artPosition.y1 - art_size.artWallHeight/2).toFixed(4);
        }
        // console.log(artPosition);
        // console.log(art_size);
        return art_size;
      } else {
        return undefined;
      }
    }

    // calculate line length
    function calculateLineLength() {
      if(artPosition.aligment.trim() == 'vertical'){
        return parseFloat(Math.abs(artPosition.y2 - artPosition.y1)).toFixed(4);
      } else if (artPosition.aligment.trim() == 'horizontal') {
        return parseFloat(Math.abs(artPosition.x2 - artPosition.x1)).toFixed(4);
      }
      return 0;
    }
    $('#preview-box').on('hidden.bs.modal', function (e) {
      // do something...
      window.top.close();
    });
})
