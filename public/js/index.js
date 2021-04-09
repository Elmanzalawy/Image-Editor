let SELECT_MODE = false;
let startCoords = {x:0,y:0};
let layers = [];

function toggleSelectMode(el){
    //if already in select mode, toggle it off
    if(SELECT_MODE == true){
        SELECT_MODE = false;
        addLayer(canvas);

        console.log("select mode off")
        $("canvas").off('mousedown mousemove mouseup');
        $(el).children().eq(0).removeClass("action-icon-selected")
    }
    //init select mode
    else{
        SELECT_MODE = true;
        console.log("select mode on")

        $(el).children().eq(0).addClass("action-icon-selected");
        $("canvas").on('mousedown',function(e){
            console.log("mousedown")
            e.preventDefault();
            e.stopPropagation();

            var layer = canvas.rasterizeLayer()
            startCoords.x = e.clientX;
            startCoords.y = e.clientY;

            $(layer).on('mousemove', canvasSelect);
            $(layer).on('mouseup', function(e){
                SELECT_MODE = false;
                console.log("mouseup")
                // canvas.rasterizeLayer(e)
                $(layer).off('mousemove mouseup');
            });

        })
    }
}

function addLayer(canvas){
    let layer = new Layer(canvas, canvas.layers.length);
    canvas.layers.push(layer);

    $("#layers-container").append(`<div class='layer-card position-relative p-2 border border-secondary mb-2 rounded' id='layer-card-${layer.id}' onclick='selectLayer(this, ${layer.id})'>Layer #${layer.id}
    <span class='position-absolute delete-layer-button' style='right:1rem; transform:translateY(0.25rem); cursor:pointer;' onclick='removeLayer(this, ${layer.id})'><i class="fas fa-times text-danger" data-toggle="tooltip" data-placement="bottom" title="Delete Layer"></i></span>
    </div>`);

    $(".delete-layer-button i").tooltip();
}

function selectLayer(layerCard, layerID){

    $('.layer').hide();
    $(`#layer-${layerID}`).show();
    $('.layer-card').removeClass("border-primary").removeClass('bg-primary').addClass('border-secondary');
    $(layerCard).removeClass("border-secondary").addClass("border-primary").addClass('bg-primary');
}


function removeLayer(button, layerID){
    canvas.layers[layerID] = null;
    $(`#layer-${layerID}`).remove();
    $(button).parents(".layer-card").remove();
}
