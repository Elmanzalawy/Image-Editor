@extends('layouts.app')
<style>
    /* .box__dragndrop,
    .box__uploading,
    .box__success,
    .box__error {
    display: none;
    } */
    .box {
        position: relative;
        outline: 2px dashed var(--light);
        outline-offset: -10px;
        min-height: 50vh;
    }

    .box-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .box__dragndrop {
        display: inline;
    }

    #file-label {
        cursor: pointer;
    }

    .box.is-dragover {
        background-color: var(--secondary) !important;
        color: var(--deep-dark) !important;
        transition: background-color 0.3s ease-in;
    }

</style>

@section('content')

    <div class="row">
        {{-- <img id="tempImage" src="{{asset('images/thinkingPepe.png')}}" height="50px" alt=""> --}}
        <div class="col-lg-10">
            <div class="card bg-deep-dark">
                <div class="card-body" id='image-card'>
                    {{-- FORM --}}
                    <form class="box bg-dark" method="post" action="{{route('image.upload')}}"
                        enctype="multipart/form-data">
                        @csrf

                        <input id="file" type="file" name="file" hidden>
                        <div class="box-text text-center">
                            <span>
                                <h1 class="fas fa-upload"></h1>
                            </span>
                            <p><strong><label id="file-label" for="file">Choose an image</label></strong> or drag it
                                here.</p>
                        </div>

                        {{-- <button class="btn btn-primary mt-2" type="submit">Upload</button> --}}
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="card bg-deep-dark">
                <div class="card-header text-center">
                    <h5>Edit Options</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="formControlRange">Filter #1</label>
                        <input type="range" class="form-control-range" id="formControlRange">
                    </div>
                    <div class="form-group">
                        <label for="formControlRange">Filter #2</label>
                        <input type="range" class="form-control-range" id="formControlRange">
                    </div>
                    <div class="form-group">
                        <label for="formControlRange">Filter #3</label>
                        <input type="range" class="form-control-range" id="formControlRange">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script>
    //draw image on canvas
    async function renderImage(image) {
        $('body').append(`<img id='tempImage' src='${image}' width='auto%' style='overflow:scroll; display:block;'>`);
    }
    function drawCanvas(){
        // CANVAS FILTER DOCS: https://developer.mozilla.org/en-US/docs/Web/API/CanvasRenderingContext2D/filter

        $("#image-card").empty().prepend("<canvas id='canvas' class='fade-in' style='width:100%;'></canvas>");

        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        //create a temporary image tag to draw it on canvas
        let img = document.getElementById("tempImage");
        //set canvas initial dimensions equal to image dimensions (we use this to prevent quality loss and stretching)
        let width = img.width;
        let height = img.height;
        canvas.width = width;
        canvas.height = height;
        let canvasWidth = canvas.width;
        let canvasHeight = canvas.height;
        // $(canvas).css({
        //     "width":`${width}`,
        //     "height":`${height}`
        // })
        console.log({width, height})
        console.log({canvasWidth, canvasHeight})
        // var img = new Image;
        // img.src = URL.createObjectURL(image);
        ctx.drawImage(img, 0, 0, img.width,    img.height,     // source rectangle
        0, 0, canvas.width, canvas.height);

        ctx.filter = "blur(4px)"

        //delete img tag after canvas is drawn
        $(img).remove();
    }

    // Box dragover event
    var droppedFiles = false;
    const form = $(".box");

    form.on('drag dragstart dragend dragover dragenter dragleave drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
        })
        .on('dragover dragenter', function () {
            form.addClass('is-dragover');
        })
        .on('dragleave dragend drop', function () {
            form.removeClass('is-dragover');
        })
        .on('drop', function (e) {
            droppedFiles = e.originalEvent.dataTransfer.files;
            console.log(droppedFiles)

            if (droppedFiles.length > 1) {
                bootstrapAlert('danger',"<strong>Error</strong>: Only one image may be uploaded.");
            } else {
                // $(form).trigger('submit');
                jQuery.each(droppedFiles, function (index, file) {
                    // alert(file.type)
                    var fileReader = new FileReader();
                    fileReader.readAsDataURL(file);

                    fileReader.onload = (function (file) {
                        return function (e) {
                            renderImage(fileReader.result).then(function(){
                                drawCanvas()
                            })
                        };
                    })(file);
                });

            }
        });

</script>
@endsection
