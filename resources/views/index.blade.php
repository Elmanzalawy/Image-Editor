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

    #image-card{
        /* position:relative; */
    }
    #canvas{
        width:100%;
        position: relative;
    }
</style>

@section('content')

    <div id="title-header" class="row mb-3 default-ui">
        <div class="col-12 text-center">
            <h3>Image Editor</h3>
        </div>
    </div>
    <div class="row">
        {{-- <img id="tempImage" src="{{asset('images/thinkingPepe.png')}}" height="50px" alt=""> --}}
        <div class="col-lg-1 default-ui" id="left-padding-col"></div>
        <div class="col-lg-10 mb-2" id="image-col">
            <div class="card bg-deep-dark">
                <div class="card-body" id='image-card'>
                    <canvas id='canvas' class='fade-in editor-ui'></canvas>
                    {{-- FORM --}}
                    <form class="box bg-dark default-ui" method="post" action="{{route('image.upload')}}"
                        enctype="multipart/form-data">
                        @csrf

                        <input id="file" type="file" name="file" hidden>
                        <div class="box-text text-center blink">
                            <span>
                                <h1 class="fas fa-upload"></h1>
                            </span>
                            <p><strong><label id="file-label" for="file">Choose an image</label></strong> or drag it
                                here.</p>
                        </div>

                        {{-- <button class="btn btn-primary mt-2" type="submit">Upload</button> --}}
                    </form>
                    <a class="editor-ui" id="download-link" hidden></a>

                </div>
            </div>
        </div>
        @include('includes.filters')
    </div>
@endsection

@section('javascript')
<script>
    //     // CANVAS FILTER DOCS: https://developer.mozilla.org/en-US/docs/Web/API/CanvasRenderingContext2D/filter

    let canvas;

    //draw image on canvas
    async function renderImage(image, name) {
        console.log({name})
        fileName = name;
        $('body').append(`<img id='tempImage' src='${image}' data-name='${name}'  hidden>`);
    }

    // Box dragover event
    var droppedFiles = false;
    const form = $(".box");
    let fileName = "";

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
        .on('input', function(e){
            droppedFiles = e.target.files;
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
                        console.log({file})
                        return function (e) {
                            renderImage(fileReader.result, file.name).then(function(){

                                //create canvas object
                                canvas = new Canvas(document.getElementById("canvas"));
                                canvas.render()
                                editorMode(canvas)
                            })
                        };
                    })(file);
                });

            }
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
                        console.log({file})
                        return function (e) {
                            renderImage(fileReader.result, file.name).then(function(){

                                //create canvas object
                                canvas = new Canvas(document.getElementById("canvas"));
                                canvas.render()
                                editorMode()
                            })
                        };
                    })(file);
                });

            }
        });

</script>
@endsection
