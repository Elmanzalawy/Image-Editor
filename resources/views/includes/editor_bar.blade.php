<div id="editor-bar" class="editor-ui row bg-deep-dark">
    <div class="container-fluid">
        <div id="editor-bar-wrapper">
            <a class="ml-3" href="#" onclick="Canvas.saveImage(this)">
                <span><i class="fas fa-download" data-toggle="tooltip" data-placement="bottom" title="Download Image"></i></span>
            </a>
            <a href="#" >
                <i class="fas fa-undo ml-4" data-toggle="tooltip" data-placement="bottom" title="Undo"></i>
            </a>
            <a href="#" onclick="canvasToggleSelectMode(this)">
                <i class="far fa-object-ungroup ml-4" data-toggle="tooltip" data-placement="bottom" title="Select Tool"></i>
            </a>



            <div class="align-right pr-4">
                <a class="ml-4" href="#" onclick="">
                    <i class="fas fa-undo ml-4" data-toggle="tooltip" data-placement="bottom" title="Reset Filters"></i>
                </a>
                <a class="ml-4 text-danger" href="#" onclick="cancelEditing()">
                    <span><i class="fas fa-times" data-toggle="tooltip" data-placement="bottom" title="Cancel Editing"></i></span>
                </a>

            </div>

                {{-- <button class="btn btn-sm btn-primary mt-2 editor-ui" onclick="saveImage(this)">Save Image</button> --}}

        </div>
    </div>
</div>
